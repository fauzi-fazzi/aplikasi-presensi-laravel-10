<?php

use App\Models\Presensi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\MonitoringAbsenController;

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

Route::middleware(['guest:peserta'])->group(function () {

    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'register']);
    Route::post('/prosesregister', [LoginController::class, 'prosesregis']);
});

Route::middleware(['auth:peserta'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/presensi', PresensiController::class);
    Route::resource('/izin', IzinController::class);
    Route::resource('/kegiatan', KegiatanController::class);
    Route::post('/logout', [LoginController::class, 'logout']);
});


// ini adalah route admin
Route::middleware(['guest:user'])->group(function () {

    Route::get('/loginadmin', [LoginController::class, 'loginadmin'])->name('loginadmin');
    Route::post('/loginadmin', [LoginController::class, 'prosesloginadmin']);
});


Route::middleware(['auth:user'])->group(function () {
    Route::get('/panel', [AdminController::class, 'index']);
    Route::resource('/anggota', AnggotaController::class);
    Route::post('/logoutadmin', [LoginController::class, 'logoutadmin']);

    Route::get('/absen', [MonitoringAbsenController::class, 'index']);
    Route::post('/getabsen', [MonitoringAbsenController::class, 'getabsen'])->name('getabsen');

    Route::get('/monitoringkegiatan', [MonitoringAbsenController::class, 'kegiatan']);
    Route::post('/getkegiatan', [MonitoringAbsenController::class, 'getkegiatan'])->name('getkegiatan');


    Route::get('/pengajuanizin', [MonitoringAbsenController::class, 'pengajuanizin']);
    Route::post('/pengajuanizin/sakit', [MonitoringAbsenController::class, 'approveizinsakit']);
    Route::get('/pengajuanizin/{id}/batalkan', [MonitoringAbsenController::class, 'batalkanizinsakit']);

    Route::get('/setlokasi', [MonitoringAbsenController::class, 'setlokasi']);
    Route::post('/setlokasi/update', [MonitoringAbsenController::class, 'setlokasiupdate']);

    Route::get('/laporan/absensi', [MonitoringAbsenController::class, 'rekapabsen']);
    Route::post('/cetakabsen', [MonitoringAbsenController::class, 'cetakabsen']);

    Route::get('/laporan/kegiatan', [MonitoringAbsenController::class, 'rekapkegiatan']);
    Route::post('/cetakkegiatan', [MonitoringAbsenController::class, 'cetakkegiatan']);
});



Route::get('/cek', function () {
    // Auth::guard('peserta')->logout();
    // Auth::guard('user')->logout();
    dd(auth::guard('user')->user());
    // dd(auth::guard('peserta')->user());
});