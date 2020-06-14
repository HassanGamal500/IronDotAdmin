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

header("Cache-Control: no-cache, must-revalidate");
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'App'], function () {
    Route::get('home', 'genralApiController@home');
    Route::get('blog', 'genralApiController@blog');
    Route::get('singleBlog/{id}','genralApiController@singleBlog');
    Route::get('aboutUs', 'genralApiController@aboutUs');
    Route::get('services', 'genralApiController@services');
    Route::get('contactUs', 'genralApiController@contactUs');
    Route::get('portfolio', 'genralApiController@portfolio');
    Route::get('projectDetail/{id}', 'genralApiController@projectDetail');
    Route::get('product', 'genralApiController@product');
    Route::get('productDetail/{id}', 'genralApiController@productDetail');
    Route::post('sendContact', 'genralApiController@sendContact');
    Route::get('getData', 'testApi@testLink');
    Route::get('feedback', 'genralApiController@feedback');
    Route::get('team', 'genralApiController@team');
    Route::get('job', 'genralApiController@job');
    Route::get('jobDetail/{id}', 'genralApiController@jobDetail');
    Route::post('apply', 'genralApiController@applyJob');
});
