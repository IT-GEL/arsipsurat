<?php

namespace App\Http\Controllers;

use App\Models\FeedbackModels;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index', [
            'title' => 'Feedback',
        ]);
    }
}
