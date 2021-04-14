<?php

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

Route::post('/login', 'API\Auth\LoginController@loginAsStudentAndTeacher');

Route::post('/logout', 'API\Auth\LoginController@logout');

Route::prefix('/admin')->group(function(){
    Route::post('/login', 'API\Auth\LoginController@loginAsAdmin');

    Route::prefix('/mapel')->group(function(){
        Route::get('/', 'API\Admin\MapelController@read');
        Route::get('/find/{id}', 'API\Admin\MapelController@find');
        Route::post('/store', 'API\Admin\MapelController@store');
        Route::put('/update/{id}', 'API\Admin\MapelController@update');
        Route::delete('/delete/{id}', 'API\Admin\MapelController@delete');
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
