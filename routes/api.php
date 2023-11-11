<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login-pelanggan', [AuthController::class, 'loginMobile'])
->name('loginPelanggan');

Route::post('/register-pelanggan', [RegisterController::class, 'registerPelanggan'])
->name('registerPelanggan');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home', ([PelangganController::class,'getLapanganApi']))
    ->name('pelangganDashboard');

    Route::get('/lapangan/{id_lapangan}/jadwal', ([PelangganController::class,'getJadwalLapangan']))
    ->name('lapanganPage');

    Route::get('/lapangan/jenis/{jenis_lapangan}', ([PelangganController::class,'getLapanganTertentu']))
    ->name('jenisLapanganTertentu');

    Route::get('/penyedia_lapangan/{id_penyedia_lapangan}/jenisLapangan', ([PelangganController::class,'getJenisLapanganPenyedia']))
    ->name('getJenisLapangan');

    Route::post('/pelanggan/profile/{id_user}', ([PelangganController::class,'updateProfile']))
    ->name('prosesUpdateProfile');

    Route::post('/pemesanan/{id_pelanggan}/proses', ([PemesananController::class,'pemesananPelanggan']))
    ->name('prosesPemesanan');

    Route::get('/pemesanan/{id_pelanggan}/riwayat/{status}', ([PemesananController::class,'riwayatPemesananPelanggan']))
    ->name('riwayatPemesanan');

    Route::post('/pembayaran/proses', ([PemesananController::class,'pembayaranPelanggan']))
    ->name('prosesPembayaran');

    Route::get('/metode-pembayaran', ([MetodePembayaranController::class,'getMetodePembayaran']))
    ->name('metodePembayaran');

    Route::post('/logout-pelanggan', [AuthController::class, 'logoutMobile'])
    ->name('logoutPelanggan');

    Route::post('/pelanggan/privacy/{id_user}', ([PelangganController::class,'updatePassword']))
    ->name('prosesUpdatePassword');

});

