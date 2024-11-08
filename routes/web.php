<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AkademikMhs;

//Route::get('/', function () {
//    return view('dashboardAkademik');
//});

// Route::get('/dakademik', function () {
//     return view('dashboardAkademik');
// });

Route::get('/akademikMhs', function () {
    return view('akademikmhs');
});

Route::get('/dosen/akademikMhs/{id}', [AkademikMhs::class, 'show'])->name('akademikmhs');
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen');
//Route::get('/dosen/dashboard', [DosenController::class, 'dashboardAkademik'])->name('dosen');