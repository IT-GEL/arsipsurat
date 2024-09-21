<?php

namespace App\Http\Controllers;

use App\Models\MSS;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the current month number
        $monthNumber = date('n'); // 'n' returns the numeric representation of the month (1 to 12)
        
        // Calculate the Roman numeral for the current month
        $romanMonth = monthToRoman($monthNumber); // Ensure monthToRoman function is available and included
    
        // Fetch the maximum noSurat values
        $maxNoSuratFCO = MSS::where('idPerihal', '1')->max('noSurat') ?? 0;
        $maxNoSuratBA = MSS::where('idPerihal', '2')->max('noSurat') ?? 0;
        $maxNoSuratBAS = MSS::where('idPerihal', '3')->max('noSurat') ?? 0;
        $maxNoSuratBAVP = MSS::where('idPerihal', '4')->max('noSurat') ?? 0;
        $maxNoSuratTT = MSS::where('idPerihal', '7')->max('noSurat') ?? 0;
        $maxNoSurat = MSS::where('idPerihal', '6')->max('noSurat') ?? 0;

        
    
        // Pass the variables to the view
        return view('dashboard.mss.create', [
            'title' => 'MSS',
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
            'maxNoSuratFCO' => $maxNoSuratFCO, // Pass max noSurat FCO
            'maxNoSuratBA' => $maxNoSuratBA, // Pass max noSurat BA
            'maxNoSuratBAS' => $maxNoSuratBA, // Pass max noSurat BA
            'maxNoSuratBAVP' => $maxNoSuratBAVP, // Pass max noSurat BA
            'maxNoSuratTT' => $maxNoSuratBAVP, // Pass max noSurat BA
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
            'kop' => 'required|string|max:255',
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
        ]);
    
        MSS::create($validatedData);
    
        return redirect('/dashboard/mss')->with('success', 'Surat berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MSS  $mss
     * @return \Illuminate\Http\Response
     */
    public function show(MSS $mss)
    {
        return view('dashboard.mss.show', [
            'title' => 'MSS',
            'mss' => $mss,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MSS  $mss
     * @return \Illuminate\Http\Response
     */
    public function edit(MSS $mss)
    {
                // Get the month number from the 'tglSurat' attribute
                $monthNumber = \Carbon\Carbon::parse($mss->tglSurat)->month;
    
                // Calculate the Roman month representation
                $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        return view('dashboard.mss.edit', [
            'title' => 'Edit',
            'mss' => $mss,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MSS  $mss
     * @return \Illuminate\Http\Response
     */
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
        'approve' => 'nullable|string|max:255',
        'qr' => 'nullable|string|max:255',
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
    dd($request->all()); // Check incoming data

    $rules = [
        'approve' => 'required|string|max:255', // This field should be required
        'qr' => 'nullable|string|max:255',
    ];

    // Optional: Validate noSurat if necessary
    if ($request->has('noSurat') && $request->noSurat != $mss->noSurat) {
        $rules['noSurat'] = 'required|numeric|unique:mss';
    }

    // Validate the request
    $validatedData = $request->validate($rules);

    // Update the model with validated data
    $mss->approve($validatedData);

    return redirect('/dashboard/mss')->with('success', 'Surat berhasil diapprove!');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MSS  $mss
     * @return \Illuminate\Http\Response
     */
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
