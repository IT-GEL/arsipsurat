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
        return view('dashboard.mss.index', [
            'title' => 'Surat Divisi',
            'mss' => MSS::latest()->paginate(8),
            'totalMSS' => MSS::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mss.create', [
            'title' => 'MSS',
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
            'noSurat' => 'required|numeric',
            'pttujuan' => 'required',
            'alamat' => 'required',
            'commodity' => 'required',
            'source' => 'required',
            'country' => 'required',
            'spec' => 'required',
            'vo' => 'required',
            'qty' => 'required|numeric',
            'lp' => 'required',
            'dp' => 'required',
            'cif' => 'required|numeric',
            'fob' => 'required|numeric',
            'freight' => 'required|numeric',
            'shipschedule' => 'required',
            'tcd' => 'required',
            'surveyor' => 'required',
            'tglSurat' => 'required|date',
            'ettd' => 'max:255',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        MSS::create($validatedData);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IT  $mss
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
        return view('dashboard.mss.edit', [
            'title' => 'Edit',
            'mss' => $mss,
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
            'perihal' => 'required',
            'noSurat' => 'required|numeric',
            'pttujuan' => 'required',
            'alamat' => 'required',
            'commodity' => 'required',
            'source' => 'required',
            'country' => 'required',
            'spec' => 'required',
            'vo' => 'required',
            'qty' => 'required|numeric',
            'lp' => 'required',
            'dp' => 'required',
            'cif' => 'required|numeric',
            'fob' => 'required|numeric',
            'freight' => 'required|numeric',
            'shipschedule' => 'required',
            'tcd' => 'required',
            'surveyor' => 'required',
            'tglSurat' => 'required|date',
            'ettd' => 'max:255',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ];

        if ($request->noSurat != $mss->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:mss';
        }

        $validatedData = $request->validate($rules);

        MSS::where('id', $mss->id)
            ->update($validatedData);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MSS  $mss
     * @return \Illuminate\Http\Response
     */
    public function destroy(MSS $mss)
    {
        IT::destroy($mss->id);

        return redirect('/dashboard/mss')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(MSS $mss)
    {
        return view('dashboard.mss.cetak', [
            'title' => 'MSS',
            'it' => $mss,
        ]);
    }
}
