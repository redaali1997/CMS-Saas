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
Route::get('', 'WelcomeController@index')->name('welcome');
Route::get('blog/{post}', 'WelcomeController@show')->name('post.show');
Route::get('blog/category/{category}', 'WelcomeController@showCategory')->name('show.category');
Route::get('blog/tag/{tag}','WelcomeController@showTag')->name('show.tag');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'categoriesController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagsController');
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('restored/{post}', 'PostController@restore')->name('restore-post');
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('users', 'UserController@index')->name('users.index');
    Route::put('users/{user}', 'UserController@admin')->name('users.admin');
    Route::put('posts/{post}/accept', 'PostController@accept')->name('post.accept');
});
