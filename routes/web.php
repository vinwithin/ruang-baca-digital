<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CariDokumenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\InformasiUpload;
use App\Http\Controllers\KelolaAjuanController;
use App\Http\Controllers\KelolaDokumenController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang-kami', [BerandaController::class, 'tentang'])->name('tentang-kami');
Route::get('/hasil-pencarian', [BerandaController::class, 'tentang'])->name('hasil-pencarian');
Route::get('/koleksi/{jenisdokumen}', [KoleksiController::class, 'index'])->name('koleksi');
Route::get('/koleksi/detail/{laporanmahasiswa}', [KoleksiController::class, 'show'])->name('koleksi-detail');
Route::get('/program-studi/{programstudi}', [KoleksiController::class, 'show'])->name('koleksi-detail');




Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');
    Route::post('/dokumen/unggah', [DokumenController::class, 'store'])->name('unggah-dokumen');
    Route::get('/dokumen/edit/{laporanmahasiswa}', [DokumenController::class, 'edit'])->name('edit-dokumen');
    Route::post('/dokumen/update/{laporanmahasiswa}', [DokumenController::class, 'update'])->name('update-dokumen');
    Route::get('/informasi/dokumen', [InformasiUpload::class, 'index'])->name('informasi-dokumen');
    Route::get('/informasi/dokumen/view/{filename}', [InformasiUpload::class, 'view'])->name('informasi-dokumen-view'); // supaya hanya user login yang bisa akses

    Route::get('/search/dokumen', [CariDokumenController::class, 'index'])->name('cari-dokumen');
    Route::get('/search/dokumen/{laporanmahasiswa}', [CariDokumenController::class, 'show'])->name('dokumen-detail');
    Route::get('/dokumen/{laporanmahasiswa:judul}', [CariDokumenController::class, 'view'])->name('laporan.view');
    Route::get('/dokumen/{laporanmahasiswa:judul}/stream', [CariDokumenController::class, 'stream'])->name('laporan.stream');

    Route::get('/bookmarks', [FavoritController::class, 'index'])->name('bookmark');
    Route::get('/bookmark/tambah/{laporanmahasiswa}', [CariDokumenController::class, 'store'])->name('bookmark-tambah');
    Route::get('/bookmark/hapus/{laporanmahasiswa}', [CariDokumenController::class, 'destroy'])->name('bookmark-hapus');

    Route::prefix('admin')->group(function () {
        Route::get('/dokumen', [KelolaAjuanController::class, 'index'])->name('admin-dokumen');
        Route::get('/dokumen/{id}', [KelolaAjuanController::class, 'show'])->name('dokumen-detail');
        Route::get('/dokumen/view/{filename}', [KelolaAjuanController::class, 'view'])->name('dokumen-view');
        Route::get('/dokumen/approve/{id}', [KelolaAjuanController::class, 'approve'])->name('dokumen-approve');
        Route::post('/dokumen/reject/{id}', [KelolaAjuanController::class, 'reject'])->name('dokumen-reject');
        Route::get('/kelola-dokumen', [KelolaDokumenController::class, 'index'])->name('admin.kelola-dokumen');
        Route::get('/kelola-dokumen/unggah', [KelolaDokumenController::class, 'create'])->name('admin.kelola-dokumen.unggah');
        Route::post('/kelola-dokumen/unggah', [KelolaDokumenController::class, 'store'])->name('admin.kelola-dokumen.unggah');
        Route::get('/kelola-dokumen/edit/{laporanmahasiswa}', [KelolaDokumenController::class, 'edit'])->name('admin.kelola-dokumen.edit');
        Route::post('/kelola-dokumen/update/{laporanmahasiswa}', [KelolaDokumenController::class, 'update'])->name('admin.kelola-dokumen.update');
        Route::get('/kelola-dokumen/detail/{laporanmahasiswa}', [KelolaDokumenController::class, 'show'])->name('admin.kelola-dokumen.detail');
        Route::get('/kelola-dokumen/delete/{laporanmahasiswa}', [KelolaDokumenController::class, 'destroy'])->name('admin.kelola-dokumen.delete');

        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/unggah', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/berita/unggah', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/berita/edit/{berita:slug}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::post('/berita/update/{berita:slug}', [BeritaController::class, 'update'])->name('berita.update');
        Route::get('/berita/delete/{berita:slug}', [BeritaController::class, 'destroy'])->name('berita.delete');
    });
});
