<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    return view('admin.login.index');
})->name('login');
Route::post('login/admin', [AuthController::class, 'loginAdmin']);

     
    Route::get('/admin',[AuthController::class, 'views']);
    Route::get('/akun',[AkunController::class, 'views']);
    Route::get('/mapel',[MataPelajaranController::class, 'views']);
    Route::get('/siswa',[UserController::class, 'views']);
    Route::get('/guru',[GuruController::class, 'views']);
    Route::get('/kelas',[KelasController::class, 'views']);
    Route::get('/logout',[AuthController::class, 'logout']);
