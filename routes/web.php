<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardITController;
use App\Http\Controllers\DashboardGAController;
use App\Http\Controllers\DashboardMSSController;
use App\Http\Controllers\DashboardGSMController;
use App\Http\Controllers\DashboardTNCController;
use App\Http\Controllers\DetailQrController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These    |
| routes are loaded by the RouteServiceProvider within a group which      |
| contains the "web" middleware group. Now create something great!        |
|--------------------------------------------------------------------------|
*/

Route::get('/', [HomeController::class, 'index']);

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->middleware('guest');
    Route::post('/register', 'store');
});

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/it', DashboardITController::class)->middleware('auth');
Route::resource('/dashboard/ga', DashboardGAController::class)->middleware('auth');
Route::resource('/dashboard/mss', DashboardMSSController::class)->middleware('auth');
Route::resource('/dashboard/gsm', DashboardGSMController::class)->middleware('auth');
Route::resource('/dashboard/tnc', DashboardTNCController::class)->middleware('auth');

Route::put('/dashboard/mss/{mss}/approve', [DashboardMSSController::class, 'approve'])->name('mss.approve');
Route::put('/dashboard/gsm/{gsm}/approve', [DashboardGSMController::class, 'approve'])->name('gsm.approve');
Route::put('/dashboard/tnc/{tnc}/approve', [DashboardTNCController::class, 'approve'])->name('tnc.approve');


// QR Detail Route
Route::get('/detailQR/{id}', [DetailQrController::class, 'index']);

// Feedback Routes
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback-upload', [FeedbackController::class, 'store']);
Route::get('/feedback-show/', [DashboardITController::class, 'feedback']);
Route::get('/feedback-detail/{id}', [DashboardITController::class, 'fsshow']);



// Route::post('/dashboard/mss', [DashboardMSSController::class, 'store']);
// Uncomment if needed
// Route::get('/dashboard/it/cetak_pdf', [DashboardITController::class, 'cetak_pdf'])->middleware('auth');
// Route::get('/dashboard/it/{it:id}/cetak', [DashboardITController::class, 'cetak'])->middleware('auth');
// Route::get('/dashboard/ga/{ga:id}/cetak', [DashboardGAController::class, 'cetak'])->middleware('auth');
// Route::get('/dashboard/mss/{mss:id}/cetak', [DashboardMSSController::class, 'cetak'])->middleware('auth');

