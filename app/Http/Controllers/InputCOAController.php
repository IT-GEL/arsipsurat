<?php

namespace App\Http\Controllers;

use App\Models\COA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InputCOAController extends Controller
{
    // Function to display the details of the QR code
    public function index()
    {
        $coa = COA::latest()->paginate(8);;

        return view('inputcoa.index', [
            'coa' => $coa,
            'title' => 'Input COA',
        ]);
    }
}
