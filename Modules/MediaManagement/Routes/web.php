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

Route::prefix('mediamanagement')->group(function() {
    Route::get('/', 'MediaManagementController@index');
});
Route::get('singlecreate', 'AttachmentController@singlecreate');
Route::post('singlesave', 'AttachmentController@singlesave');
Route::get('multiple-image', 'AttachmentController@index');
Route::post('multiple-save', 'AttachmentController@savemultiple');
Route::get('attachment/{filename}', 'AttachmentController@displayImage')->name('attachment.displayImage');
Route::get('attachments/download/{attachment}', 'AttachmentController@download')->name('attachments.download');
Route::resource('attachments', 'AttachmentController');
