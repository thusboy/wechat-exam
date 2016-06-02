<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/exam','AdminController@exam');
    Route::post('/admin/store-exam','AdminController@storeExam');
    Route::get('/admin/store-exam','AdminController@storeExam');
    Route::post('/admin/store-question','AdminController@storeQuestion');
    Route::get('/admin/store-question','AdminController@storeQuestion');
    Route::get('/admin/delete','AdminController@delete');
    Route::get('/admin/question','AdminController@question');
    Route::get('/admin/rank','AdminController@rank');
    Route::get('/subscribe','HomeController@subscribe');



});

Route::group(['middleware' => ['web', 'wechat.oauth','wechat.subscribe']], function () {
    Route::get('/','HomeController@index');
    Route::get('/home/error','HomeController@error');
    Route::post('/home/finished','HomeController@finished');
    Route::get('/home/finished','HomeController@finished');
    Route::post('/home/addmobile','HomeController@addmobile');
    Route::get('/home/rank','HomeController@rank');
});
