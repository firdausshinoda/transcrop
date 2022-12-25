<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiAdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [DashboardController::class, 'index']);
Route::get('/mitra', [DashboardController::class, 'mitra']);
Route::get('/tentang', [DashboardController::class, 'tentang']);
Route::get('/masuk', [DashboardController::class, 'masuk']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/notifikasi', [AdminController::class, 'notifikasi']);
Route::get('/admin/notifikasi_tolak/{id}', [AdminController::class, 'notifikasi_tolak']);
Route::get('/admin/jenis_kendaraan', [AdminController::class, 'jenis_kendaraan']);
Route::get('/admin/jenis_kendaraan_tambah', [AdminController::class, 'jenis_kendaraan_tambah']);
Route::get('/admin/jenis_kendaraan_ubah/{id}', [AdminController::class, 'jenis_kendaraan_ubah']);
Route::get('/admin/jenis_barang', [AdminController::class, 'jenis_barang']);
Route::get('/admin/jenis_barang_tambah', [AdminController::class, 'jenis_barang_tambah']);
Route::get('/admin/jenis_barang_ubah/{id}', [AdminController::class, 'jenis_barang_ubah']);
Route::get('/admin/jenis_sim', [AdminController::class, 'jenis_sim']);
Route::get('/admin/jenis_sim_tambah', [AdminController::class, 'jenis_sim_tambah']);
Route::get('/admin/jenis_sim_ubah/{id}', [AdminController::class, 'jenis_sim_ubah']);
Route::get('/admin/bank', [AdminController::class, 'bank']);
Route::get('/admin/bank_tambah', [AdminController::class, 'bank_tambah']);
Route::get('/admin/bank_ubah/{id}', [AdminController::class, 'bank_ubah']);
Route::get('/admin/pemesanan', [AdminController::class, 'pemesanan']);
Route::get('/admin/pemesanan_detail/{id}', [AdminController::class, 'pemesanan_detail']);
Route::get('/admin/perusahaan', [AdminController::class, 'perusahaan']);
Route::get('/admin/perusahaan_detail/{id}', [AdminController::class, 'perusahaan_detail']);
Route::get('/admin/sopir', [AdminController::class, 'sopir']);
Route::get('/admin/sopir_detail/{id}', [AdminController::class, 'sopir_detail']);
Route::get('/admin/pengguna', [AdminController::class, 'pengguna']);
Route::get('/admin/pengguna_detail/{id}', [AdminController::class, 'pengguna_detail']);
Route::get('/admin/kritik_saran', [AdminController::class, 'kritik_saran']);
Route::get('/admin/laporan', [AdminController::class, 'laporan']);
Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan']);
Route::get('/admin/pengaturan_ubah/{id}', [AdminController::class, 'pengaturan_ubah']);
Route::get('/admin/akun', [AdminController::class, 'akun']);
Route::get('/admin/keluar', [AdminController::class, 'keluar']);

Route::get('/admin/cetak_statistik_pemesanan', [AdminController::class, 'cetak_statistik_pemesanan']);

Route::post('/api_delete', [ApiAdminController::class, 'api_delete']);
Route::post('/api_login', [ApiAdminController::class, 'api_login']);
Route::post('/api_notifikasi_konfirmasi', [ApiAdminController::class, 'api_notifikasi_konfirmasi']);
Route::post('/api_notifikasi_tolak', [ApiAdminController::class, 'api_notifikasi_tolak']);
Route::post('/api_jenis_kendaraan_add', [ApiAdminController::class, 'api_jenis_kendaraan_add']);
Route::post('/api_jenis_kendaraan_update', [ApiAdminController::class, 'api_jenis_kendaraan_update']);
Route::post('/api_jenis_barang_add', [ApiAdminController::class, 'api_jenis_barang_add']);
Route::post('/api_jenis_barang_update', [ApiAdminController::class, 'api_jenis_barang_update']);
Route::post('/api_jenis_sim_add', [ApiAdminController::class, 'api_jenis_sim_add']);
Route::post('/api_jenis_sim_update', [ApiAdminController::class, 'api_jenis_sim_update']);
Route::post('/api_bank_add', [ApiAdminController::class, 'api_bank_add']);
Route::post('/api_bank_update', [ApiAdminController::class, 'api_bank_update']);
Route::post('/api_pengaturan_update', [ApiAdminController::class, 'api_pengaturan_update']);
Route::post('/api_akun_update', [ApiAdminController::class, 'api_akun_update']);
Route::post('/api_password_update', [ApiAdminController::class, 'api_password_update']);
Route::post('/api_grafik_pemesanan_bulan', [ApiAdminController::class, 'api_grafik_pemesanan_bulan']);
Route::post('/api_grafik_pemesanan_tahun', [ApiAdminController::class, 'api_grafik_pemesanan_tahun']);
Route::get('/tbl_laporan_pemesanan', [ApiAdminController::class, 'tbl_laporan_pemesanan']);
