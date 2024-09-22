<?php

namespace App\Http\Controllers;

use App\Models\MSS;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

        return view('dashboard.mss.create', [
            'title' => 'MSS',
            'romanMonth' => $romanMonth,
            'maxNoSuratFCO' => $maxNoSuratFCO,
            'maxNoSuratSI' => $maxNoSuratSI,
            'maxNoSuratBA' => $maxNoSuratBA,
            'maxNoSuratTT' => $maxNoSuratTT,
        ]);
    }

    public function store(Request $request)
    {
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
            'keterangan' => 'nullable|string|max:9999',
            'commodity' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'spec' => 'nullable|string|max:255',
            'vo' => 'nullable|date',
            'qty' => 'nullable|numeric',
            'lp' => 'nullable|string|max:255',
            'dp' => 'nullable|string|max:255',
            'cif' => 'nullable|numeric',
            'fob' => 'nullable|numeric',
            'freight' => 'nullable|numeric',
            'shipschedule' => 'nullable|string|max:255',
            'tcd' => 'nullable|string|max:255',
            'surveyor' => 'nullable|string|max:255',
            'tglSurat' => 'nullable|date',
            'ettd' => 'nullable|string|max:255',
            'ttd' => 'nullable|string|max:255',
            'namaTtd' => 'nullable|string|max:255',
        ]);

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
            'noSurat' => 'required|numeric',
            'prefix' => 'required|string|max:255',
            'pttujuan' => 'nullable|string|max:255',
            'ptkunjungan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:9999',
            'commodity' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'spec' => 'nullable|string|max:255',
            'vo' => 'nullable|date',
            'qty' => 'nullable|numeric',
            'lp' => 'nullable|string|max:255',
            'dp' => 'nullable|string|max:255',
            'cif' => 'nullable|numeric',
            'fob' => 'nullable|numeric',
            'freight' => 'nullable|numeric',
            'shipschedule' => 'nullable|string|max:255',
            'tcd' => 'nullable|string|max:255',
            'surveyor' => 'nullable|string|max:255',
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'approve' => 'required|string|max:255',
            'qr' => 'nullable|string|max:255',
        ]);

        // Update the Approval field to 1
        $mss->Approval = 1; // Ensure 'Approval' is the correct field name
        $mss->save(); // Save the changes to the database

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil diapprove!');
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
