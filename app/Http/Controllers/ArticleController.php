<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $themes = Theme::all();
        return view('articles.create', compact('themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
        $article->author_id = Auth::id();



        if ($request->hasFile('article_thumbnail')) {
            $file = $request->file('article_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/article_thumbnails', $filename);
            $article->article_thumbnail = Storage::url($path);
        }
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }
}
