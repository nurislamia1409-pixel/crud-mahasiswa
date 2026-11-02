<?php

use App\Http\Controllers\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

Route::resource('mahasiswa', Mahasiswa::class)->except(['create', 'show']);