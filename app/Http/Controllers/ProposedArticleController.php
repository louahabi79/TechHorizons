<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProposedArticle;
use Illuminate\Support\Facades\Auth;


class ProposedArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proposed_articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ProposedArticle::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('articles.index')->with('success', 'Proposed Article submitted successfully.');
    }
}
