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

Route::prefix('membershipmanagement')->group(function() {
    Route::get('/', 'MembershipManagementController@index');
});

Route::get('members/upload', 'MemberController@upload')->name('members.upload');
Route::post('members/import', 'MemberController@import')->name('members.import');
Route::get('members/export', 'MemberController@export')->name('members.export');
Route::get('members/status/{status}', 'MemberController@status')->name('members.status');
Route::get('members/settings', 'MemberController@home')->name('members.settings');
Route::get('members/offer/{member}', 'MemberController@offer')->name('members.offer');
Route::get('members/letter/{member}', 'MemberController@letter')->name('members.letter');
Route::post('members/process', 'MemberController@process')->name('members.process');
Route::post('members/bulkstore', 'MemberController@bulkstore')->name('members.bulkstore');

Route::get('members/home', 'MemberController@home')->name('members.home');
Route::get('members/join', 'MemberController@join')->name('members.join');
Route::get('members/preview{member}', 'MemberController@preview')->name('members.preview');
Route::post('members/signup', 'MemberController@signup')->name('members.signup');
Route::get('members/manage', 'MemberController@manage')->name('members.manage');
Route::get('members/past', 'MemberController@past')->name('members.past');
Route::resource('members', 'MemberController');

Route::get('member/requirements', 'RequirementController@index');
Route::get('member/payments', 'RequirementController@payment')->name('make-payment');
// Route::get('memberships/home', 'RequirementController@index')->name('memberships.home');
Route::get('requirements/print','RequirementController@generatePDF');
Route::get('requirements/toggle/{requirement}', 'RequirementController@toggle')->name('requirements.toggle');
Route::get('requirements/manage', 'RequirementController@manage')->name('manageRequirements');
Route::resource('requirements', 'RequirementController');
