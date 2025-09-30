<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

//Route Login/Signup
Route::resource('/', \App\Http\Controllers\AuthController::class);
Route::post('/auth/sign_up', [\App\Http\Controllers\AuthController::class, 'signUp']);
Route::get('/auth/sign_out', [\App\Http\Controllers\AuthController::class, 'signOut']);
Route::get('/auth/getQuote', [\App\Http\Controllers\AuthController::class, 'getQuote']);
Route::post('/auth/sign_in', [\App\Http\Controllers\AuthController::class, 'signIn']);



//Route Content
Route::get('/permohonan/{id}/detail', [App\Http\Controllers\ProsesController::class, 'detail']);
Route::get('/dashboard', [\App\Http\Controllers\ContentController::class, 'dashboard'])->name('content.dashboard');
Route::get('/dashboardAdmin', [\App\Http\Controllers\ContentController::class, 'dashboardAdmin'])->name('content.dashboardAdmin');
Route::get('/dashboardSuperAdmin', [\App\Http\Controllers\ContentController::class, 'dashboardSuperAdmin'])->name('content.dashboardSuperAdmin');
Route::get('/login',[App\Http\Controllers\ContentController::class,'login'])->name('login.login');
Route::get('/register', [\App\Http\Controllers\ContentController::class, 'register'])->name('register.register');
Route::get('/create', [\App\Http\Controllers\ContentController::class, 'create'])->name('content.create');
Route::get('/check/{id}', [\App\Http\Controllers\ContentController::class, 'check'])->name('content.check');
Route::get('/show', [\App\Http\Controllers\ContentController::class, 'show'])->name('content.show');
Route::get('/showApproved', [\App\Http\Controllers\ContentController::class, 'showApproved'])->name('content.showApproved');


//Route Proses Permohonan
Route::post('/process/save',[App\Http\Controllers\ProsesController::class, 'simpanPermohonan'])->name('process.simpanPermohonan');
Route::post('/process/approve',[App\Http\Controllers\ProsesController::class, 'approve'])->name('process.approve');
Route::post('/process/reject',[App\Http\Controllers\ProsesController::class, 'reject'])->name('process.reject');