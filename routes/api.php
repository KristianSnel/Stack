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


Route::get('albums', 'AlbumController@index');

Route::get('albums/filter/{filter}', 'AlbumController@filter');

Route::get('albums/{id}', 'AlbumController@show');

Route::post('albums', 'AlbumController@store');

Route::put('albums/{id}', 'AlbumController@store');

Route::delete('albums/{id}', 'AlbumController@destroy');