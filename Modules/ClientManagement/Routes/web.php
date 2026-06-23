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

Route::prefix('clientmanagement')->group(function() {
    Route::get('/', 'ClientManagementController@index');
});


Route::get('clients/upload', 'ClientController@upload')->name('clients.upload');
Route::post('clients/import', 'ClientController@import')->name('clients.import');
Route::get('clients/export', 'ClientController@export')->name('clients.export');
Route::get('clients/home', 'ClientController@children')->name('clients.home');
Route::get('clients/manage', 'ClientController@manage')->name('clients.manage');
// Route::get('clients/bulkenrol/{academicterm}', 'ClientController@bulkenrol')->name('clients.bulkenrol');
//Route::get('clients/scholarships', 'ClientController@scholarships')->name('clients.scholarships');
Route::get('clients/manifest/{status}', 'ClientController@manifest')->name('clients.manifest');
Route::post('clients/gradefilter', 'ClientController@gradefilter')->name('clients.gradefilter');
Route::Post('clients/gradeprinter', 'ClientController@gradeprinter')->name('clients.gradeprinter');
Route::get('get-help', 'ClientController@create')->name('get-help');
Route::get('clients/stats', 'ClientController@stats')->name('clients.stats');
Route::get('clients/home/{client}', 'ClientController@home')->name('clients.home');
Route::get('clients/review/{client}', 'ClientController@review')->name('clients.review');
Route::get('clients/make/{profile}', 'ClientController@make')->name('clients.make');
Route::get('clients/add/{cohort}', 'ClientController@add')->name('clients.add');
Route::get('clients/new/{agent}', 'ClientController@new')->name('clients.new');
Route::post('clients/process', 'ClientController@process')->name('clients.process');
Route::post('clients/change', 'ClientController@change')->name('clients.change');
Route::post('clients/bulkactivate', 'ClientController@bulkactivate')->name('clients.bulkactivate');
Route::post('clients/activate', 'ClientController@activate')->name('clients.activate');
Route::post('clients/activation', 'ClientController@activation')->name('clients.activation');
Route::post('clients/deactivation', 'ClientController@deactivation')->name('clients.deactivation');
Route::post('clients/search', 'ClientController@search')->name('clients.search');
Route::get('clients/get-batchstudents', 'ClientController@getbatchstudents');

//Route::post('clients/link', 'ClientController@link')->name('clients.link');
Route::get('clients/toggle/{client}', 'ClientController@toggle')->name('clients.toggle');
Route::resource('clients', 'ClientController');

Route::get('clientcategories/manage', 'ClientCategoryController@manage')->name('clientcategories.manage');
Route::get('clientcategories/toggle{clientcategory}', 'ClientCategoryController@toggle')->name('clientcategories.toggle');
Route::get('clientcategories/clients/{clientcategory}', 'ClientCategoryController@clients')->name('clientcategories.clients');
Route::resource('clientcategories', 'ClientCategoryController');

Route::get('cohorts/manage', 'CohortController@manage')->name('cohorts.manage');
Route::post('cohorts/process', 'CohortController@process')->name('cohorts.process');
Route::get('cohorts/toggle/{cohort}', 'CohortController@toggle')->name('cohorts.toggle');
Route::get('cohorts/academicterm/{cohort}', 'CohortController@academicterm')->name('cohorts.academicterm');
Route::resource('cohorts', 'CohortController');

Route::get('kindreds/manage', 'KindredController@manage')->name('kindreds.manage');
Route::get('kindreds/manifest/{status}', 'KindredController@manifest')->name('kindreds.manifest');
Route::get('kindreds/stats', 'KindredController@stats')->name('kindreds.stats');
Route::get('kindreds/home/{client}', 'KindredController@home')->name('kindreds.home');
Route::get('kindreds/review/{client}', 'KindredController@review')->name('kindreds.review');
Route::get('kindreds/make/{profile}', 'KindredController@make')->name('kindreds.make');
Route::get('kindreds/new/{client}', 'KindredController@new')->name('kindreds.new');
Route::post('kindreds/process', 'KindredController@process')->name('kindreds.process');
Route::post('kindreds/bulkactivate', 'KindredController@bulkactivate')->name('kindreds.bulkactivate');
Route::post('kindreds/activate', 'KindredController@activate')->name('kindreds.activate');
Route::post('kindreds/activation', 'KindredController@activation')->name('kindreds.activation');
Route::post('kindreds/deactivation', 'KindredController@deactivation')->name('kindreds.deactivation');
Route::get('kindreds/toggle/{kindred}', 'KindredController@toggle')->name('kindreds.toggle');
Route::resource('kindreds', 'KindredController');
