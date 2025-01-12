<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,article_id',
            'content' => 'required|string',
        ]);
        if (auth::check()) {
            Comment::create([
                'user_id' => auth::id(),
                'article_id' => $request->article_id,
                'content' => $request->content,
            ]);
        }

        return redirect()->back();
    }
}
