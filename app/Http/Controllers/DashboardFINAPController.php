<?php

namespace App\Http\Controllers;

use App\Models\FINAP;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardFINAPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.finap.index', [
            'title' => 'Surat Divisi',
            'finap' => FINAP::latest()->paginate(8),
            'totalFINAP' => FINAP::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maxNoSurat = FINAP::where('idPerihal', '1')->max('noSurat') ?? 0;
        return view('dashboard.finap.create', [
            'title' => 'FINAP',
            'maxNoSurat' => $maxNoSurat,
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
        // dd($request->all());

        $validatedData = $request->validate([
            'noSurat' => 'required|numeric',
            'prefix' => 'required|string',
            'idPerihal' => 'required|numeric',
            'perihal' => 'required|string',
            'vendor' => 'required|string',
            'idDepartement' => 'required|string',
            'departement' => 'required|string',
            'dueDate' => 'required|date',
            'items' => 'nullable|array',
            'total' => 'required|numeric',
            'terbilang' => 'required|string',
            'ket' => 'required|string',
            'a_nama' => 'required|string',
            'bank' => 'required|string',
            'norek' => 'required|numeric',
            'tglSurat' => 'required|date',
            'coa' => 'nullable|string',
            'catatan' => 'nullable',
            'approve' => 'nullable',
        ]);

        $itemsJson = json_encode($validatedData['items']);

        $validatedData['items'] = $itemsJson;

        FINAP::create($validatedData);

        return redirect('/dashboard/finap')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FINAP  $finap
     * @return \Illuminate\Http\Response
     */
    public function show(FINAP $finap)
    {
        $itemsArray = json_decode($finap->items, true);

        return view('dashboard.finap.show', [
            'title' => 'FINAP',
            'finap' => $finap,
            'items' => $itemsArray,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FINAP  $finap
     * @return \Illuminate\Http\Response
     */
    public function edit(FINAP $finap)
    {
        $itemsArray = json_decode($finap->items, true);

        return view('dashboard.finap.edit', [
            'title' => 'Edit',
            'finap' => $finap,
            'items' => $itemsArray,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FINAP  $finap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FINAP $finap)
    {
        $rules = [
            'vendor' => 'required|string',
            'dueDate' => 'required|date',
            'items' => 'nullable|array',
            'total' => 'required|numeric',
            'terbilang' => 'required|string',
            'ket' => 'required|string',
            'a_nama' => 'required|string',
            'bank' => 'required|string',
            'norek' => 'required|numeric',
            'tglSurat' => 'required|date',
            'coa' => 'nullable|string',
            'catatan' => 'nullable',
        ];

        if ($request->noSurat != $finap->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:finap';
        }

        $validatedData = $request->validate($rules);

        FINAP::where('id', $finap->id)
            ->update($validatedData);

        return redirect('/dashboard/finap')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FINAP  $finap
     * @return \Illuminate\Http\Response
     */
    public function destroy(FINAP $finap)
    {
        FINAP::destroy($finap->id);

        return redirect('/dashboard/finap')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(FINAP $finap)
    {
        return view('dashboard.finap.cetak', [
            'title' => 'FINAP',
            'finap' => $finap,
        ]);
    }
}
