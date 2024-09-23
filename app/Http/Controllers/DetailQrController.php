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
    // Function to generate QR code for a given detail
    public function generateQr($id)
    {
        $detail = DetailQr::find($id);

        if (!$detail) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Generate QR code string
        $qrString = route('qr.show', $detail->id); // Use ID for URL

        // Create a new QR code instance
        $qrCode = QrCode::create($qrString)
            ->setSize(300)
            ->setMargin(10);

        // Create a PNG writer
        $writer = new PngWriter();

        // Write the QR code to a string
        $result = $writer->write($qrCode);

        // Define the storage path
        $fileName = 'qr_codes/qr_code_' . $detail->id . '.png';
        $filePath = public_path($fileName);

        // Save the QR code image to the local folder
        $result->saveToFile($filePath);

        // Convert QR code to base64 for display
        $qrCodeUrl = 'data:image/png;base64,' . base64_encode($result->getString());

        return view('detail_qr.generate', [
            'detail' => $detail,
            'qrCodeUrl' => $qrCodeUrl,
            'filePath' => $fileName, // Pass file path to the view if needed
        ]);
    }

    // Function to display the details of the QR code
    public function show($id)
    {
        $detail = DetailQr::find($id);

        if (!$detail) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('detail_qr.show', [
            'detail' => $detail,
        ]);
    }
}
