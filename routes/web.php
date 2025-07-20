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
    Route::get('/dokumen/edit/{id}', [DokumenController::class, 'edit'])->name('edit-dokumen');
    Route::post('/dokumen/update/{id}', [DokumenController::class, 'update'])->name('update-dokumen');
    Route::get('/dokumen/informasi', [InformasiUpload::class, 'index'])->name('informasi-dokumen');
    Route::get('/cari-dokumen', [CariDokumenController::class, 'index'])->name('cari-dokumen');
    Route::get('/dokumen/{laporanmahasiswa:judul}', [CariDokumenController::class, 'view'])->name('laporan.view');
    Route::get('/dokumen/{laporanmahasiswa:judul}/stream', [CariDokumenController::class, 'stream'])->name('laporan.stream');
    Route::get('/dokumen/detail/{id}', [CariDokumenController::class, 'show'])->name('dokumen-detail');

    Route::get('/bookmarks', [FavoritController::class, 'index'])->name('bookmark');
    Route::get('/bookmark/tambah/{id}', [CariDokumenController::class, 'store'])->name('bookmark-tambah');
    Route::get('/bookmark/hapus/{id}', [CariDokumenController::class, 'destroy'])->name('bookmark-hapus');


    Route::get('/admin/dokumen', [KelolaAjuanController::class, 'index'])->name('admin-dokumen');
    Route::get('/admin/dokumen/{id}', [KelolaAjuanController::class, 'show'])->name('dokumen-detail');
    Route::get('/admin/dokumen/view/{filename}', [KelolaAjuanController::class, 'view'])->name('dokumen-view'); // supaya hanya user login yang bisa akses
    Route::get('/dokumen/approve/{id}', [KelolaAjuanController::class, 'approve'])->name('dokumen-approve');
    Route::get('/dokumen/reject/{id}', [KelolaAjuanController::class, 'reject'])->name('dokumen-reject');
});
