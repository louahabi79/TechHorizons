<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,theme_id',
        ]);
        $themeId =  $request->theme_id;
        $userId = Auth::id();
        $subscription = Subscription::where('theme_id', $themeId)
            ->where('user_id', $userId)->first();
        if (!$subscription) {
            Subscription::create([
                'theme_id' => $themeId,
                'user_id' => $userId,
            ]);
        } else {
            Subscription::where('theme_id', $themeId)
                ->where('user_id', $userId)->delete();
        }

        return redirect()->route('themes.index')->with('success', 'Subscription updated successfully.');
    }
}
