<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index', [
            'title' => 'Feedback',
        ]);
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'feedback' => 'required|string',
            'acc' => 'required|string|max:255', // Validate acc as a required string
            'users' => 'required|string|max:255', // Validate users
            'status' => 'required|string|max:255', // Validate users
        ]);

        // Store the feedback in the database
        Feedback::create([
            'feedback' => $request->input('feedback'),
            'acc' => Auth::user()->name, // Get the authenticated user's name
            'users' => $request->input('users'), // Account field from the request
            'status' => $request->input('status'), // Account field from the request

        ]);

        // Return JSON response for AJAX
        return response()->json(['message' => 'Feedback submitted successfully!'], 200);
    }

}
