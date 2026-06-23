<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;
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

Route::get('/refresh', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Cache cleared successfully'; //Return
});

Route::get('/', 'PortalController@welcome');
Route::get('/welcome', 'PortalController@construction');
Route::get('/admin', 'PortalController@admin')->name('admin');
Route::resource('portals', 'PortalController');

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard','HomeController@index')->name('dashboard');
Route::get('/secrets', 'SecretsController@show')->middleware('password.confirm');
Route::group(['middleware' => ['password.confirm']], function () {
    Route::get('/secret/edit', 'SecretController@edit')->name('secret.edit');
});

Route::get('enquiries/manage', 'EnquiryController@manage')->name('enquiries.manage');
Route::resource('enquiries', 'EnquiryController');

Route::get('briefs/info/{slug}', 'BriefController@brief');
Route::get('briefs/manage', 'BriefController@manage')->name('briefs.manage');
Route::resource('briefs', 'BriefController');

