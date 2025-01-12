<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::all();
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publication_date' => 'nullable|date',
            'is_public' => 'nullable|boolean',
        ]);
        Issue::create($request->all());
        return redirect()->route('issues.index')->with('success', 'Issue created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publication_date' => 'nullable|date',
            'is_public' => 'nullable|boolean',
        ]);
        $issue->update($request->all());
        return redirect()->route('issues.index')->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'Issue deleted successfully.');
    }
}
