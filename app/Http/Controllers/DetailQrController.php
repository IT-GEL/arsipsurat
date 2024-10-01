<?php

namespace App\Http\Controllers;

use App\Models\DetailQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DetailQrController extends Controller
{
    // Function to display the details of the QR code
    public function index($id)
    {
        $detail = DetailQr::find($id);

        if (!$detail) {
            Log::error("Detail not found for ID: {$id}");
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('detail_qr.index', [
            'detail' => $detail,
        ]);
    }
}
