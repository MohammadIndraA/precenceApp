<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [AuthController::class, 'login']);
Route::post('login/admin', [AuthController::class, 'loginAdmin']);
// Route::post('loginGuru', [AuthController::class, 'loginGuru']);
Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'auth:sanctum'
],
function() {
  
    //Siswsa
        Route::get('users', [UserController::class, 'index']);
        Route::get('user/{nis}', [UserController::class, 'bySiswa']);
        Route::get('user/data/{nis}', [UserController::class, 'byPresnsi']);
        Route::get('user/thisWeeks/{nis}', [UserController::class, 'thisWeek']);
        Route::put('user/update-password/{nis}', [UserController::class, 'updatePassword']);
        Route::get('user/show/{id}', [UserController::class, 'show']);
        Route::put('user/update/{nis}', [UserController::class, 'update']);
        Route::delete('user/delete/{nis}', [UserController::class, 'delete']);
        //kelas
        Route::get('kelas', [KelasController::class, 'index']);
        Route::post('kelas/create', [KelasController::class, 'store']);
        Route::get('kelas/show/{id}', [KelasController::class, 'show']);
        Route::put('kelas/update/{id}', [KelasController::class, 'update']);
        Route::delete('kelas/delete/{id}', [KelasController::class, 'delete']);
        //guru
        Route::get('guru', [GuruController::class, 'index']);
        Route::post('guru/create', [GuruController::class, 'store']);
        Route::get('guru/show/{id}', [GuruController::class, 'show']);
        Route::get('guru/showGuru/{nip}', [GuruController::class, 'showGuru']);
        Route::put('guru/update/{nip}', [GuruController::class, 'update']);
        Route::put('guru/updatePassword/{nip}', [GuruController::class, 'updatePassword']);
        Route::delete('guru/delete/{nip}', [GuruController::class, 'delete']);
        //barcode
        Route::get('barcode', [BarcodeController::class, 'index']);
        Route::get('barcode/data/{nip}', [BarcodeController::class, 'getbyGuru']);
        Route::post('barcode/create/{nip}', [BarcodeController::class, 'store']);
        Route::get('barcode/show/{id}', [BarcodeController::class, 'show']);
        Route::put('barcode/update/{id}', [BarcodeController::class, 'update']);
        Route::delete('barcode/delete/{id}', [BarcodeController::class, 'delete']);
        //mapel
        Route::get('mapel', [MataPelajaranController::class, 'index']);
        Route::post('mapel/create/', [MataPelajaranController::class, 'store']);
        Route::get('mapel/show/{id}', [MataPelajaranController::class, 'show']);
        Route::get('mapel/showDay/', [MataPelajaranController::class, 'showPerDay']);
        Route::put('mapel/update/{id}', [MataPelajaranController::class, 'update']);
        Route::delete('mapel/delete/{id}', [MataPelajaranController::class, 'delete']);
        //presensi
        Route::get('presensi', [PresensiController::class, 'index']);
        Route::post('presensi/create/{barcode}/{nis}', [PresensiController::class, 'store']);
        Route::get('presensi/show/{id}', [PresensiController::class, 'show']);
        Route::put('presensi/update/{id}', [PresensiController::class, 'update']);
        Route::delete('presensi/delete/{id}', [PresensiController::class, 'delete']);
        //akun
        Route::get('akun', [AkunController::class, 'index']);
        Route::post('akun/create/', [AkunController::class, 'store']);
        Route::get('akun/show/{nis}', [AkunController::class, 'show']);
        Route::put('akun/update/{nis}', [AkunController::class, 'update']);
        Route::delete('akun/delete/{nis}', [AkunController::class, 'delete']);
    }
);
Route::post('akun/creates/', [AkunController::class, 'storedata']);
