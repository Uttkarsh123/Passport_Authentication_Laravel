<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/user', 'App\Http\Controllers\Users\UserController@register');

Route::group(["middleware" => ['auth:api', 'verified']], function () {

    Route::get('/user', 'App\Http\Controllers\Users\UserController@details');
    Route::post('/product', 'App\Http\Controllers\ProductController@create');
    Route::get('/product/{id}','App\Http\Controllers\ProductController@getProduct');
    Route::get('/products','App\Http\Controllers\ProductController@getAllProducts');
    Route::post('/product/{id}','App\Http\Controllers\ProductController@updateProduct');
    Route::delete('/product/{id}','App\Http\Controllers\ProductController@destroy');
});
