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

Route::prefix('catalogmanagement')->group(function() {
    Route::get('/', 'CatalogManagementController@index');
});

Route::get('pricecategories/toggle/{pricecategory}', 'PriceCategoryController@toggle')->name('pricecategories.toggle');
Route::resource('pricecategories','PriceCategoryController');

Route::get('prices/toggle/{price}', 'PriceController@toggle')->name('prices.toggle');
Route::get('prices/manage', 'PriceController@manage')->name('prices.manage');
Route::resource('prices', 'PriceController');

Route::get('features/toggle/{item}', 'FeatureController@toggle')->name('features.toggle');
Route::post('features/changeimage', 'FeatureController@changeimage')->name('features.changeimage');
Route::get('features/manage/{group?}', 'FeatureController@manage')->name('features.manage');
Route::resource('features', 'FeatureController');


Route::post('expertises/changeimage', 'ExpertiseController@changeimage')->name('expertises.changeimage');
Route::post('expertises/changethumb', 'ExpertiseController@changethumb')->name('expertises.changethumb');
Route::get('expertises/toggle/{expertise}', 'ExpertiseController@toggle')->name('expertises.toggle');
Route::get('expertises/manage', 'ExpertiseController@manage')->name('manageExpertises');
Route::get('expertise/{slug}', 'ExpertiseController@expertise');
Route::get('what-we-do', 'ExpertiseController@index');
Route::resource('expertises', 'ExpertiseController');

