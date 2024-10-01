<?php

namespace App\Http\Controllers;

use App\Models\Legal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardLegalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.legal.index', [
            'title' => 'Surat Divisi',
            'lgl' => Legal::latest()->paginate(8),
            'totalLegal' => Legal::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.legal.create', [
            'title' => 'Legal',
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

        Legal::create($validatedData);

        return redirect('/dashboard/legal')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Legal  $legal
     * @return \Illuminate\Http\Response
     */
    public function show(Legal $legal)
    {
        return view('dashboard.legal.show', [
            'title' => 'Legal',
            'legal' => $legal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Legal  $legal
     * @return \Illuminate\Http\Response
     */
    public function edit(Legal $legal)
    {
        return view('dashboard.legal.edit', [
            'title' => 'Edit',
            'legal' => $legal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Legal  $legal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Legal $legal)
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

        if ($request->noSurat != $legal->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:lgl';
        }

        $validatedData = $request->validate($rules);

        Legal::where('id', $legal->id)
            ->update($validatedData);

        return redirect('/dashboard/legal')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Legal  $legal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Legal $legal)
    {
        Legal::destroy($legal->id);

        return redirect('/dashboard/legal')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(Legal $legal)
    {
        return view('dashboard.legal.cetak', [
            'title' => 'Legal',
            'legal' => $legal,
        ]);
    }
}