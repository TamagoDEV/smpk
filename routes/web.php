<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SuratMasukController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/process', [AuthController::class, 'processLogin'])->name('login.process');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('userLogin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);

    Route::prefix('surat-masuk')->group(function () {
        Route::get('/', [SuratMasukController::class, 'pageSuratMasuk'])->name('surat-masuk');
        Route::post('/submit', [SuratMasukController::class, 'submit'])->name('submit-surat');
        Route::post('/{id}/assign_reporter', [SuratMasukController::class, 'assignReporter'])->name('surat_masuk.assign_reporter');
        Route::get('/{id}/data', [SuratMasukController::class, 'getData']);
        Route::get('/approval', [SuratMasukController::class, 'approvalSurat'])->name('approval-surat');
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('surat_masuk.destroy');
    });

    Route::get('/kirim-surat', [SuratMasukController::class, 'index'])->name('kirim-surat');

    Route::get('/jadwal-reporter', [ReporterController::class, 'index'])->name('jadwal-reporter');

    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/tambah', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('berita.detail');
        Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/{berita}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    });

    Route::get('/laporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
});
