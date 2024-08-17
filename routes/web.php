<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [SuratMasukController::class, 'index'])->name('home');
Route::get('/kirim-surat', [SuratMasukController::class, 'index'])->name('kirim-surat');
Route::post('/submit', [SuratMasukController::class, 'submit'])->name('submit-surat');
Route::get('/daftar-berita', [BeritaController::class, 'publikBerita'])->name('daftarberita.index');
Route::get('/', [BeritaController::class, 'publikBerita'])->name('home');
Route::get('/detail-berita/{id}', [BeritaController::class, 'detailBerita'])->name('berita.detail-publik');
Route::post('/komentar/store', [KomentarController::class, 'store'])->name('komentar.store');

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/process', [AuthController::class, 'processLogin'])->name('login.process');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('userLogin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);

    Route::prefix('surat-masuk')->group(function () {
        Route::get('/', [SuratMasukController::class, 'peliputanIndex'])->name('surat-masuk');
        Route::get('/peliputan', [SuratMasukController::class, 'peliputanIndex'])->name('surat-masuk/peliputan');
        Route::post('/{id}/assign_reporter', [SuratMasukController::class, 'assignReporter'])->name('surat-masuk.assign_reporter');
        Route::get('{id}/data', [SuratMasukController::class, 'getData']);
        // web.php
        Route::get('/{id}/details-iklan', [SuratMasukController::class, 'detailsIklan'])->name('surat-masuk.detailsIklan');
        Route::get('/{id}/details-peliputan', [SuratMasukController::class, 'detailsPeliputan'])->name('surat-masuk.detailsPeliputan');

        Route::get('/iklan', [SuratMasukController::class, 'iklanIndex'])->name('surat-masuk/iklan');
        Route::post('/{id}/assign_reporter', [SuratMasukController::class, 'assignReporter'])->name('surat_masuk.assign_reporter');
        Route::get('/{id}/data', [SuratMasukController::class, 'getData']);
        Route::get('/approved', [SuratMasukController::class, 'approvedSurat'])->name('approved-surat');
        Route::put('/{id}/approve', [SuratMasukController::class, 'approve'])->name('surat-masuk/approve');
        Route::delete('/{id}', [SuratMasukController::class, 'destroy'])->name('surat_masuk.destroy');
    });

    Route::get('/jadwal-reporter', [ReporterController::class, 'index'])->name('jadwal-reporter');

    // Berita Routes
    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/tambah', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/tambah', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/{berita}', [BeritaController::class, 'show'])->name('berita.detail');
        Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/{berita}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
        Route::post('/{id}/approve', [BeritaController::class, 'approve'])->name('berita.approve');
        Route::post('/{id}/reject', [BeritaController::class, 'reject'])->name('berita.reject');
        Route::post('/status-publik-private-update/{id}', [BeritaController::class, 'updateStatusPublikPrivate'])->name('berita.status-publik-private-update');
    });

    Route::get('laporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
    Route::get('laporan/filter', [PelaporanController::class, 'filter'])->name('laporan.filter');
    // Route to print the report
    Route::get('/laporan/cetak/{id}', [PelaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::post('/laporan/ajukan', [PelaporanController::class, 'ajukan'])->name('laporan.ajukan');
    Route::get('laporan/pengajuan', [PelaporanController::class, 'pengajuan'])->name('laporan.pengajuan');
    // Melakukan approval laporan
    Route::patch('/laporan/{id}/approve', [PelaporanController::class, 'approve'])->name('laporan.approve');
});
