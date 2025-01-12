<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,article_id',
            'rating' => 'required|integer|min:1|max:5'
        ]);
        if (Auth::check()) {
            $previousRating = Rating::where('user_id', Auth::id())->where('article_id', $request->article_id)->first();
            if ($previousRating) {
                $previousRating->delete();
            }
            Rating::create([
                'user_id' => Auth::id(),
                'article_id' => $request->article_id,
                'rating' => $request->rating
            ]);
        }
        return redirect()->back()->with('success', 'Article rated successfully.');
    }
}
