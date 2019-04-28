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
    Route::post('register-client', 'SpaController@registerClient');
    Route::post('delete-client', 'SpaController@deleteClient')->middleware('is.admin');
    Route::get('list-phones/{id_client}', 'SpaController@listPhones');
    Route::get('fetch-phone/{id}/{id_client}', 'SpaController@fetchPhone');
    Route::post('register-phone', 'SpaController@registerPhone');
    Route::post('delete-phone', 'SpaController@deletePhone');
    Route::get('list-lawsuits/{id_client}', 'SpaController@listLawsuits');
    Route::get('fetch-lawsuit/{id}/{id_client}', 'SpaController@fetchLawsuit');
    Route::post('register-lawsuit', 'SpaController@registerLawsuit');
    Route::post('delete-lawsuit', 'SpaController@deleteLawsuit');
});