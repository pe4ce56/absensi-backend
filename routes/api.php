<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use API\Admin\MapelController;
use API\Admin\GuruController;
use API\Admin\KelasController;
use API\Admin\SiswaController;
use API\Admin\JadwalController;

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


Route::post('/login', 'API\Auth\LoginController@defaultLogin');

Route::post('/logout', 'API\Auth\LoginController@logout');

Route::prefix('/operator')->group(function(){
    Route::post('/login', 'API\Auth\LoginController@operatorLogin');
});

Route::prefix('/admin')->group(function(){
    Route::post('/login', 'API\Auth\LoginController@adminLogin');
    Route::get('/accessDenied', 'API\Auth\LoginController@accessDenied')->name('accessDenied');

    Route::apiResource('/mapel', MapelController::class);
    Route::apiResource('/guru', GuruController::class);
    Route::apiResource('/kelas', KelasController::class);
    Route::apiResource('/siswa', SiswaController::class);
    Route::apiResource('/jadwal', JadwalController::class);
});

Route::prefix('/guru')->group(function () {
    Route::get('/get-schedule', 'API\Guru\HomeController@getSchedule');
    Route::get('/get-absent', 'API\Guru\HomeController@getAbsent');

    Route::get('/profile/{id}', 'API\Guru\ProfileController@getProfileDetails');
    Route::put('/profile/{id}', 'API\Guru\ProfileController@updateProfileDetails');
});

Route::prefix('/siswa')->group(function () {
    Route::get('/absent', 'API\Siswa\HomeController@getAbsent');
    Route::get('/get-absent-by-schedule/{id_schedule}', 'API\Siswa\HomeController@getAbsentBySchedule');
    Route::post('/absent', 'API\Siswa\HomeController@absent');

    Route::get('/get-schedule', 'API\Siswa\HomeController@getSchedule');
    Route::get('/get-schedule-by-day/{day}', 'API\Siswa\HomeController@getScheduleByDay');

    Route::get('/profile', 'API\Siswa\HomeController@getProfile');
});
