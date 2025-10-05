<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CariDokumenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\GuestBeritaController;
use App\Http\Controllers\GuestCariDokumenController;
use App\Http\Controllers\GuestProdiController;
use App\Http\Controllers\InformasiUpload;
use App\Http\Controllers\KelolaAjuanController;
use App\Http\Controllers\KelolaDokumenController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\LaporanValidasiController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang-kami', [BerandaController::class, 'tentang'])->name('tentang-kami');
Route::get('/layanan', [BerandaController::class, 'layanan'])->name('layanan');
Route::get('/berita', [GuestBeritaController::class, 'index'])->name('guest.berita.index');
Route::get('/program-studi', [GuestProdiController::class, 'index'])->name('guest.prodi.index');
Route::get('/berita/{berita:slug}', [GuestBeritaController::class, 'show'])->name('guest.berita.show');
Route::get('/hasil-pencarian', [GuestCariDokumenController::class, 'index'])->name('hasil-pencarian');
Route::get('/koleksi/{jenisdokumen}', [KoleksiController::class, 'index'])->name('koleksi');
Route::get('/koleksi/detail/{laporanmahasiswa}', [KoleksiController::class, 'show'])->name('koleksi-detail');
Route::get('/koleksi/program-studi/{programstudi}', [KoleksiController::class, 'koleksi'])->name('koleksi-program-studi');
Route::get('/laporan/{uuid}/verify/', [LaporanValidasiController::class, 'index'])->name('laporan.verify');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['success' => 'Silahkan cek email untuk melakukan update password'])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'passwordReset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/email/verify', function () {
    return view('auth.email-verification');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'verified', 'active'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'profile'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'storeProfile'])->name('profil.update');
    Route::get('/profil/password/edit', [ProfilController::class, 'password'])->name('profi.passwordl');
    Route::post('/profil/password/update', [ProfilController::class, 'storePassword'])->name('profil.storePassword');
    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan.index');

    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/dashboard/skripsi', [DashboardController::class, 'skripsi'])->name('dashboard.skripsi');
        Route::get('/dashboard/laporan-magang', [DashboardController::class, 'laporanMagang'])->name('dashboard.laporan-magang');
        Route::get('/dashboard/{laporanmahasiswa}', [CariDokumenController::class, 'show'])->name('dashboard.show');

        Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');
        Route::post('/dokumen/unggah', [DokumenController::class, 'store'])->name('unggah-dokumen');
        Route::get('/informasi/dokumen/edit/{laporanmahasiswa}', [DokumenController::class, 'edit'])->name('edit-dokumen');
        Route::post('/informasi/dokumen/update/{laporanmahasiswa}', [DokumenController::class, 'update'])->name('update-dokumen');
        Route::get('/informasi/dokumen', [InformasiUpload::class, 'index'])->name('informasi-dokumen');
        Route::get('/informasi/dokumen/{laporanmahasiswa}', [InformasiUpload::class, 'detail'])->name('informasi-dokumen.detail');
        Route::get('/informasi/dokumen/view/{filename}', [InformasiUpload::class, 'view'])->name('informasi-dokumen-view'); // supaya hanya user login yang bisa akses
        Route::post('/pdf/generate', [PDFController::class, 'generateReport'])->name('pdf.generate');

        Route::get('/search/dokumen', [CariDokumenController::class, 'index'])->name('cari-dokumen');
        Route::get('/search/dokumen/{laporanmahasiswa}', [CariDokumenController::class, 'show'])->name('dokumen-detail');
        Route::get('/dokumen/{laporanmahasiswa:judul}', [CariDokumenController::class, 'view'])->name('laporan.view');
        Route::get('/dokumen/{laporanmahasiswa:judul}/stream', [CariDokumenController::class, 'stream'])->name('laporan.stream');

        Route::get('/bookmarks', [FavoritController::class, 'index'])->name('bookmark');
        Route::get('/bookmarks/{laporanmahasiswa}', [FavoritController::class, 'detail'])->name('bookmark.detail');
        Route::get('/bookmark/tambah/{laporanmahasiswa}', [CariDokumenController::class, 'store'])->name('bookmark-tambah');
        Route::get('/bookmark/hapus/{laporanmahasiswa}', [CariDokumenController::class, 'destroy'])->name('bookmark-hapus');

        Route::get('/pdf/generate/{laporanmahasiswa}', [PdfController::class, 'generateReport'])->name('pdf.generate');
    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::post('/panduan/{id}/update', [PanduanController::class, 'update'])->name('panduan.update');

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

            Route::get('/kelola-pengguna', [MasterDataController::class, 'index'])->name('kelola-pengguna.index');
            Route::get('/kelola-pengguna/create', [MasterDataController::class, 'create'])->name('kelola-pengguna.create');
            Route::post('/kelola-pengguna/store', [MasterDataController::class, 'store'])->name('kelola-pengguna.store');
            Route::get('/kelola-pengguna/{id}/edit', [MasterDataController::class, 'edit'])->name('kelola-pengguna.edit');
            Route::post('/kelola-pengguna/{id}/update', [MasterDataController::class, 'update'])->name('kelola-pengguna.update');
            Route::get('/kelola-pengguna/{id}/active', [MasterDataController::class, 'active'])->name('kelola-pengguna.active');
            Route::get('/kelola-pengguna/{id}/nonactive', [MasterDataController::class, 'nonactive'])->name('kelola-pengguna.nonactive');

            Route::get('/calendar/month', [DashboardController::class, 'getMonth'])->name('calendar.month');
        });
    });
});
