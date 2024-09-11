<?php

namespace App\Http\Controllers;

use App\Models\IT;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardITController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.it.index', [
            'title' => 'Surat Divisi',
            'its' => IT::latest()->paginate(8),
            'totalIT' => IT::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.it.create', [
            'title' => 'IT',
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

        IT::create($validatedData);

        return redirect('/dashboard/it')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function show(IT $it)
    {
        return view('dashboard.it.show', [
            'title' => 'IT',
            'it' => $it,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function edit(IT $it)
    {
        return view('dashboard.it.edit', [
            'title' => 'Edit',
            'it' => $it,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IT $it)
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

        if ($request->noSurat != $it->noSurat) {
            $rules['noSurat'] = 'required|numeric|unique:its';
        }

        $validatedData = $request->validate($rules);

        IT::where('id', $it->id)
            ->update($validatedData);

        return redirect('/dashboard/it')->with('success', 'Surat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IT  $it
     * @return \Illuminate\Http\Response
     */
    public function destroy(IT $it)
    {
        IT::destroy($it->id);

        return redirect('/dashboard/it')->with('success', 'Surat berhasil dihapus!');
    }

    public function cetak(IT $it)
    {
        return view('dashboard.it.cetak', [
            'title' => 'IT',
            'it' => $it,
        ]);
    }
}
