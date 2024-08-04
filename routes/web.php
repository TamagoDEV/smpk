<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SuratMasukController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/process', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('userLogin');

Route::resource('users', UsersController::class)->middleware('userLogin');


Route::get('/kirim-surat', [SuratMasukController::class, 'index'])->name('kirim-surat');
Route::post('/submit-surat', [SuratMasukController::class, 'submit'])->name('submit-surat');

Route::get('/surat-masuk', [SuratMasukController::class, 'pageSuratMasuk'])->name('surat-masuk');
Route::post('surat_masuk/{id}/assign_reporter', [SuratMasukController::class, 'assignReporter'])
    ->name('surat_masuk.assign_reporter');
Route::get('/suratmasuk/{id}/data', [SuratMasukController::class, 'getData']);

Route::delete('surat_masuk/{id}', [SuratMasukController::class, 'destroy'])->name('surat_masuk.destroy');

Route::get('/jadwal-reporter', [ReporterController::class, 'index'])->name('jadwal-reporter');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
