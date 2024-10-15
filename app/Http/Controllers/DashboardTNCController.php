<?php

namespace App\Http\Controllers;

use App\Models\TNC;
use App\Models\DetailQr;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;


class DashboardTNCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tnc = TNC::latest()->paginate(8);
        $totalTNC = TNC::count();

        // Add romanMonth to each TNC item
        $tnc->getCollection()->transform(function ($item) {
            $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
            $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
            return $item;
        });

        return view('dashboard.tnc.index', [
            'title' => 'Surat Divisi',
            'tnc' => $tnc,
            'totalTNC' => $totalTNC,
        ]);
    }

    public function create()
    {
        // Get the current month number
        $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
        $romanMonth = monthToRoman($monthNumber);

        // $maxNoSuratInternalMemo = TNC::where('idPerihal', '1')->max('noSurat') ?? 0;
        // $maxNoSuratWaskita = TNC::where('idPerihal', '2')->max('noSurat') ?? 0;

        $kopCounts = [
            'GEL' => TNC::where('kop', 'GEL')->where('idPerihal', 1)->count(),
            'QIN' => TNC::where('kop', 'QIN')->where('idPerihal', 1)->count(),
            'ERA' => TNC::where('kop', 'ERA')->where('idPerihal', 1)->count(),
            'GCR' => TNC::where('kop', 'GCR')->where('idPerihal', 1)->count(),
        ];

        $maxNoSuratPerihal1 = TNC::where('idPerihal', '1')->max('noSurat') ?? 0;
        $maxNoSuratPerihal3 = TNC::where('idPerihal', '3')->max('noSurat') ?? 0;
        $maxNoSuratPerihal4 = TNC::where('idPerihal', '4')->max('noSurat') ?? 0;
        $maxNoSuratPerihal5 = TNC::where('idPerihal', '5')->max('noSurat') ?? 0;
        $maxNoSuratPerihal6 = TNC::where('idPerihal', '6')->max('noSurat') ?? 0;
        $maxNoSuratPerihal7 = TNC::where('idPerihal', '7')->max('noSurat') ?? 0;

        // If idPerihal is 2, get the max noSurat
        if (TNC::where('idPerihal', 2)->exists()) {
            $maxNoSuratPerihal2 = TNC::where('idPerihal', 2)->max('noSurat');
        } else {
            $maxNoSuratPerihal2 = 0;
        }


       return view('dashboard.tnc.create', [
        'title' => 'TNC',
        'romanMonth' => $romanMonth,
        // 'maxNoSuratInternalMemo' => $maxNoSuratInternalMemo,
        // 'maxNoSuratWaskita' => $maxNoSuratWaskita,
        'kopCounts' => $kopCounts,
        'maxNoSuratPerihal1' => $maxNoSuratPerihal1,
        'maxNoSuratPerihal2' => $maxNoSuratPerihal2,
        'maxNoSuratPerihal3' => $maxNoSuratPerihal3,
        'maxNoSuratPerihal4' => $maxNoSuratPerihal4,
        'maxNoSuratPerihal5' => $maxNoSuratPerihal5,
        'maxNoSuratPerihal6' => $maxNoSuratPerihal6,
        'maxNoSuratPerihal7' => $maxNoSuratPerihal7,
    ]);

    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'noSurat' => 'required|numeric',
            'idPerihal' => 'required|numeric',
            'perihal' => 'required|string',
            'prefix' => 'required|string|max:255',
            'divisi' => 'nullable|string',
            'tujuanSurat' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'namaKaryawan' => 'nullable|string',
            'idKaryawan' => 'nullable|string',
            'jabatanAwal' => 'nullable|string',
            'jabatanBaru' => 'nullable|string',
            'tglEfektif' => 'nullable|date',
            'nik' => 'nullable|string',
            'tempatLahir' => 'nullable|string',
            'tanggalLahir' => 'nullable|date',
            'jenisKelamin' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'alamat' => 'nullable|string',
            'tanggalMasukKerja' => 'nullable|date',
            'jabatan' => 'nullable|string',
            'departement' => 'nullable|string',
            'startingDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'tmptTGL' => 'nullable|string',
            'tglSurat' => 'nullable|date',
            'jml_lampiran' => 'nullable|string|max:255',
            'lampiran' => 'nullable|string|max:255',
            'kop' => 'nullable|string|max:255',
            'approve' => 'nullable|numeric|max:255',

        ]);

        TNC::create($validatedData);

        return redirect('/dashboard/tnc')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(TNC $tnc)
    {
        return view('dashboard.tnc.show', [
            'title' => 'TNC',
            'tnc' => $tnc,
        ]);
    }

    public function edit(TNC $tnc)
    {
        $monthNumber = \Carbon\Carbon::parse($tnc->tglSurat)->month;
        $romanMonth = monthToRoman($monthNumber);

        return view('dashboard.tnc.edit', [
            'title' => 'Edit',
            'tnc' => $tnc,
            'romanMonth' => $romanMonth,
        ]);
    }

    public function update(Request $request, TNC $tnc)
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
        ];

        if ($request->noSurat != $tnc->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:tnc';
        }

        $validatedData = $request->validate($rules);

        $tnc->update($validatedData);

        return redirect('/dashboard/tnc')->with('success', 'Surat berhasil di edit!');
    }

    public function approve(Request $request, TNC $tnc)
    {
        try {
            $validatedData = $request->validate(['approve' => 'required|string|max:255']);

            // Check user authentication
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Update status persetujuan
            $tnc->approve = 1;
            $tnc->qr = "QRTNC{$tnc->id}.png"; // Example QR file name
            $tnc->save();

            // Create an instance of the DetailQr model
            $dqr = new DetailQr();
            $dqr->nosurat = $tnc->prefix; // Store the prefix
            $dqr->nama = $user->name;
            $dqr->NIK = $user->NIK;
            $dqr->jabatan = $user->Jabatan;
            $dqr->qr = $tnc->qr;
            $dqr->approve_at = now(); // Use current timestamp
            // Save the detail_qr record
            $dqr->save();

            // Generate and save the QR code
            $this->generateQRCode($dqr);

            return redirect('/dashboard/tnc')->with('success', 'Surat berhasil diapprove!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/dashboard/tnc')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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






    public function destroy(TNC $tnc)
    {
        TNC::destroy($tnc->id);

        return redirect('/dashboard/tnc')->with('success', 'Surat berhasil dihapus!');


    }

    public function cetak(TNC $tnc)
    {
        return view('dashboard.tnc.cetak', [
            'title' => 'TNC',
            'tnc' => $tnc,
        ]);
    }
}
