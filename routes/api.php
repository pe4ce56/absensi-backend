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

Route::post('/login', 'API\Auth\LoginController@loginAsStudentAndTeacher');

Route::prefix('/admin')->group(function(){
    Route::post('/login', 'API\Auth\LoginController@loginAsAdmin');

    Route::apiResource('/mapel', MapelController::class);
    Route::apiResource('/guru', GuruController::class);
    Route::apiResource('/kelas', KelasController::class);
    Route::apiResource('/siswa', SiswaController::class);
    Route::apiResource('/jadwal', JadwalController::class);
});
