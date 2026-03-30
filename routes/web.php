<?php

use App\Http\Controllers\siteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//SITE
Route::get('/', [siteController::class, 'index'])->name('site.index');

//AUTH
Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/dashboard', [siteController::class, 'dashboard'])->name('site.dashboard');
    Route::get('/admin', [siteController::class, 'admin'])->name('site.admin');

    //LOGOUT
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.logout');

    //EDIT/DELETE
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    //adm
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

});

//LOGIN
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('auth.login');
Route::get('/cadastro', [\App\Http\Controllers\RegisterController::class, 'index'])->name('site.register');
Route::post('/cadastro', [\App\Http\Controllers\RegisterController::class, 'store'])->name('auth.register');
