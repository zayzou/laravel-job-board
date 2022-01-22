<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
}
