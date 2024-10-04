<?php

namespace App\Http\Controllers;

use App\Models\MSS;
use App\Models\DetailQr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;


class DashboardMSSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mss = MSS::latest()->paginate(8);
        $totalMSS = MSS::count();

        // Add romanMonth to each MSS item
        $mss->getCollection()->transform(function ($item) {
            $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
            $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
            return $item;
        });

        return view('dashboard.mss.index', [
            'title' => 'Surat Divisi',
            'mss' => $mss,
            'totalMSS' => $totalMSS,
        ]);
    }

    public function create()
    {
        // Get the current month number
        $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
        $romanMonth = monthToRoman($monthNumber);

        // Fetch the maximum noSurat values
        $maxNoSuratFCO = MSS::where('idPerihal', '1')->max('noSurat') ?? 0;
        $maxNoSuratSI = MSS::where('idPerihal', '2')->max('noSurat') ?? 0;
        $maxNoSuratBA = MSS::where('idPerihal', '3')->max('noSurat') ?? 0;
        $maxNoSuratTT = MSS::where('idPerihal', '4')->max('noSurat') ?? 0;
        $maxNoSuratRIPFP = MSS::where('idPerihal', '5')->max('noSurat') ?? 0;
        $maxNoSuratLOI = MSS::where('idPerihal', '6')->max('noSurat') ?? 0;

       return view('dashboard.mss.create', [
            'title' => 'MSS',
            'romanMonth' => $romanMonth,
            'maxNoSuratFCO' => $maxNoSuratFCO,
            'maxNoSuratSI' => $maxNoSuratSI,
            'maxNoSuratBA' => $maxNoSuratBA,
            'maxNoSuratTT' => $maxNoSuratTT,
            'maxNoSuratRIPFP' => $maxNoSuratRIPFP,
            'maxNoSuratLOI' => $maxNoSuratLOI,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());


        $validatedData = $request->validate([
            'kop' => 'required|string|max:255',
            'idPerihal' => 'required|numeric|max:255',
            'perihal' => 'required|string|max:255',
            'perihalBA' => 'nullable|string|max:255',
            'noSurat' => 'required|numeric',
            'prefix' => 'required|string|max:255',
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
            'qas' => 'nullable|string|max:9999',
            'top' => 'nullable|string|max:255',
            'delivery_basis' => 'nullable|string|max:255',
            'contract_dur' => 'nullable|string|max:255',
            'po' => 'nullable|string|max:255',
            'tglSurat' => 'nullable|date',
            'ettd' => 'nullable|string|max:255',
            'ttd' => 'nullable|string|max:255',
            'namaTtd' => 'nullable|string|max:255',
            // 'lampiran' => 'nullable|string|max:255',

        ]);


        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validatedData['lampiran'] = $filename;
        }

        MSS::create($validatedData);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(MSS $mss)
    {
        return view('dashboard.mss.show', [
            'title' => 'MSS',
            'mss' => $mss,
        ]);
    }

    public function edit(MSS $mss)
    {
        $monthNumber = \Carbon\Carbon::parse($mss->tglSurat)->month;
        $romanMonth = monthToRoman($monthNumber);

        return view('dashboard.mss.edit', [
            'title' => 'Edit',
            'mss' => $mss,
            'romanMonth' => $romanMonth,
        ]);
    }

    public function update(Request $request, MSS $mss)
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

        if ($request->noSurat != $mss->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:mss';
        }

        $validatedData = $request->validate($rules);

        $mss->update($validatedData);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil di edit!');
    }

    public function approve(Request $request, MSS $mss)
    {
        try {
            $validatedData = $request->validate(['approve' => 'required|string|max:255']);

            // Check user authentication
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Update status persetujuan
            $mss->approve = 1;
            $mss->qr = "QRMSS{$mss->id}.png"; // Example QR file name
            $mss->save();

            // Create an instance of the DetailQr model
            $dqr = new DetailQr();
            $dqr->nosurat = $mss->prefix; // Store the prefix
            $dqr->nama = $user->name;
            $dqr->NIK = $user->NIK;
            $dqr->jabatan = $user->Jabatan;
            $dqr->qr = $mss->qr;
            $dqr->approve_at = now(); // Use current timestamp
            // Save the detail_qr record
            $dqr->save();

            // Generate and save the QR code
            $this->generateQRCode($dqr);

            return redirect('/dashboard/mss')->with('success', 'Surat berhasil diapprove!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/dashboard/mss')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }

    // Helper method to generate QR code
    private function generateQRCode(DetailQr $dqr)
    {

        $host = $_SERVER['HTTP_HOST']; // Get the host header from the request
        // Create a QR Code with the detailQr data
        $qrData = "http://{$host}:5555/detailQR/{$dqr->id}";

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






    public function destroy(MSS $mss)
    {
        MSS::destroy($mss->id);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil dihapus!');


    }

    public function cetak(MSS $mss)
    {
        return view('dashboard.mss.cetak', [
            'title' => 'MSS',
            'mss' => $mss,
        ]);
    }
}
