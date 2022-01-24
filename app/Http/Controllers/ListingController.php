<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ListingController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('s')) {
            $input = $request->s;
            $listings = Listing::where('is_active', 1)
                ->where('title', 'like', "%$input%")
                ->orWhere('company', 'like', "%$input%")
                ->orWhere('location', 'like', "%$input%")
                ->orWhere('content', 'like', "%$input%")
                ->with('tags')
                ->latest()
                ->get();
        }
        if ($request->has('tag')) {
            $input = $request->tag;
            $listings = Listing::whereHas('tags', function (Builder $query) use ($input) {
                $query->where('slug', 'like', "$input%");
            })->get();

        }

        if ($request->missing("s") and $request->missing("tag")) {
            $listings = Listing::where('is_active', 1)
                ->with('tags')
                ->latest()
                ->limit(10)
                ->get();
        }

        $tags = Tag::orderBy('name')->get();
        return view('listings.index', ['listings' => $listings, 'tags' => $tags]);
    }

    public function show($slug)
    {
        $listing = Listing::where("slug", "=", $slug)->firstOrFail();
        return view('listings.listing', ['listing' => $listing]);
    }

    public function apply(Request $request, $slug)
    {
        $listing = Listing::where("slug", "=", $slug)->firstOrFail();
        $listing->clicks()
            ->create([
                'user_agent' => $request->userAgent(),
                'ip' => $request->ip()
            ]);
        return redirect()->to($listing->apply_link);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $validationArray = [
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'file'],
            'content' => ['required'],
            'apply_link' => ['required', 'url'],
            'payment_method_id' => ['required']
        ];
        if (!Auth::check()) {
            $validationArray = array_merge($validationArray, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed'],
            ]);
        }
        $request->validate($validationArray);
        $user = Auth::user();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->createAsStripeCustomer();
            Auth::login($user);
        }
        $md = new \ParsedownExtra();

        $amount = 9900; // $99.00 USD in cents
        if ($request->filled('is_highlighted')) {
            $amount += 1900;
        }

        $user->charge($amount, $request->payment_method_id);
        $user->listings()
            ->create([
                'title' => $request->title,
                'slug' => \Str::slug($request->title),
                'company' => $request->company,
                'location' => $request->location,
                'logo' => $request->logo->storeAs('public', 'file_' . time() . '.jpg'),
                'is_highlighted' => $request->filled("is_highlighted"),
                'is_active' => true,
                'content' => $md->text($request->input('content')),
                'apply_link' => $request->apply_link,
                'created_at' => now()
            ]);
        return redirect(route("listing.index"));
    }
}
