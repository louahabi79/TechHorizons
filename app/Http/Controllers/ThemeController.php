<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Theme::all();
        $user = auth::user();
        $subscribedThemeIds = [];
        if ($user) {
            $subscribedThemeIds = Subscription::where('user_id', auth::id())->pluck('theme_id')->toArray();
        }

        return view('themes.index', compact('themes', 'subscribedThemeIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Theme::class);
        return view('themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Theme::class);
        $request->validate([
            'theme_name' => 'required|string|max:255',
            'theme_description' => 'nullable|string',
        ]);

        Theme::create($request->all());

        return redirect()->route('themes.index')->with('success', 'Theme created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        $this->authorize('update', $theme);
        return view('themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        $this->authorize('update', $theme);
        $request->validate([
            'theme_name' => 'required|string|max:255',
            'theme_description' => 'nullable|string',
        ]);

        $theme->update($request->all());
        return redirect()->route('themes.index')->with('success', 'Theme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        $this->authorize('delete', $theme);
        $theme->delete();
        return redirect()->route('themes.index')->with('success', 'Theme deleted successfully.');
    }
}
