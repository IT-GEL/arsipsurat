<?php

namespace App\Http\Controllers;

use App\Models\BNL;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardBNLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bnl.index', [
            'title' => 'Surat Divisi',
            'bnl' => BNL::latest()->paginate(8),
            'totalBNL' => BNL::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.bnl.create', [
            'title' => 'BNL',
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

        BNL::create($validatedData);

        return redirect('/dashboard/bnl')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BNL  $bnl
     * @return \Illuminate\Http\Response
     */
    public function show(BNL $bnl)
    {
        return view('dashboard.bnl.show', [
            'title' => 'BNL',
            'bnl' => $bnl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BNL  $bnl
     * @return \Illuminate\Http\Response
     */
    public function edit(BNL $bnl)
    {
        return view('dashboard.bnl.edit', [
            'title' => 'Edit',
            'bnl' => $bnl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BNL  $bnl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BNL $bnl)
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

        if ($request->noSurat != $bnl->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:bnl';
        }

        $validatedData = $request->validate($rules);

        BNL::where('id', $bnl->id)
            ->update($validatedData);

        return redirect('/dashboard/bnl')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BNL  $bnl
     * @return \Illuminate\Http\Response
     */
    public function destroy(BNL $bnl)
    {
        BNL::destroy($bnl->id);

        return redirect('/dashboard/bnl')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(BNL $bnl)
    {
        return view('dashboard.bnl.cetak', [
            'title' => 'BNL',
            'bnl' => $bnl,
        ]);
    }
}
