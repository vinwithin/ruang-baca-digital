<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CariDokumenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\InformasiUpload;
use App\Http\Controllers\KelolaAjuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');
    Route::post('/dokumen/unggah', [DokumenController::class, 'store'])->name('unggah-dokumen');
    Route::get('/dokumen/informasi', [InformasiUpload::class, 'index'])->name('informasi-dokumen');
    Route::get('/cari-dokumen', [CariDokumenController::class, 'index'])->name('cari-dokumen');
    Route::get('/dokumen/detail/{id}', [CariDokumenController::class, 'show'])->name('dokumen-detail');
    Route::get('/dokumen/favorit', [FavoritController::class, 'index'])->name('dokumen-favorit');
    Route::get('/dokumen/favorit/tambah/{id}', [CariDokumenController::class, 'store'])->name('dokumen-favorit-tambah');
    Route::get('/dokumen/favorit/hapus/{id}', [CariDokumenController::class, 'destroy'])->name('dokumen-favorit-hapus');


    Route::get('/dokumen/daftar', [KelolaAjuanController::class, 'index'])->name('dokumen-daftar');
    Route::get('/dokumen/show/{id}', [KelolaAjuanController::class, 'show'])->name('dokumen-detail');
    Route::get('/dokumen/view/{filename}', [KelolaAjuanController::class, 'view'])->name('dokumen-view'); // supaya hanya user login yang bisa akses
    Route::get('/dokumen/approve/{id}', [KelolaAjuanController::class, 'approve'])->name('dokumen-approve');
    Route::get('/dokumen/reject/{id}', [KelolaAjuanController::class, 'reject'])->name('dokumen-reject');
});
