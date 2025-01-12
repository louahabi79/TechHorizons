<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth::check()) {
            abort(403, 'Unauthorized action');
        }
        if (auth::user()->role !== 'editor' && auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized action');
        }
        $themes = Theme::all();
        return view('articles.create', compact('themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth::check()) {
            abort(403, 'Unauthorized action');
        }
        if (auth::user()->role !== 'editor' && auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized action');
        }
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
            'theme_id' => 'required|exists:themes,theme_id',
            'article_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB

        ]);
        $article = new Article();
        $article->article_title = $request->article_title;
        $article->article_content = $request->article_content;
        $article->theme_id = $request->theme_id;
        $article->author_id = auth::id();

        if ($request->hasFile('article_thumbnail')) {
            $file = $request->file('article_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/article_thumbnails', $filename);
            $article->article_thumbnail = Storage::url($path);
        }
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }
    /**
     * Show the article resource.
     */
    public function show(Article $article)
    {
        if (auth::check()) {
            History::create([
                'user_id' => auth::id(),
                'article_id' => $article->article_id,
            ]);
        }
        $userRating = null;
        if (auth::check()) {
            $userRating = Rating::where('user_id', auth::id())->where('article_id', $article->article_id)->first();
        }

        $averageRating = Rating::where('article_id', $article->article_id)->avg('rating');
        $article = Article::with('comments.user')->find($article->article_id);
        return view('articles.show', compact('article', 'userRating', 'averageRating'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if (!auth::check()) {
            abort(403, 'Unauthorized action');
        }
        if (auth::user()->role !== 'editor' && auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized action');
        }
        $themes = Theme::all();
        return view('articles.edit', compact('article', 'themes'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if (!auth::check()) {
            abort(403, 'Unauthorized action');
        }
        if (auth::user()->role !== 'editor' && auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized action');
        }
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
            'theme_id' => 'required|exists:themes,theme_id',
            'article_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $article->article_title = $request->article_title;
        $article->article_content = $request->article_content;
        $article->theme_id = $request->theme_id;

        if ($request->hasFile('article_thumbnail')) {
            $file = $request->file('article_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/article_thumbnails', $filename);
            $article->article_thumbnail = Storage::url($path);
        }
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (!auth::check()) {
            abort(403, 'Unauthorized action');
        }
        if (auth::user()->role !== 'editor' && auth::user()->role !== 'manager') {
            abort(403, 'Unauthorized action');
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
