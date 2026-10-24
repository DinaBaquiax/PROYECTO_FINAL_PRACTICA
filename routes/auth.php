<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController as Sesion;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [Sesion::class, 'create'])->name('login');
    Route::post('login', [Sesion::class, 'store']);
});

Route::post('logout', [Sesion::class, 'destroy'])->middleware('auth')->name('logout');
