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
  Route::get('/delete/{portal_id?}', 'Settings\Sistem\PortalController@delete' );
  Route::post('/remove/{portal_id?}', 'Settings\Sistem\PortalController@remove' );
});

// Group
Route::prefix('/sistem/groups')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\GroupsController@index');
  Route::post('/search', 'Settings\Sistem\GroupsController@search');
  Route::get('/create', 'Settings\Sistem\GroupsController@create' );
  Route::post('/insert', 'Settings\Sistem\GroupsController@insert' );
  Route::get('/edit/{group_id?}', 'Settings\Sistem\GroupsController@edit' );
  Route::post('/update/{group_id?}', 'Settings\Sistem\GroupsController@update' );
  Route::get('/delete/{group_id?}', 'Settings\Sistem\GroupsController@delete' );
  Route::post('/remove/{group_id?}', 'Settings\Sistem\GroupsController@remove' );
});

// Roles
Route::prefix('/sistem/roles')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\RolesController@index');
  Route::post('/search', 'Settings\Sistem\RolesController@search');
  Route::get('/create', 'Settings\Sistem\RolesController@create' );
  Route::post('/insert', 'Settings\Sistem\RolesController@insert' );
  Route::get('/edit/{group_id?}', 'Settings\Sistem\RolesController@edit' );
  Route::post('/update/{group_id?}', 'Settings\Sistem\RolesController@update' );
  Route::get('/delete/{group_id?}', 'Settings\Sistem\RolesController@delete' );
  Route::post('/remove/{group_id?}', 'Settings\Sistem\RolesController@remove' );
});

// Navigation
Route::prefix('/sistem/menu')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\NavigationController@index');
  Route::get('/navigation/{portal_id?}', 'Settings\Sistem\NavigationController@navigation' );
  Route::post('/search/{portal_id?}', 'Settings\Sistem\NavigationController@search' );
  Route::get('/create/{portal_id?}', 'Settings\Sistem\NavigationController@create' );
  Route::post('/insert/{portal_id?}', 'Settings\Sistem\NavigationController@insert' );
  Route::get('/edit/{portal_id?}/{nav_id?}', 'Settings\Sistem\NavigationController@edit' );
  Route::post('/update/{portal_id?}/{nav_id?}', 'Settings\Sistem\NavigationController@update' );
  Route::get('/delete/{portal_id?}/{nav_id?}', 'Settings\Sistem\NavigationController@delete' );
  Route::post('/remove/{portal_id?}/{nav_id?}', 'Settings\Sistem\NavigationController@remove' );
});


// Permissions
Route::prefix('/sistem/permissions')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\PermissionsController@index');
  Route::post('/search', 'Settings\Sistem\PermissionsController@search');
  Route::post('/set_portal/{role_id?}', 'Settings\Sistem\PermissionsController@set_portal');
  Route::get('/edit/{role_id?}', 'Settings\Sistem\PermissionsController@edit' );
  Route::post('/update/{role_id?}/{portal_id?}', 'Settings\Sistem\PermissionsController@update' );
});

// User
Route::prefix('/sistem/users')->middleware('auth.developer')->group(function(){
  Route::get('/', 'Settings\Sistem\UsersController@index');
  Route::post('/search', 'Settings\Sistem\UsersController@search');
  Route::get('/create', 'Settings\Sistem\UsersController@create' );
  Route::post('/insert', 'Settings\Sistem\UsersController@insert' );
  Route::get('/edit/{user_id?}', 'Settings\Sistem\UsersController@edit' );
  Route::post('/update/{user_id?}', 'Settings\Sistem\UsersController@update' );
  Route::get('/delete/{user_id?}', 'Settings\Sistem\UsersController@delete' );
  Route::post('/remove/{user_id?}', 'Settings\Sistem\UsersController@remove' );
});
