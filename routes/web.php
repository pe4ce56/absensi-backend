<?php

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

Route::get('/', function(){
    return '';
})->name('home');

Route::resource('/kelas', 'Admin\KelasController');
Route::resource('/siswa', 'Admin\SiswaController');
Route::resource('/guru', 'Admin\GuruController');
Route::resource('/mapel', 'Admin\MapelController');
Route::resource('/jadwal', 'Admin\JadwalController');