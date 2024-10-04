<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
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
    $it = IT::latest()->paginate(8);
    $totalIT = IT::count();

    // Add romanMonth to each IT item
    $it->getCollection()->transform(function ($item) {
        $monthNumber = \Carbon\Carbon::parse($item->tglSurat)->month;
        $item->romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available
        return $item;
    });

    return view('dashboard.it.index', [
        'title' => 'Surat Divisi',
        'its' => $it,
        'totalIT' => $totalIT,
    ]);
}

public function feedback()
{
    $fd = Feedback::latest()->paginate(8);

    return view('dashboard.it.feedback-show', [
        'title' => 'Feedback Show',
        'fd' => $fd,
    ]);
}

public function fsshow($id)
{

    $fd = Feedback::find($id);
    return view('dashboard.it.feedback-detail', [
        'title' => 'Feedback Detail',
        'fd' => $fd,
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
        // Get the month number from the 'tglSurat' attribute
        $monthNumber = \Carbon\Carbon::parse($it->tglSurat)->month;

        // Calculate the Roman month representation
        $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        // Pass the 'romanMonth' along with the 'IT' model to the view
        return view('dashboard.it.show', [
            'title' => 'IT',
            'it' => $it,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
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
        // Get the month number from the 'tglSurat' attribute
        $monthNumber = \Carbon\Carbon::parse($it->tglSurat)->month;

        // Calculate the Roman month representation
        $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        return view('dashboard.it.edit', [
            'title' => 'Edit',
            'it' => $it,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
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
            'noSurat' => 'required|numeric',
            'nama' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'keterangan' => 'required',
            'tglSurat' => 'required|date',
            'ettd' => 'max:255',
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
        // Get the month number from the 'tglSurat' attribute
        $monthNumber = \Carbon\Carbon::parse($it->tglSurat)->month;

        // Calculate the Roman month representation
        $romanMonth = monthToRoman($monthNumber); // Ensure this function is defined and available

        // Pass the 'romanMonth' along with the 'IT' model to the view
        return view('dashboard.it.cetak', [
            'title' => 'IT',
            'it' => $it,
            'romanMonth' => $romanMonth, // Pass the Roman month to the view
        ]);
    }

}
