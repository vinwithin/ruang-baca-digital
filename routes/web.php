<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/unggah-dokumen', [DokumenController::class, 'index'])->name('unggah-dokumen');




