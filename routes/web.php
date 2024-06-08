<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;

Route::get('/', function () {
    return view('dashboardAkademik');
});

// Route::get('/dakademik', function () {
//     return view('dashboardAkademik');
// });

// Route::get('/akademikMhs', function () {
//     return view('akademikmhs');
// });

Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen');
