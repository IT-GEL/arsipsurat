<?php

namespace App\Http\Controllers;

use App\Models\FAR;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardFARController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.far.index', [
            'title' => 'Surat Divisi',
            'far' => FAR::latest()->paginate(8),
            'totalFAR' => FAR::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.far.create', [
            'title' => 'FAR',
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

        FAR::create($validatedData);

        return redirect('/dashboard/far')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FAR  $far
     * @return \Illuminate\Http\Response
     */
    public function show(FAR $far)
    {
        return view('dashboard.far.show', [
            'title' => 'FAR',
            'far' => $far,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FAr  $far
     * @return \Illuminate\Http\Response
     */
    public function edit(FAR $far)
    {
        return view('dashboard.far.edit', [
            'title' => 'Edit',
            'far' => $far,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Far  $far
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAR $far)
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

        if ($request->noSurat != $far->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:far';
        }

        $validatedData = $request->validate($rules);

        FAR::where('id', $far->id)
            ->update($validatedData);

        return redirect('/dashboard/far')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FAR  $far
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAR $far)
    {
        FAR::destroy($far->id);

        return redirect('/dashboard/far')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(FAR $far)
    {
        return view('dashboard.far.cetak', [
            'title' => 'FAR',
            'far' => $far,
        ]);
    }
}
