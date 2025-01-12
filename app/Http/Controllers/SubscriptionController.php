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
        $subscription = Subscription::where('theme_id', $request->theme_id)->where('user_id', Auth::id())->first();
        if (!$subscription) {
            Subscription::create([
                'theme_id' => $request->theme_id,
                'user_id' => Auth::id(),
            ]);
        } else {
            $subscription->delete();
        }

        return redirect()->route('themes.index')->with('success', 'Subscription updated successfully.');
    }
}
