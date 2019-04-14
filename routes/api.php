<?php

use Illuminate\Http\Request;

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register')->middleware('is.admin');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::get('listClients', 'SpaController@listClients');
  		Route::post('change-password', 'AuthController@changePassword');
        Route::post('logout', 'AuthController@logout');
    });

});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('list-clients', 'SpaController@listClients');
    Route::get('fetch-client/{id}', 'SpaController@fetchClient');
    Route::post('register-client', 'SpaController@registerClients');
});