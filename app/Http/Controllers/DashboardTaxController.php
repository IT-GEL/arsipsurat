<?php

namespace App\Http\Controllers;

use App\Models\TAX;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tax.index', [
            'title' => 'Surat Divisi',
            'tax' => TAX::latest()->paginate(8),
            'totalTAX' => TAX::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tax.create', [
            'title' => 'TAX',
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

        TAX::create($validatedData);

        return redirect('/dashboard/tax')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TAX  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(TAX $tax)
    {
        return view('dashboard.tax.show', [
            'title' => 'TAX',
            'tax' => $tax,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TAX  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(TAX $tax)
    {
        return view('dashboard.tax.edit', [
            'title' => 'Edit',
            'tax' => $tax,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TAX  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TAX $tax)
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

        if ($request->noSurat != $tax->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:tax';
        }

        $validatedData = $request->validate($rules);

        TAX::where('id', $tax->id)
            ->update($validatedData);

        return redirect('/dashboard/tax')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TAX  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(TAX $tax)
    {
        TAX::destroy($tax->id);

        return redirect('/dashboard/tax')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(TAX $tax)
    {
        return view('dashboard.tax.cetak', [
            'title' => 'TAX',
            'tax' => $tax,
        ]);
    }
}
