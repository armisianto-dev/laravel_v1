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

Route::get('/', 'Auth\DeveloperController@index');

// LOGIN
Route::prefix('/auth')->group(function(){
  Route::get('/developer', 'Auth\DeveloperController@index');
  Route::post('/developer/authenticating', 'Auth\DeveloperController@authenticating');
  Route::get('/developer/logout', 'Auth\DeveloperController@logout');
});

// DEVELOPER
// Default Page
Route::prefix('/home')->middleware('auth.developer')->group(function(){
  Route::get('/developer', 'Home\DeveloperController@index');
});
// Portal
Route::prefix('/sistem/portal')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\PortalController@index');
  Route::get('/create', 'Settings\Sistem\PortalController@create' );
  Route::post('/insert', 'Settings\Sistem\PortalController@insert' );
  Route::get('/edit/{portal_id?}', 'Settings\Sistem\PortalController@edit' );
  Route::post('/update/{portal_id?}', 'Settings\Sistem\PortalController@update' );
});
