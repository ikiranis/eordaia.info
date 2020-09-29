<?php

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\AdminPhotosController;
use App\Http\Controllers\AdminTagsController;
use App\Http\Controllers\AdminVideosController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Api with auth
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('tag', [AdminTagsController::class, 'store']);
    Route::get('tags', [AdminTagsController::class, 'index']);
    Route::post('category', [AdminCategoriesController::class, 'store']);
    Route::post('photo', [AdminPhotosController::class, 'store']);
    Route::delete('photo/{id}', [AdminPhotosController::class, 'destroy']);
    Route::get('photos', [AdminPhotosController::class, 'listPhotos']);
    Route::post('link', [AdminLinksController::class, 'store']);
    Route::post('video', [AdminVideosController::class, 'store']);
});

Route::get('photo/{id}', [AdminPhotosController::class, 'getPhoto']);
