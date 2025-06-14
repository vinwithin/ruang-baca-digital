<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
