<?php

use App\Http\Controllers\MahasiswaController;
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
Route::resource('mahasiswa', MahasiswaController::class);
Route::Post('cari-mahasiswa', [MahasiswaController::class, 'cari'])->name('cari');

//Route::get('/', function () {
//    return view('mahasiswas.layout');
//});

//Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('dashboard');
