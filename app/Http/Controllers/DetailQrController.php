<?php

namespace App\Http\Controllers;

use App\Models\DetailQr;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter; // Import the writer
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class DetailQrController extends Controller
{
    // Function to display the details of the QR code
    public function index($id)
    {
        $detail = DetailQr::find($id);

        if (!$detail) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('detail_qr.index', [
            'detail' => $detail,
        ]);
    }
}
