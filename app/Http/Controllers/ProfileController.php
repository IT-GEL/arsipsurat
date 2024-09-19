<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PR;

class ProfileController extends Controller
{
    public function index()
    {
        return view(
            'profile.index',
            [
                'title' => 'Profile',
            ]
        );
    }
}
