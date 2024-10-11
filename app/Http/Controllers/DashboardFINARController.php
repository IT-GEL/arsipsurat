<?php

namespace App\Http\Controllers;

use App\Models\FINAR;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardFINARController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.finar.index', [
            'title' => 'Surat Divisi',
            'finar' => FINAR::latest()->paginate(8),
            'totalFINAR' => FINAR::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.finar.create', [
            'title' => 'FINAR',
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
            'nama' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'keterangan' => 'required',
            'tglSurat' => 'required|date',
            'ettd' => 'max:255',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ]);

        FINAR::create($validatedData);

        return redirect('/dashboard/finar')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FINAR  $finar
     * @return \Illuminate\Http\Response
     */
    public function show(FINAR $finar)
    {
        return view('dashboard.finar.show', [
            'title' => 'FINAR',
            'finar' => $finar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FINAR  $finar
     * @return \Illuminate\Http\Response
     */
    public function edit(FINAR $finar)
    {
        return view('dashboard.finar.edit', [
            'title' => 'Edit',
            'finar' => $finar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FINAR  $finar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FINAR $finar)
    {
        $rules = [
            'perihal' => 'required',
            'nama' => 'required|max:255',
            'jabatan' => 'required',
            'divisi' => 'required',
            'keterangan' => 'required|max:255',
            'tglSurat' => 'required|date',
            'ettd' => 'required|max:255',
            'ttd' => 'required|max:255',
            'namaTtd' => 'required|max:255',
        ];

        if ($request->noSurat != $finar->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:finar';
        }

        $validatedData = $request->validate($rules);

        FINAR::where('id', $finar->id)
            ->update($validatedData);

        return redirect('/dashboard/finar')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FINAR  $finar
     * @return \Illuminate\Http\Response
     */
    public function destroy(FINAR $finar)
    {
        FINAR::destroy($finar->id);

        return redirect('/dashboard/finar')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(FINAR $finar)
    {
        return view('dashboard.finar.cetak', [
            'title' => 'FINAR',
            'finar' => $finar,
        ]);
    }
}
