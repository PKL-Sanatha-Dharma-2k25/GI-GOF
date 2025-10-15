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
Route::get('/auth/validate', [\App\Http\Controllers\AuthController::class, 'usernameValidate']);
Route::post('/auth/signInValidate', [\App\Http\Controllers\AuthController::class, 'signInValidate']);


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
Route::get('/showFinished', [\App\Http\Controllers\ContentController::class, 'showFinished'])->name('content.showFinished');
Route::get('/showAll', [\App\Http\Controllers\ContentController::class, 'showAll'])->name('content.showAll');
Route::get('/print/{id}', [\App\Http\Controllers\ContentController::class, 'printOut'])->name('content.print');
Route::get('/printISO/{id}', [\App\Http\Controllers\ContentController::class, 'printOutISO'])->name('content.printISO');

//Route AJAX
Route::get('/process/getNamaBarang', [App\Http\Controllers\ProsesController::class, 'getNamaBarang'])->name('process.getNamaBarang');
Route::get('/process/getJenisPermohonan', [App\Http\Controllers\ProsesController::class, 'getJenisPermohonan'])->name('process.getJenisPermohonan');
Route::get('/process/getLokasiKendala', [App\Http\Controllers\ProsesController::class, 'getLokasiKendala'])->name('process.getLokasiKendala');
Route::patch('/process/approve',[App\Http\Controllers\ProsesController::class, 'approve'])->name('process.approve');
Route::patch('/process/reject',[App\Http\Controllers\ProsesController::class, 'reject'])->name('process.reject');
Route::post('/process/addMasterLokasi',[App\Http\Controllers\ProsesController::class, 'addMasterLokasi'])->name('process.addMasterLokasi');
Route::post('/process/addMasterBarang',[App\Http\Controllers\ProsesController::class, 'addMasterBarang'])->name('process.addMasterBarang');
//Route Proses Permohonan
Route::post('/process/save',[App\Http\Controllers\ProsesController::class, 'simpanPermohonan'])->name('process.simpanPermohonan');
Route::post('/process/onProgress',[App\Http\Controllers\ProsesController::class, 'updateOnProgress'])->name('process.onProgress');
Route::post('/process/finished',[App\Http\Controllers\ProsesController::class, 'finished'])->name('process.finished');
