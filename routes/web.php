<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use Faker\Guesser\Name;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/menu', [MenuController::class,'index']) ->name(name:'menu');
Route::post('/menu/insertcart', [TransaksiController::class,'insertcart']);
Route::get('/cart', [TransaksiController::class,'cart']);
Route::get('/cart/hapus/{id}', [TransaksiController::class,'hapuscart']);
Route::POST('/transaksi/tambah', [TransaksiController::class,'tambahtransaksi']);
Route::get('/transaksi/tambah/detail', [TransaksiController::class,'tambah_detail'])->name(name:'tambahdetail');
// Route::get('/mail', [TransaksiController::class,'sendEmail']);
Route::get('/transaksi/blmbyr', [TransaksiController::class,'belumbayar']);
Route::get('/transaksi/blmbyr2/{id}', [TransaksiController::class,'belumbayar2']);
Route::post('/transaksi/bayar', [TransaksiController::class,'bayar']);
Route::get('/transaksi/proses', [TransaksiController::class,'proses']);
Route::get('/transaksi/proses2/{id}', [TransaksiController::class,'proses2']);