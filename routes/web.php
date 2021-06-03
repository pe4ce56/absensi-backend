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
    return redirect(route('login.index'));
})->name('home');

Route::get('/login', 'Auth\LoginController@index')->name('login.index');
Route::post('/login', 'Auth\LoginController@login')->name('login.process');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'Admin\HomeController@index')->name('dashboard.index');
    Route::get('/absent', 'Admin\AbsensiController@index')->name('absensi.index');
    Route::post('/print-report', 'Admin\AbsensiController@printReport')->name('print');

    Route::resource('/kelas', 'Admin\KelasController');
    Route::resource('/siswa', 'Admin\SiswaController');
    Route::resource('/guru', 'Admin\GuruController');
    Route::resource('/mapel', 'Admin\MapelController');
    Route::resource('/jadwal', 'Admin\JadwalController');

    Route::get('/change-password', 'Admin\HomeController@changePassword')->name('change-password.index');
    Route::post('/change-password', 'Admin\HomeController@changePasswordStore')->name('change-password.store');
});