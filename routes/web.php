<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dakademik', function () {
    return view('dashboardAkademik');
});

Route::get('/akademikMhs', function () {
    return view('akademikmhs');
});
