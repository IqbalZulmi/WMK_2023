<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotActiveAccountController;
use App\Http\Controllers\PenyediaLapanganController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/', ([AuthController::class,'showLoginPage']))
    ->name('loginPage');

    Route::post('/proses-login', ([AuthController::class, 'loginProcess']))
    ->name('loginProcess');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', ([AuthController::class, 'logout']))
    ->name('logout');

    Route::get('/akun-belum-aktif',([NotActiveAccountController::class,'notActivePage']))
    ->name('accountNotActive');

    Route::put('/user/{id_user}/change-password',([UserController::class,'updateKataSandi']))
    ->name('updateKataSandi');

});

Route::middleware(['cekstatus', 'cekrole:penyedia'])->group(function () {
    Route::get('/profile/penyedia', ([PenyediaLapanganController::class,'showProfile']))
    ->name('dashboardPage');

    Route::put('/profile/penyedia/{id_user}/update-profile', ([PenyediaLapanganController::class,'updateProfile']))
    ->name('updateProfilePenyedia');

    Route::put('/profile/penyedia/{id_penyedia_lapangan}/update-rekening', ([RekeningController::class,'updateRekeningPenyedia']))
    ->name('updateRekening');
});

Route::middleware(CekRole::class . ':admin')->group(function(){

});

Route::middleware(CekRole::class . ':superadmin')->group(function(){
    Route::get('/dashboard/superadmin', ([DashboardController::class,'superadminDashboard']))
    ->name('superadminDashboardPage');
});
