<?php

namespace App\Http\Controllers;

use App\Models\GA;
use Illuminate\Http\Request;
use PDF;

class DashboardGAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ga = GA::latest()->paginate(8);
        $totalGA = GA::count();

        // Add romanMonth to each GA item
        $ga->getCollection()->transform(function ($item) {
            $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
            $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
            return $item;
        });

        return view('dashboard.ga.index', [
            'title' => 'GA',
            'ga' => $ga,
            'totalGA' => $totalGA,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ga.create', [
            'title' => 'GA',
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
            'noSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'pt' => 'required|numeric',
            'vendor' => 'required|max:255',
            'alamat' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        GA::create($validatedData);

        return redirect('/dashboard/ga')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function show(GA $ga)
    {
        // Add romanMonth to the specific GA item
        $monthNumber = \Carbon\Carbon::parse($ga->tglSurat)->month;
        $ga->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
    
        return view('dashboard.ga.show', [
            'title' => 'GA',
            'ga' => $ga,
            'romanMonth' => $ga->romanMonth, // Pass the Roman month to the view
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function edit(GA $ga)
    {
        return view('dashboard.ga.edit', [
            'title' => 'GA',
            'ga' => $ga,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GA $ga)
    {
        $rules = [
            'noSurat' => 'required|numeric',
            'nama' => 'required|max:255',
            'pt' => 'required|numeric',
            'vendor' => 'required|max:255',
            'alamat' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'tglSurat' => 'required|date',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ];

        if ($request->noSurat != $ga->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:ga';
        }

        $validatedData = $request->validate($rules);

        $ga->update($validatedData);

        return redirect('/dashboard/ga')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GA  $ga
     * @return \Illuminate\Http\Response
     */
    public function destroy(GA $ga)
    {
        $ga->delete();

        return redirect('/dashboard/ga')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(GA $ga)
    {
        $pdf = PDF::loadview('dashboard.ga.cetak', [
            'title' => 'Cetak',
            'ga' => $ga,
        ])->setPaper('a4', 'potrait');

        return $pdf->stream('ga_' . $ga->noSurat . '.pdf');
    }
}
