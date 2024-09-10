<?php

namespace App\Http\Controllers;

use App\Models\IT;
use App\Models\GA;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'its' => IT::latest()->paginate(5),
            'ga' => GA::latest()->paginate(5),
            'totalIT' => IT::count(),
            'totalGA' => GA::count(),
        ]);
    }
}
