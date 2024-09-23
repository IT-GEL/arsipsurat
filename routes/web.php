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
use App\Http\Controllers\DashboardTNCController;
use App\Http\Controllers\DQRController; // Pastikan DQRController ada

Route::get('/', [HomeController::class, 'index']);

Route::get('/profile/{id}', [DQRController::class, 'index']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->middleware('guest');
    Route::post('/register', 'store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/it/{it:id}/cetak', [DashboardITController::class, 'cetak'])->middleware('auth');
Route::get('/dashboard/ga/{ga:id}/cetak', [DashboardGAController::class, 'cetak'])->middleware('auth');
Route::get('/dashboard/mss/{mss:id}/cetak', [DashboardMSSController::class, 'cetak'])->middleware('auth');

Route::resource('/dashboard/it', DashboardITController::class)->middleware('auth');
Route::resource('/dashboard/ga', DashboardGAController::class)->middleware('auth');
Route::resource('/dashboard/mss', DashboardMSSController::class)->middleware('auth');

// Rute untuk approve dan generate QR
Route::put('/dashboard/mss/{mss}/approve', [DashboardMSSController::class, 'approveAndGenerateQr'])->name('mss.approveAndGenerateQr');
