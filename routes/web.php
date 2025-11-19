<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DassTestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\DashboardController; // Untuk Admin nanti
use App\Http\Controllers\Admin\ResponseAdminController; // Untuk Admin nanti

// 1. Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- ALUR TES PENGGUNA ---

// 2. Formulir Data Diri Awal
Route::get('/dass42-test', [DassTestController::class, 'showDataForm'])->name('dass.data.form');
Route::post('/dass42-test', [DassTestController::class, 'storeDataAndStartTest'])->name('dass.data.store');

// 3. Halaman Tes DASS-42 (Wizard)
Route::get('/test/start/{step?}', [DassTestController::class, 'showTest'])->name('dass.test.start');
Route::post('/test/submit/step', [DassTestController::class, 'submitStep'])->name('dass.test.submit.step'); 
Route::get('/test/finish', [DassTestController::class, 'finishTest'])->name('dass.test.finish');

// 4. Halaman Hasil
Route::get('/results/{participantId}', [DassTestController::class, 'showResults'])->name('dass.results');

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController; 

Route::middleware('guest')->group(function () {
    // Rute ini harus diberi nama 'login' agar middleware 'auth' dapat menemukannya
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    // Rute logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
// ------------------------------------------------------------------


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // 2. CRUD Soal
    Route::resource('questions', QuestionController::class)->except(['show']);
    
    // 3. Data Respon
    Route::get('responses', [ResponseAdminController::class, 'index'])->name('responses.index');
    Route::get('responses/{participant}', [ResponseAdminController::class, 'show'])->name('responses.show');
    Route::delete('responses/{participant}', [ResponseAdminController::class, 'destroy'])->name('responses.destroy');
});