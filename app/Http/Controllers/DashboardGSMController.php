<?php

namespace App\Http\Controllers;

use App\Models\GSM;
use App\Models\DetailQr;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;


class DashboardGSMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gsm = GSM::latest()->paginate(8);
        $totalGSM = GSM::count();

        // Add romanMonth to each GSM item
        $gsm->getCollection()->transform(function ($item) {
            $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
            $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
            return $item;
        });

        return view('dashboard.gsm.index', [
            'title' => 'Surat Divisi',
            'gsm' => $gsm,
            'totalGSM' => $totalGSM,
        ]);
    }

    public function create()
    {
        // Get the current month number
        $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
        $romanMonth = monthToRoman($monthNumber);


       return view('dashboard.gsm.create', [
        'title' => 'GSM',
        'romanMonth' => $romanMonth,
    ]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'noSurat' => 'required|numeric',
            'prefix' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tglSurat' => 'nullable|date',
            'ttd' => 'nullable|string|max:255',
            'y_buat' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'lampiran' => 'nullable|string|max:255',
            'approve' => 'nullable|number|max:255',

        ]);

        GSM::create($validatedData);

        return redirect('/dashboard/gsm')->with('success', 'Surat berhasil ditambahkan!');
    }

    public function show(GSM $gsm)
    {
        return view('dashboard.gsm.show', [
            'title' => 'GSM',
            'gsm' => $gsm,
        ]);
    }

    public function edit(GSM $gsm)
    {
        $monthNumber = \Carbon\Carbon::parse($gsm->tglSurat)->month;
        $romanMonth = monthToRoman($monthNumber);

        return view('dashboard.gsm.edit', [
            'title' => 'Edit',
            'gsm' => $gsm,
            'romanMonth' => $romanMonth,
        ]);
    }

    public function update(Request $request, GSM $gsm)
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

        if ($request->noSurat != $gsm->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:gsm';
        }

        $validatedData = $request->validate($rules);

        $gsm->update($validatedData);

        return redirect('/dashboard/gsm')->with('success', 'Surat berhasil di edit!');
    }

    public function approve(Request $request, GSM $gsm)
    {
        try {
            $validatedData = $request->validate(['approve' => 'required|string|max:255']);

            // Check user authentication
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Update status persetujuan
            $gsm->approve = 1;
            $gsm->qr = "QRGSM{$gsm->id}.png"; // Example QR file name
            $gsm->save();

            // Create an instance of the DetailQr model
            $dqr = new DetailQr();
            $dqr->nosurat = $gsm->prefix; // Store the prefix
            $dqr->nama = $user->name;
            $dqr->NIK = $user->NIK;
            $dqr->jabatan = $user->Jabatan;
            $dqr->qr = $gsm->qr;
            $dqr->approve_at = now(); // Use current timestamp
            // Save the detail_qr record
            $dqr->save();

            // Generate and save the QR code
            $this->generateQRCode($dqr);

            return redirect('/dashboard/gsm')->with('success', 'Surat berhasil diapprove!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/dashboard/gsm')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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






    public function destroy(GSM $gsm)
    {
        GSM::destroy($gsm->id);

        return redirect('/dashboard/gsm')->with('success', 'Surat berhasil dihapus!');


    }

    public function cetak(GSM $gsm)
    {
        return view('dashboard.gsm.cetak', [
            'title' => 'GSM',
            'gsm' => $gsm,
        ]);
    }
}
