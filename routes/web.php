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

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\AdminPhotosController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminSitemapGenerator;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminVideosController;
use App\Http\Controllers\HomeController;

// Force to load pages in https in production mode
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

// For RSS feed
Route::feeds();

Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin first page
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth')->name('admin');

// If user is admin
Route::group(['middleware' => 'admin'], function () {
    Route::resource('admin/users', AdminUsersController::class);
    Route::resource('admin/posts', AdminPostsController::class);
//    Route::resource('admin/rules', 'AdminRulesController');
    Route::resource('admin/categories', AdminCategoriesController::class);
    Route::resource('admin/links', AdminLinksController::class);
    Route::resource('admin/photos', AdminPhotosController::class);
    Route::resource('admin/videos', AdminVideosController::class);

    Route::get('admin/sitemap', [AdminSitemapGenerator::class, 'index'])->name('sitemap');
    Route::get('admin/createSitemap', [AdminSitemapGenerator::class, 'run'])->name('createSitemap');
});

// Static pages
Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

// Public pages
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/bizpost', [HomeController::class, 'bizpost'])->name('bizpost');

// You have to put routes without attributes, before this
// because /{slug} will confuse the routes
Route::get('/{slug}', [HomeController::class, 'post'])->name('post');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/month/{year}/{month}', [HomeController::class, 'month'])->name('month');

