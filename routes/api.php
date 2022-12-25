<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/coba', [ApiController::class, 'coba']);
Route::post('/updateToken', [ApiController::class, 'updateToken']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/loginSosmed', [ApiController::class, 'login_sosmed']);
Route::get('/kendaraanGet', [ApiController::class, 'kendaraanGet']);
Route::post('/kendaraanCari', [ApiController::class, 'kendaraanCari']);
Route::post('/kendaraanDetail', [ApiController::class, 'kendaraanDetail']);
Route::get('/cvGet', [ApiController::class, 'cvGet']);
Route::post('/cvDetail', [ApiController::class, 'cvDetail']);
Route::post('/chatGet', [ApiController::class, 'chatGet']);
Route::post('/chatRoomGet', [ApiController::class, 'chatRoomGet']);
Route::post('/chatRoomSend', [ApiController::class, 'chatRoomSend']);
Route::post('/supirDetail', [ApiController::class, 'supirDetail']);
Route::get('/bankGet', [ApiController::class, 'bankGet']);
Route::post('/pemesananInsert', [ApiController::class, 'pemesananInsert']);
Route::post('/pemesananGet', [ApiController::class, 'pemesananGet']);
Route::post('/pemesananDetail', [ApiController::class, 'pemesananDetail']);
Route::post('/pemesananKonfirmasi', [ApiController::class, 'pemesananKonfirmasi']);
Route::post('/pemesananPembayaran', [ApiController::class, 'pemesananPembayaran']);
Route::post('/pemesananUlasan', [ApiController::class, 'pemesananUlasan']);
Route::post('/updateAkun', [ApiController::class, 'updateAkun']);
Route::post('/updatePassword', [ApiController::class, 'updatePassword']);
Route::post('/updateFoto', [ApiController::class, 'updateFoto']);
Route::post('/registerCV', [ApiController::class, 'registerCV']);

Route::post('/cv_login', [ApiController::class, 'cv_login']);
Route::post('/cv_pemesananGet', [ApiController::class, 'cv_pemesananGet']);
Route::post('/cv_pemesananDetail', [ApiController::class, 'cv_pemesananDetail']);
Route::post('/cv_pemesananKonfirmasi', [ApiController::class, 'cv_pemesananKonfirmasi']);
Route::post('/cv_pemesananpembayaranKonfirmasi', [ApiController::class, 'cv_pemesananpembayaranKonfirmasi']);
Route::post('/cv_pemesananDiantarkanKonfirmasi', [ApiController::class, 'cv_pemesananDiantarkanKonfirmasi']);
Route::post('/cv_pemesananSupirInsert', [ApiController::class, 'cv_pemesananSupirInsert']);
Route::post('/cv_pemesananSupirChekInsert', [ApiController::class, 'cv_pemesananSupirChekInsert']);
Route::post('/cv_sopirTambah', [ApiController::class, 'cv_sopirTambah']);
Route::post('/cv_sopirDetail', [ApiController::class, 'cv_sopirDetail']);
Route::post('/cv_sopirGet', [ApiController::class, 'cv_sopirGet']);
Route::post('/cv_kendaraanGet', [ApiController::class, 'cv_kendaraanGet']);
Route::post('/cv_detail', [ApiController::class, 'cv_detail']);
Route::post('/cv_updatePassword', [ApiController::class, 'cv_updatePassword']);

Route::post('/sopir_register', [ApiController::class, 'sopir_register']);
Route::post('/sopir_login', [ApiController::class, 'sopir_login']);
Route::post('/sopir_pemesananGet', [ApiController::class, 'sopir_pemesananGet']);
Route::post('/sopir_pemesananDiantarkanKonfirmasi', [ApiController::class, 'sopir_pemesananDiantarkanKonfirmasi']);
Route::post('/sopir_pemesananSelesaiKonfirmasi', [ApiController::class, 'sopir_pemesananSelesaiKonfirmasi']);
Route::post('/sopir_cvDetail', [ApiController::class, 'sopir_cvDetail']);
Route::post('/sopir_detail', [ApiController::class, 'sopir_detail']);
Route::get('/sopir_simGet', [ApiController::class, 'sopir_simGet']);
Route::post('/sopir_akunUpdate', [ApiController::class, 'sopir_akunUpdate']);
Route::post('/sopir_updatePassword', [ApiController::class, 'sopir_updatePassword']);
