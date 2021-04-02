<?php

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminLinksController;
use App\Http\Controllers\AdminPhotosController;
use App\Http\Controllers\AdminTagsController;
use App\Http\Controllers\AdminVideosController;
use App\Http\Controllers\BizpostApiController;
use App\Http\Controllers\BusinessApiController;
use App\Http\Controllers\CustomerApiController;
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

// Business API routes
Route::post('business', [BusinessApiController::class, 'store']);
Route::get('business/{id}', [BusinessApiController::class, 'show']);
Route::get('checkBusiness/{email}', [BusinessApiController::class, 'checkBusiness']);
Route::get('getSlug/{companyName}', [BusinessApiController::class, 'getSlug']);
Route::patch('business/{id}', [BusinessApiController::class, 'update']);
Route::delete('business/{id}', [BusinessApiController::class, 'destroy']);

// Customer API routes
Route::get('customer/{id}', [CustomerApiController::class, 'show']);

// Bizpost API routes
Route::get('bizpost/{id}', [BizpostApiController::class, 'show']);
Route::post('bizpost', [BizpostApiController::class, 'store']);
Route::patch('bizpost/{id}', [BizpostApiController::class, 'update']);
Route::delete('bizpost/{id}', [BizpostApiController::class, 'destroy']);

