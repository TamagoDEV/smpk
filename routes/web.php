<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
