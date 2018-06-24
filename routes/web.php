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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post']);
Route::post('/admin/delete', 'AdminPostsController@deleteMedia');
Route::get('/home/category/{id}', ['as'=>'home.category', 'uses' => 'HomeController@postCategory']);
Route::post('/home/search', 'HomeController@search');

Route::group(['middleware' => ['admin']], function () {
    // Route::resource('admin', 'AdminHomeController');
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');
    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comment/replies', 'CommentRepliesController');


});

Route::group(['middleware' => ['auth']], function () {
    Route::post('comment/reply','CommentRepliesController@createReply');
});
Route::get('admin',['uses' => 'AdminHomeController@index'])->middleware('admin')->name('admin');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('home');
});

Route::get('home/search', function() {
    return redirect('/home/search/');
});



