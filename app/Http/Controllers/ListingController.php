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
        $listings = $request->whenFilled('name', function ($input) {
            return Listing::whereHas('tags', function (Builder $query) use ($input) {
                $query->where('slug', 'like', "$input%");
            })->get();
        });
        $listings = $request->whenFilled('s', function ($input) {
            return Listing::where('is_active', 1)
                ->where('title', 'like', "%$input%")
                ->orWhere('company', 'like', "%$input%")
                ->orWhere('location', 'like', "%$input%")
                ->orWhere('content', 'like', "%$input%")
                ->with('tags')
                ->latest()
                ->get();
        });

        $listings = $request->missing(['s', 'tag']) ?? function () {
                return Listing::where('is_active', 1)
                    ->with('tags')
                    ->latest()
                    ->limit(10)
                    ->get();
            };


        dd($listings);
        $tags = Tag::orderBy('name')->get();
        return view('listings.index', ['listings' => $listings, 'tags' => $tags]);
    }
}
