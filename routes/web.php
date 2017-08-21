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

Route::get('/', function () {
    return view('index');
});

Route::resource('users', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/frame/{id}', 'FrameController@show');
Route::get('/library', 'LibraryController@index');
Route::get('/library/camera/{cam}', 'LibraryController@camera');
Route::get('/library/video/{id}', 'LibraryController@video');
Route::get('/library/video/{id}/seq', 'LibraryController@videoSeq');
Route::post('/library/video/{id}/comment', 'LibraryController@comment');
Route::delete('/library/comment/{id}/delete', 'LibraryController@delete_comment');
