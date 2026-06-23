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

Route::prefix('locationmanagement')->group(function() {
    Route::get('/', 'LocationManagementController@index');
});

Route::post('countries/changestatus', 'CountryController@changestatus')->name('countries.changestatus');
Route::get('countries/manage', 'CountryController@manage')->name('manageCountries');
Route::get('countries/get-state-list', 'CountryController@getstatelist');
Route::resource('countries', 'CountryController');

Route::post('states/changestatus', 'StateController@changestatus')->name('states.changestatus');
Route::get('states/manage', 'StateController@manage')->name('manageStates');
Route::post('states/changeimage', 'StateController@changeimage')->name('states.changeimage');
Route::get('state/{state}', 'StateController@state')->name('state');
Route::get('states/get-city-list', 'StateController@getcitylist');
Route::resource('states', 'StateController');

Route::get('cities/upload', 'CityController@upload')->name('cities.upload');
Route::post('cities/import', 'CityController@import')->name('cities.import');
Route::get('cities/export', 'CityController@export')->name('cities.export');
Route::post('cities/changestatus', 'CityController@changestatus')->name('cities.changestatus');
Route::get('cities/manage', 'CityController@manage')->name('manageCities');
Route::get('cities/get-neighbourhood-list', 'CityController@getNeighbourhoodList');
Route::resource('cities', 'CityController');

Route::get('neighbourhoods/upload', 'NeighbourhoodController@upload')->name('neighbourhoods.upload');
Route::post('neighbourhoods/import', 'NeighbourhoodController@import')->name('neighbourhoods.import');
Route::get('neighbourhoods/export', 'NeighbourhoodController@export')->name('neighbourhoods.export');
Route::post('neighbourhoods/changestatus', 'NeighbourhoodController@changestatus')->name('neighbourhoods.changestatus');
Route::get('neighbourhoods/manage', 'NeighbourhoodController@manage')->name('manageNeighbourhoods');
Route::get('neighbourhoods/get-address-list', 'NeighbourhoodController@getaddresslist');
Route::resource('neighbourhoods', 'NeighbourhoodController');

Route::get('lots/manage', 'LotController@manage')->name('manageAddresses');
Route::resource('lots', 'lotController');


Route::resource('addresses', 'AddressController');