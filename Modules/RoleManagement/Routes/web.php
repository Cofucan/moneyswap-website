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

Route::prefix('rolemanagement')->group(function() {
    Route::get('/', 'RoleManagementController@index');
});
Route::get('rolecategories/manage', 'RoleCategoryController@manage')->name('rolecategories.manage');
Route::get('rolecategories/get-profiles', 'RoleCategoryController@profiles');
Route::resource('rolecategories', 'RoleCategoryController');

Route::get('roles/get-users', 'RoleController@getuserlist');
Route::resource('roles', 'RoleController');
Route::resource('rolecategories', 'RoleCategoryController');
Route::resource('criteria', 'CriteriumController');
