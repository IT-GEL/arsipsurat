<?php

namespace App\Http\Controllers;

use App\Models\PRC;
use App\Models\DetailQr;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;


class DashboardPRCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prc = PRC::latest()->paginate(8);
        $totalPRC = PRC::count();

        // Add romanMonth to each PRC item
        $prc->getCollection()->transform(function ($item) {
            $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
            $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
            return $item;
        });

        return view('dashboard.prc.index', [
            'title' => 'Surat Divisi',
            'prc' => $prc,
            'totalPRC' => $totalPRC,
        ]);
    }

    public function create()
    {
        // Get the current month number
        $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
        $romanMonth = monthToRoman($monthNumber);
        $maxNoSuratKeagenan = PRC::where('idPerihal', '1')->max('noSurat') ?? 0;


        return view('dashboard.prc.create', [
            'title' => 'PRC',
            'romanMonth' => $romanMonth,
            'maxNoSuratKeagenan' => $maxNoSuratKeagenan,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'noSurat' => 'required|numeric',
            'idPerihal' => 'required|numeric',
            'perihal' => 'required|string',
            'prefixPO' => 'required|string|max:255',
            'prefixPR' => 'required|string|max:255',
            'prefixQuote' => 'required|string|max:255',
            'kop' => 'nullable|string|max:255',
            'vendor' => 'nullable|string|max:255',
            'faxno' => 'nullable|string|max:255',
            'att' => 'nullable|string|max:255',
            'prefixPR' => 'nullable|string|max:255',
            'prefixQuote' => 'nullable|string|max:255',
            'items' => 'required|array',
            'devdate' => 'nullable|string|max:255',
            'devto' => 'nullable|string|max:255',
            'tmpt' => 'nullable|string|max:255',
            'tglSurat' => 'nullable|date',
            'ttd' => 'nullable|string|max:255',
            'y_buat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'lampiran' => 'nullable|string|max:255',
            'approve' => 'nullable|numeric|max:255',
        ]);

        $itemsJson = json_encode($validatedData['items']);

        $validatedData['items'] = $itemsJson;

        PRC::create($validatedData);

        return redirect('/dashboard/prc')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(PRC $prc)
    {
        $itemsArray = json_decode($prc->items, true);

        return view('dashboard.prc.show', [
            'title' => 'PRC',
            'prc' => $prc,
            'items' => $itemsArray,
        ]);
    }

    public function edit(PRC $prc)
    {
        $items = json_decode($prc->items, true);

        $monthNumber = \Carbon\Carbon::parse($prc->tglSurat)->month;
        $romanMonth = monthToRoman($monthNumber);

        return view('dashboard.prc.edit', [
            'title' => 'Edit',
            'prc' => $prc,
            'romanMonth' => $romanMonth,
            'items' => $items,
        ]);
    }

    public function update(Request $request, PRC $prc)
    {
        $rules = [
            'idPerihal' => 'required|numeric|max:255',
            'perihal' => 'required|string|max:255',
            'perihalBA' => 'nullable|string|max:255',
            'noSurat' => 'required|numeric',
            'pttujuan' => 'nullable|string|max:255',
            'ptkunjungan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'att' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'commodity' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'spec' => 'nullable|string|max:255',
            'vo' => 'nullable|date',
            'qty' => 'nullable|numeric',
            'lp' => 'nullable|string|max:255',
            'dp' => 'nullable|string|max:255',
            'matauang' => 'nullable|string|max:255',
            'cif' => 'nullable|numeric',
            'fob' => 'nullable|numeric',
            'freight' => 'nullable|numeric',
            'shipschedule' => 'nullable|string|max:255',
            'tcd' => 'nullable|string|max:255',
            'surveyor' => 'nullable|string|max:255',
            'qas' => 'nullable|string',
            'top' => 'nullable|string|max:255',
            'tglSurat' => 'nullable|date',
            'ettd' => 'nullable|string|max:255',
            'ttd' => 'nullable|string|max:255',
            'namaTtd' => 'nullable|string|max:255',
        ];

        if ($request->noSurat != $prc->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:prc';
        }

        $validatedData = $request->validate($rules);

        $prc->update($validatedData);

        return redirect('/dashboard/prc')->with('success', 'Surat berhasil di edit!');
    }

    public function approve(Request $request, PRC $prc)
    {
        try {
            $validatedData = $request->validate(['approve' => 'required|string|max:255']);

            // Check user authentication
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Update status persetujuan
            $prc->approve = 1;
            $prc->qr = "QRGSM{$prc->id}.png"; // Example QR file name
            $prc->save();

            // Create an instance of the DetailQr model
            $dqr = new DetailQr();
            $dqr->nosurat = $prc->prefix; // Store the prefix
            $dqr->nama = $user->name;
            $dqr->NIK = $user->NIK;
            $dqr->jabatan = $user->Jabatan;
            $dqr->qr = $prc->qr;
            $dqr->approve_at = now(); // Use current timestamp
            // Save the detail_qr record
            $dqr->save();

            // Generate and save the QR code
            $this->generateQRCode($dqr);

            return redirect('/dashboard/prc')->with('success', 'Surat berhasil diapprove!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/dashboard/prc')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Helper method to generate QR code
    private function generateQRCode(DetailQr $dqr)
    {

        $host = $_SERVER['HTTP_HOST']; // Get the host header from the request
        // Create a QR Code with the detailQr data
        $qrData = "http://{$host}/detailQR/{$dqr->id}";

        $qrCode = QrCode::create($qrData)
            ->setSize(300)
            ->setMargin(10);

        $path = public_path("img/qrcodes");
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filePath = "{$path}/{$dqr->qr}";

        try {
            $writer = new \Endroid\QrCode\Writer\PngWriter(); // Ensure this line is present
            $writer->write($qrCode)->saveToFile($filePath);

            // Check if the file was created successfully
            if (file_exists($filePath)) {
                Log::info("QR code generated successfully at: {$filePath}");
            } else {
                Log::error("Failed to generate QR code at: {$filePath}");
            }
        } catch (\Exception $e) {
            Log::error("Error generating QR code: " . $e->getMessage());
        }
    }






    public function destroy(PRC $prc)
    {
        PRC::destroy($prc->id);

        return redirect('/dashboard/prc')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(PRC $prc)
    {
        return view('dashboard.prc.cetak', [
            'title' => 'PRC',
            'prc' => $prc,
        ]);
    }
}
