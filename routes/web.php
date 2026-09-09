<?php

use App\Http\Controllers\siteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WritingController;
use Illuminate\Support\Facades\Route;
//SITE
Route::get('/', [siteController::class, 'index'])->name('site.index');

//AUTH
Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/perfil', [siteController::class, 'perfil'])->name('site.perfil');
    Route::get('/taskboard', [siteController::class, 'taskboard'])->name('site.taskboard');
    Route::get('/admin', [siteController::class, 'admin'])->name('site.admin');

    //ESCRITA
    Route::get('/escrita', [SiteController::class, 'escrita'])
        ->name('site.escrita');

    Route::get('/escrita/licao/{lesson}', [SiteController::class, 'licao'])
        ->name('writing.lesson');

    Route::post('/escrita/licao/{lesson}/complete', [SiteController::class, 'submitWritingLesson'])
        ->name('writing.complete');

    Route::get(
        '/escrita/licao/{lesson}',
        [WritingController::class, 'show']
    )->name('writing.lesson');

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
