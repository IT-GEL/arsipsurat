<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PR; // Tambahkan Model Profile

class ProfileController extends Controller
{
    public function index($id)
    {
        // Ambil semua data dari tabel profile
        $profiles = PR::find($id);

        return view('profile.index', [
            'title' => 'Profile',
            'profiles' => $profiles, // Kirim data ke view
            
        ]);
    }
}