<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProposedArticleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
    Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/proposed_articles/create', [ProposedArticleController::class, 'create'])->name('proposed_articles.create');
    Route::post('/proposed_articles', [ProposedArticleController::class, 'store'])->name('proposed_articles.store');
    Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');
    Route::get('/issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');
    Route::put('/issues/{issue}', [IssueController::class, 'update'])->name('issues.update');
    Route::delete('/issues/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::resource('themes', ThemeController::class);
});

require __DIR__ . '/auth.php';
