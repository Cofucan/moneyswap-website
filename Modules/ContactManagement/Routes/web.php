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

Route::prefix('contactmanagement')->group(function() {
    Route::get('/', 'ContactManagementController@index');
});

Route::get('contacts/manage', 'ContactController@manage')->name('contacts.manage');
Route::get('contacts/get-contactable-list', 'ContactController@getcontactablelist');
Route::resource('contacts', 'ContactController');

Route::resource('contacttypes', 'ContactTypeController');

Route::get('telephones/manage', 'TelephoneController@manage')->name('telephones.manage');
Route::post('telephones/type', 'TelephoneController@posttelephoneType')->name('telephones.telephoneType');;
Route::get('telephones/get-telephoneable-list', 'TelephoneController@gettelephoneablelist');
Route::resource('telephones', 'TelephoneController');

Route::get('salescycles/toggle/{salescycle}', 'SalesCycleController@toggle')->name('salescycles.toggle');
Route::resource('salescycles', 'SalesCycleController');

Route::get('salescycles/toggle/{salescycle}', 'SalesCycleController@toggle')->name('salescycles.toggle');
Route::resource('salesactions', 'SalesActionController');

Route::get('leads/manage', 'LeadController@manage')->name('leads.manage');
Route::resource('leads', 'LeadController');

Route::get('newslettersubscribers/manage', 'NewsletterSubscriberController@manage')->name('newslettersubscribers.manage');
Route::resource('newslettersubscribers', 'NewsletterSubscriberController');
