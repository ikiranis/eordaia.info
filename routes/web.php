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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Admin first page
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin');

// If user is admin
Route::group(['middleware' => 'admin'], function () {
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/rules', 'AdminRulesController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/links', 'AdminLinksController');
    Route::resource('admin/photos', 'AdminPhotosController');
    Route::resource('admin/videos', 'AdminVideosController');
});

Auth::routes();

// Static pages
Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

// Public pages
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/{slug}', 'HomeController@post')->name('post');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag');
Route::get('/category/{slug}', 'HomeController@category')->name('category');
