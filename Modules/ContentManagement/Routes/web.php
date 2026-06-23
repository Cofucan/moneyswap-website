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

Route::prefix('contentmanagement')->group(function() {
    Route::get('/', 'ContentManagementController@index');
});
Route::get('/page/{page}', 'PageController@page')->name('page');
Route::get('/privacy-policy', 'PageController@privacy')->name('privacy');
Route::get('pages/toggle/{page}', 'PageController@toggle')->name('pages.toggle');
Route::get('pages/thumbnail/{page}', 'PageController@thumbnail')->name('pages.thumbnail');
Route::get('pages/manage', 'PageController@manage')->name('pages.manage');
Route::get('pricing', 'PageController@pricing')->name('pricing');
Route::post('pages/changeimage', 'PageController@changeimage')->name('pages.changeimage');
Route::post('pages/changethumb', 'PageController@changethumb')->name('pages.changethumb');
Route::post('pages/changestatus', 'PageController@changestatus')->name('pages.changestatus');
Route::resource('pages', 'PageController');

Route::get('posts/details/{slug}', 'PostController@details')->name('posts.details');
Route::post('posts/process', 'PostController@process')->name('posts.process');
Route::post('posts/addclassifications', 'PostController@addclassifications')->name('posts.addclassifications');
Route::get('posts/manage', 'PostController@manage')->name('posts.manage');
Route::get('posts/mypost', 'PostController@mypost')->name('posts.mypost');
Route::get('posts/toggle/{post}', 'PostController@toggle')->name('posts.toggle');
Route::resource('posts', 'PostController');

Route::post('classifications/changestatus', 'StreamController@changestatus')->name('classifications.changestatus');
Route::get('classifications/manage', 'ClassificationController@manage')->name('classifications.manage');
Route::get('classifications/toggle/{classification}', 'ClassificationController@toggle')->name('classifications.toggle');
Route::post('classifications/detachpost', 'ClassificationController@detachaddPost')->name('classifications.detachpost');
Route::get('classifications/empty/{classification}', 'ClassificationController@empty')->name('classifications.empty');
Route::resource('classifications', 'ClassificationController');

Route::get('contactus/manage', 'ContactusController@manage')->name('manageContactus');
Route::resource('contactus', 'ContactusController');

Route::post('objections/process', 'ObjectionController@process')->name('objections.process');
Route::resource('objections', 'ObjectionController');

Route::get('faqs/manage', 'FaqController@manage')->name('faqs.manage');
Route::get('faqs/toggle/{faq}', 'FaqController@toggle')->name('faqs.toggle');
Route::resource('faqs', 'FaqController');


Route::post('sliders/changeimage', 'SliderController@changeimage')->name('sliders.changeimage');
Route::get('sliders/manage', 'SliderController@manage')->name('sliders.manage');
Route::get('sliders/toggle/{slider}', 'SliderController@toggle')->name('sliders.toggle');
Route::post('sliders/bulkreorder', 'SliderController@bulkreorder')->name('sliders.bulkreorder');
Route::resource('sliders', 'SliderController');

Route::get('albums/manage', 'AlbumController@manage')->name('albums.manage');
Route::get('albums/toggle/{album}', 'AlbumController@toggle')->name('albums.toggle');
Route::get('albums/get-owner-list', 'AlbumController@getownerlist');
Route::get('media', 'AlbumController@index');
Route::post('albums/changephoto', 'AlbumController@changephoto')->name('albums.changephoto');
Route::resource('albums', 'AlbumController');

Route::get('photos/{album}', 'PhotoController@albumphoto')->name('photostudio');
Route::get('pictures/{album?}', 'PhotoController@home')->name('pictures');
Route::post('photo', 'PhotoController@uploadImage');
Route::get('photo/manage', 'PhotoController@manage')->name('photos.manage');
Route::resource('photos', 'PhotoController');

// Route::get('videos/{album}', 'VideoController@albumvideo')->name('videostudio');
// Route::get('videos/{album?}', 'VideoController@home')->name('videos');
Route::get('videos/toggle/{video}', 'VideoController@toggle')->name('videos.toggle');
Route::post('video', 'VideoController@uploadImage');
Route::get('videos/manage', 'VideoController@manage')->name('videos.manage');
Route::resource('videos', 'VideoController');

