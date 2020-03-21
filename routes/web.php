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

// Force to load pages in https in production mode
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin first page
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin');

// If user is admin
Route::group(['middleware' => 'admin'], function () {
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/rules', 'AdminRulesController');
    Route::resource('admin/comments', 'AdminCommentsController');
    Route::patch('admin/comments/{comment}/approvedOrNot', 'AdminCommentsController@approvedOrNot')->name('comments.approvedOrNot');
});
