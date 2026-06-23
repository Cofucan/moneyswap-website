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

Route::prefix('organizationmanagement')->group(function() {
    Route::get('/', 'OrganizationManagementController@index');
});
Route::get('industries/toggle/{industry}', 'IndustryController@toggle')->name('industries.toggle');
Route::resource('industries', 'IndustryController');

Route::get('organizations/autocomplete', 'OrganizationController@autocomplete')->name('organizations.autocomplete');
Route::get('organizations/about/{trading_name}', 'OrganizationController@about')->name('organizations.about');
Route::get('organizations/manage', 'OrganizationController@manage')->name('organizations.manage');
Route::resource('organizations', 'OrganizationController');

Route::get('outlets/toggle/{outlet}', 'OutletController@toggle')->name('outlets.toggle');
Route::get('outlets/manage', 'OutletController@manage')->name('outlets.manage');
Route::resource('outlets', 'OutletController');

Route::get('departments/details/{slug}', 'DepartmentController@subjectcategory')->name('departments.details');;
Route::get('departments/get-roles', 'DepartmentController@getroles');
Route::get('departments/toggle/{department}', 'DepartmentController@toggle')->name('departments.toggle');
Route::get('departments/manage', 'DepartmentController@manage')->name('departments.manage');
Route::resource('departments', 'DepartmentController');

Route::get('divisions/details/{slug}', 'DivisionController@details')->name('divisions.details');
Route::get('divisions/employers', 'DivisionController@employers')->name('divisions.employers');
Route::get('divisions/manage', 'DivisionController@manage')->name('divisions.manage');
Route::resource('divisions', 'DivisionController');

Route::get('corevalues/school/{slug}', 'CorevalueController@school')->name('corevalues.values');
Route::get('corevalues/toggle/{corevalue}', 'CorevalueController@toggle')->name('corevalues.toggle');
Route::get('corevalues/manage', 'CorevalueController@manage')->name('corevalues.manage');
Route::resource('corevalues', 'CorevalueController');


