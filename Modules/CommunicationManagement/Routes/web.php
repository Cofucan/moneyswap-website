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

Route::prefix('communicationmanagement')->group(function() {
    Route::get('/', 'CommunicationManagementController@index');
});

Route::post('objections/process', 'ObjectionController@process')->name('objections.process');
Route::resource('objections', 'ObjectionController');

Route::post('conversations/addreply', 'ConversationController@replyStore')->name('conversations.addreply');
Route::get('conversations/manage', 'ConversationController@manage')->name('conversations.manage');
Route::resource('conversations', 'ConversationController');

Route::get('communications/details/{slug}', 'CommunicationController@details')->name('communications.details');
Route::get('communications/manage', 'CommunicationController@manage')->name('communications.manage');
Route::get('communications/index/{client}', 'CommunicationController@index');
Route::get('communications/create/{client}', 'CommunicationController@create');
Route::resource('communications', 'CommunicationController');

Route::get('announcement/read/{slug}', 'AnnouncementController@item')->name('announcements.read');
Route::get('announcements/manage', 'AnnouncementController@manage')->name('announcements.manage');
Route::get('announcements/outbox/{status}', 'AnnouncementController@outbox')->name('announcements.outbox');
Route::get('announcements/inbox', 'AnnouncementController@inbox')->name('announcements.inbox');
Route::get('announcements/academicterm/{academicterm}', 'AnnouncementController@academicterm')->name('announcements.academicterm');
Route::get('announcements/toggle/{announcement}', 'AnnouncementController@toggle')->name('announcements.toggle');
Route::resource('announcements', 'AnnouncementController');

Route::get('incidentcategories/toggle/{state}', 'IncidentCategoryController@toggle')->name('incidentcategories.toggle');
Route::get('incidentcategories/manage', 'IncidentCategoryController@manage')->name('incidentcategories.manage');
Route::resource('incidentcategories', 'IncidentCategoryController');

Route::get('incident/read/{slug}', 'IncidentController@item')->name('incidents.read');
Route::get('incidents/manage', 'IncidentController@manage')->name('incidents.manage');
Route::get('incidents/home', 'IncidentController@home')->name('incidents.home');
Route::post('incidents/process', 'IncidentController@process')->name('incidents.process');
Route::get('incidents/toggle', 'IncidentController@toggle')->name('incidents.toggle');
Route::resource('incidents', 'IncidentController');

Route::post('comments/addreply', 'CommentController@replyStore')->name('comments.addreply');
Route::get('comments/manage', 'CommentController@manage')->name('comments.manage');
Route::resource('comments', 'CommentController');

Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'MessagesController@index']);
    Route::get('/unread', ['as' => 'unread', 'uses' => 'MessagesController@unread']); // ajax + Pusher
    Route::get('/create', ['as' => 'create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'update', 'uses' => 'MessagesController@update']);
    Route::get('{id}/read', ['as' => 'read', 'uses' => 'MessagesController@read']); // ajax + Pusher
});

Route::group(['prefix' => 'thread', 'as' => 'thread.'], function() {
    Route::get('/{id}/add-participant/{userId}', ['as' => 'add-participant', 'uses' => 'ThreadController@addParticipant']);
    Route::get('/{id}/remove-participant/{userId}', ['as' => 'remove-participant', 'uses' => 'ThreadController@removeParticipant']);
    Route::get('/{id}/star', ['as' => 'star', 'uses' => 'ThreadController@star']);
    Route::get('/{id}/unstar', ['as' => 'unstar', 'uses' => 'ThreadController@unstar']);

});
 