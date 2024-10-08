<?php

namespace App\Http\Controllers;

use App\Models\IT;
use App\Models\GA;
use App\Models\MSS;
use App\Models\GSM;
use App\Models\TNC;
use App\Models\PRC;
use App\Models\PR;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'its' => IT::latest()->paginate(5),
            'ga' => GA::latest()->paginate(5),
            'mss' => MSS::latest()->paginate(5),
            'gsm' => GSM::latest()->paginate(5),
            'tnc' => TNC::latest()->paginate(5),
            'prc' => PRC::latest()->paginate(5),
            //'profile' => PR::latest()->paginate(5),
            'totalIT' => IT::count(),
            'totalGA' => GA::count(),
            'totalMSS' =>MSS::count(),
            'totalGSM' =>GSM::count(),
            'totalTNC' =>TNC::count(),
            'totalPRC' =>PRC::count(),
        ]);
    }
}
