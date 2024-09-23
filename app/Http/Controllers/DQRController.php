<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DQR; // Tambahkan Model Profile

class DQRController extends Controller
{
    public function index($id)
    {
        // Ambil semua data dari tabel profile
        $detailQR = DQR::find($id);

        return view('dqr.index', [
            'title' => 'Profile',
            'dqr' => $dqr, // Kirim data ke view
            
        ]);
    }
}