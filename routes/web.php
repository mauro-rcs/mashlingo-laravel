<?php

use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;
//SITE
Route::get('/', [siteController::class, 'index'])->name('site.index');

//AUTH
Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/dashboard', [siteController::class, 'dashboard'])->name('site.dashboard');
    //LOGOUT
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.logout');
});

//LOGIN
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('auth.login');

