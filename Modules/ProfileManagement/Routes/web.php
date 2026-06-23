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

Route::prefix('profilemanagement')->group(function() {
    Route::get('/', 'ProfileManagementController@index');
});
Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

Route::get('/activator','ProfileController@activator')->name('activator');
Route::post('users/swapemail','ProfileController@swapemail')->name('users.swapemail');
Route::post('profiles/reverify','ProfileController@reverify')->name('profiles.reverify');
Route::get('/changepassword','ProfileController@changepassword')->name('changepassword');
Route::post('/updatepassword','ProfileController@updatepassword')->name('updatepassword');
Route::post('/setpassword','ProfileController@setpassword')->name('users.setpassword');
Route::post('/changerole','ProfileController@changerole')->name('changerole');
Route::get('/users','ProfileController@users')->name('users.manage');
Route::get('users/show/{user}','ProfileController@user')->name('users.show');
Route::delete('/users/{user}','ProfileController@removeuser')->name('users.remove');
Route::get('profiles/makecontacts', 'ProfileController@makecontacts')->name('profiles.makecontacts');
Route::get('management', 'ProfileController@management')->name('management');
Route::get('profiles/upload', 'ProfileController@upload')->name('profiles.upload');
Route::post('profiles/import', 'ProfileController@import')->name('profiles.import');
Route::post('profiles/changephoto', 'ProfileController@changephoto')->name('profiles.changephoto');
Route::get('profiles/export', 'ProfileController@export')->name('profiles.export');
Route::get('profiles/{profile}/revenues', 'ProfileController@revenues')->name('profiles.revenues');
Route::get('profiles/wards/{profile}', 'ProfileController@wards')->name('profiles.wards');
Route::get('profiles/rolecategory/{rolecategory}', 'ProfileController@rolecategory')->name('profiles.rolecategory');
Route::get('profiles/manage', 'ProfileController@manage')->name('profiles.manage');
Route::get('profiles/people', 'ProfileController@people')->name('profiles.people');
Route::get('profiles/users/{profile}', 'ProfileController@users')->name('profiles.users');
Route::get('profiles/setup', 'ProfileController@setup')->name('profiles.setup');
Route::post('profiles/makeuser', 'ProfileController@makeuser')->name('profiles.makeuser');
Route::get('profiles/userdestroy/{user}', 'ProfileController@userdestroy')->name('profiles.userdestroy');
Route::post('profiles/search', 'ProfileController@search')->name('profiles.search');
Route::resource('profiles', 'ProfileController');

 

Route::get('profileaddresses/toggle/{profileaddress}', 'ProfileAddressController@toggle')->name('profileaddresses.toggle');
Route::get('profileaddresses/manage', 'ProfileAddressController@manage')->name('profileaddresses.manage');
Route::resource('profileaddresses', 'ProfileAddressController');

Route::get('members/manage', 'MemberController@manage')->name('members.manage');
Route::get('members/join', 'MemberController@join')->name('members.join');
Route::get('our-teams', 'MemberController@teams')->name('our-teams');
Route::get('members/settings', 'MemberController@home')->name('members.settings');
Route::get('members/offer/{member}', 'MemberController@offer')->name('members.offer');
Route::get('members/letter/{member}', 'MemberController@letter')->name('members.letter');
Route::post('members/process', 'MemberController@process')->name('members.process');
Route::post('members/bulkstore', 'MemberController@bulkstore')->name('members.bulkstore');
Route::resource('members', 'MemberController');

Route::get('deletions/info/{slug}', 'DeletionController@deletion');
Route::get('delete-profile', 'DeletionController@home')->name('delete-profile');
Route::get('deletions/manage', 'DeletionController@manage')->name('deletions.manage');
Route::resource('deletions', 'DeletionController');