Route::get('segments/manage', 'SegmentController@manage')->name('manageSections');
Route::get('segment/{slug}', 'SegmentController@segment');
Route::get('segments/get-segmentable-list', 'SegmentController@getsegmentablelist');
Route::resource('segments', 'SegmentController');

Route::get('content-sections/manage/{page?}', 'ContentSectionController@manage')->name('content-sections.manage');
Route::post('content-sections', 'ContentSectionController@store')->name('content-sections.store');
Route::put('content-sections/{section}', 'ContentSectionController@update')->name('content-sections.update');
Route::post('content-sections/{section}/image', 'ContentSectionController@changeImage')->name('content-sections.image');
Route::get('content-sections/toggle/{section}', 'ContentSectionController@toggle')->name('content-sections.toggle');
Route::delete('content-sections/{section}', 'ContentSectionController@destroy')->name('content-sections.destroy');

Route::get('howitworks/toggle/{howitwork}', 'HowItWorkController@toggle')->name('howitworks.toggle');
Route::get('howitworks/manage', 'HowItWorkController@manage')->name('howitworks.manage');
Route::post('howitworks/sections', 'HowItWorkController@updateSections')->name('howitworks.sections.update');
Route::post('howitworks/groups', 'HowItWorkGroupController@store')->name('howitworks.groups.store');
Route::get('howitworks/groups/manage', 'HowItWorkGroupController@manage')->name('howitworks.groups.manage');
Route::put('howitworks/groups/{group}', 'HowItWorkGroupController@update')->name('howitworks.groups.update');
Route::get('howitworks/groups/{group}', 'HowItWorkGroupController@show')->name('howitworks.groups.show');
Route::get('howitworks/groups/toggle/{group}', 'HowItWorkGroupController@toggle')->name('howitworks.groups.toggle');
Route::post('howitworks/groups/{group}/items', 'HowItWorkGroupController@attachItems')->name('howitworks.groups.items.attach');
Route::put('howitworks/groups/{group}/items/{howitwork}/order', 'HowItWorkGroupController@updateItemOrder')->name('howitworks.groups.items.order');
Route::put('howitworks/groups/{group}/items/{howitwork}/toggle', 'HowItWorkGroupController@toggleItemStatus')->name('howitworks.groups.items.toggle');
Route::delete('howitworks/groups/{group}/items/{howitwork}', 'HowItWorkGroupController@detachItem')->name('howitworks.groups.items.detach');
Route::delete('howitworks/groups/{group}', 'HowItWorkGroupController@destroy')->name('howitworks.groups.destroy');
Route::get('get-involved', 'HowItWorkController@getinvolved')->name('get-involved');
Route::post('howitworks/changeimage', 'HowItWorkController@changeimage')->name('howitworks.changeimage');
Route::put('howitworks/{howitwork}/sync-groups', 'HowItWorkController@syncGroups')->name('howitworks.syncgroups');
Route::resource('howitworks', 'HowItWorkController');

Route::get('advantages/toggle/{advantage}', 'AdvantageController@toggle')->name('advantages.toggle');
Route::post('advantages/changeimage', 'AdvantageController@changeimage')->name('advantages.changeimage');
Route::get('advantages/manage', 'AdvantageController@manage')->name('advantages.manage');
Route::resource('advantages', 'AdvantageController');

Route::get('guidelines/manage', 'GuidelineController@manage')->name('guidelines.manage');
Route::get('guideline/{slug}', 'GuidelineController@guideline')->name('guideline');
Route::get('guidelines/toggle/{guideline}', 'GuidelineController@toggle')->name('guidelines.toggle');
Route::resource('guidelines', 'GuidelineController');

Route::get('testimonials/toggle/{testimonial}', 'TestimonialController@toggle')->name('testimonials.toggle');
Route::get('testimonials/info/{slug}', 'TestimonialController@testimonial');
Route::get('testimonials/manage', 'estimonialController@manage')->name('testimonials.manage');
Route::resource('testimonials', 'TestimonialController');
