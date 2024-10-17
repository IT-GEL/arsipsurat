<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\IT;
use App\Models\DetailQr;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Log;

class DashboardITController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $it = IT::latest()->paginate(8);
    $totalIT = IT::count();

    // Add romanMonth to each IT item
    $it->getCollection()->transform(function ($item) {
        $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
        $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
        return $item;
    });

    return view('dashboard.it.index', [
        'title' => 'Surat IT',
        'its' => $it,
        'totalIT' => $totalIT,
    ]);
}

public function feedback()
{
    $fd = Feedback::latest()->paginate(8);

    return view('dashboard.it.feedback-show', [
        'title' => 'Feedback Show',
        'fd' => $fd,
    ]);
}

public function fsshow($id)
{

    $fd = Feedback::find($id);
    return view('dashboard.it.feedback-detail', [
        'title' => 'Feedback Detail',
        'fd' => $fd,
    ]);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

          // Get the current month number
          $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
          $romanMonth = monthToRoman($monthNumber);

          // $maxNoSuratInternalMemo = TNC::where('idPerihal', '1')->max('noSurat') ?? 0;
          // $maxNoSuratWaskita = TNC::where('idPerihal', '2')->max('noSurat') ?? 0;

        //   $kopCounts = [
        //       'GEL' => IT::where('kop', 'GEL')->where('idPerihal', 1)->count(),
        //       'QIN' => IT::where('kop', 'QIN')->where('idPerihal', 1)->count(),
        //       'ERA' => IT::where('kop', 'ERA')->where('idPerihal', 1)->count(),
        //       'GCR' => IT::where('kop', 'GCR')->where('idPerihal', 1)->count(),
        //       'KKS' => IT::where('kop', 'KKS')->where('idPerihal', 1)->count(),
        //   ];

          $maxNoSuratPerihal1 = IT::where('idPerihal', '1')->max('noSurat') ?? 0;
          $maxNoSuratPerihal2 = IT::where('idPerihal', '4')->max('noSurat') ?? 0;
          $maxNoSuratPerihal3 = IT::where('idPerihal', '3')->max('noSurat') ?? 0;


        return view('dashboard.it.create', [
            'title' => 'IT',
            'romanMonth' => $romanMonth,
            // 'maxNoSuratInternalMemo' => $maxNoSuratInternalMemo,
            // 'maxNoSuratWaskita' => $maxNoSuratWaskita,
            // 'kopCounts' => $kopCounts,
            'maxNoSuratPerihal1' => $maxNoSuratPerihal1,
            'maxNoSuratPerihal2' => $maxNoSuratPerihal2,
            'maxNoSuratPerihal3' => $maxNoSuratPerihal3,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'perihal' => 'required',
            'perihalLanjutan' => 'nullable|string',
            'idPerihal' => 'required',
            'prefix' => 'required',
            'noSurat' => 'required|numeric',
            'nama' => 'nullable|string',
            'noKaryawan' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'divisi' => 'nullable|string',
            'departement' => 'nullable|string',
            'hardware' => 'nullable|string',
            'software' => 'nullable|string',
            'specProblem' => 'nullable|string',
            'kop' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'tglSurat' => 'required|date',
            'ettd' => 'nullable|string',
            'ttd' => 'nullable|string|max:255',
            'namaTtd' => 'nullable|string|max:255',
        ]);

        IT::create($validatedData);

        return redirect('/dashboard/it')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function show(IT $it)
    {
        return view('dashboard.it.show', [
            'title' => 'IT',
            'it' => $it,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function edit(IT $it)
    {
        // Get the month number from the 'tglSurat' attribute
        $monthNumber = \Carbon\Carbon::parse($it->tglSurat)->month;

        // Calculate the Roman month representation
        $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        return view('dashboard.it.edit', [
            'title' => 'Edit',
            'it' => $it,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IT $it)
{

    $rules = [
        'perihal' => 'required',
            'noSurat' => 'required|numeric',
            'nama' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'keterangan' => 'required',
            'tglSurat' => 'required|date',
            'ettd' => 'max:255',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
    ];

    if ($request->noSurat != $it->noSurat) {
        $rules['noSurat'] = 'required|numeric|unique:its';
    }

    $validatedData = $request->validate($rules);

    IT::where('id', $it->id)
        ->update($validatedData);

    return redirect('/dashboard/it')->with('success', 'Surat berhasil di edit!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function destroy(IT $it)
    {
        IT::destroy($it->id);

        return redirect('/dashboard/it')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(IT $it)
    {
        // Get the month number from the 'tglSurat' attribute
        $monthNumber = \Carbon\Carbon::parse($it->tglSurat)->month;

        // Calculate the Roman month representation
        $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        // Pass the 'romanMonth' along with the 'IT' model to the view
        return view('dashboard.it.cetak', [
            'title' => 'IT',
            'it' => $it,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
        ]);
    }

    public function approve(Request $request, IT $it)
    {
        try {
            $validatedData = $request->validate(['approve' => 'required|string|max:255']);

            // Check user authentication
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            // Update status persetujuan
            $it->approve = 1;
            $it->qr = "QRIT{$it->id}.png"; // Example QR file name
            $it->save();

            // Create an instance of the DetailQr model
            $dqr = new DetailQr();
            $dqr->nosurat = $it->prefix; // Store the prefix
            $dqr->nama = $user->name;
            $dqr->NIK = $user->NIK;
            $dqr->jabatan = $user->Jabatan;
            $dqr->qr = $it->qr;
            $dqr->approve_at = now(); // Use current timestamp
            // Save the detail_qr record
            $dqr->save();

            // Generate and save the QR code
            $this->generateQRCode($dqr);

            return redirect('/dashboard/it')->with('success', 'Surat berhasil diapprove!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/dashboard/it')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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



}
