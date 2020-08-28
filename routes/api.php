<?php

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
    Route::post('tag', 'AdminTagsController@store');
    Route::get('tags', 'AdminTagsController@index');
    Route::post('category', 'AdminCategoriesController@store');
    Route::post('photo', 'AdminPhotosController@store');
    Route::delete('photo/{id}', 'AdminPhotosController@destroy');
    Route::get('photos', 'AdminPhotosController@listPhotos');
    Route::post('link', 'AdminLinksController@store');
    Route::post('video', 'AdminVideosController@store');
});

Route::get('photo/{id}', 'AdminPhotosController@getPhoto');
