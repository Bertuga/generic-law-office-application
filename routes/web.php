<?php

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

Route::get('/{any}', 'SpaController@index')->where('any', '^(?!api\/)[\/\w\.-]*');;
/*Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::post('auth/register', 'AuthController@register')->middleware('is.admin');
  Route::get('register-user', 'SpaController@index')->middleware('is.admin');
});

Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/change-password', 'AuthController@changePassword');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
  
});

Auth::routes();*/
