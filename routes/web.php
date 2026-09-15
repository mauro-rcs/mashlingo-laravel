<?php

use App\Http\Controllers\siteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WritingController;
use App\Http\Controllers\WritingLessonController;
use Illuminate\Support\Facades\Route;

// SITE
// SITE
Route::get('/', [siteController::class, 'index'])
    ->name('site.index');


// LOGIN E CADASTRO — somente visitantes
Route::middleware('guest')->group(function () {

    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])
        ->name('site.login');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate'])
        ->name('auth.login');

    Route::get('/cadastro', [\App\Http\Controllers\RegisterController::class, 'index'])
        ->name('site.register');

    Route::post('/cadastro', [\App\Http\Controllers\RegisterController::class, 'store'])
        ->name('auth.register');
});


// USUÁRIOS LOGADOS
Route::middleware('auth')->group(function () {

    Route::get('/perfil', [siteController::class, 'perfil'])
        ->name('site.perfil');

    Route::get('/taskboard', [siteController::class, 'taskboard'])
        ->name('site.taskboard');

    Route::get('/admin', [siteController::class, 'admin'])
        ->name('site.admin');

    // ESCRITA
    Route::get('/escrita', [siteController::class, 'escrita'])
        ->name('site.escrita');

    Route::get('/escrita/licao/{lesson}', [WritingController::class, 'show'])
        ->name('writing.lesson');

    Route::post('/escrita/licao/{lesson}/complete', [siteController::class, 'submitWritingLesson'])
        ->name('writing.complete');

    // LOGOUT
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
        ->name('auth.logout');

    // USUÁRIOS
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('user.destroy');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('user.update');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
        ->name('user.edit');

    // ADMIN — ESCRITA
    Route::get('/admin/escrita', [WritingLessonController::class, 'index'])
        ->name('admin.escrita.index');

    Route::post('/admin/escrita', [WritingLessonController::class, 'store'])
        ->name('admin.escrita.store');

    Route::put('/admin/escrita/{lesson}', [WritingLessonController::class, 'update'])
        ->name('admin.escrita.update');

    Route::delete('/admin/escrita/{lesson}', [WritingLessonController::class, 'destroy'])
        ->name('admin.escrita.destroy');
});
