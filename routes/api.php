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

Route::post('user','userController@store');
Route::get('user_get/{email}','userController@show');
Route::get('user_data/{id}','userController@create');
Route::get('categorie','CategoriesController@index_api');
//Route::get('loginLanding','loginLandingController@show');
Route::post('login','loginLandingController@login');
Route::get('logout','loginLandingController@logout');
Route::get('certificado/{id}','DbResultsController@data');
Route::get('details_test/{id}','quizController@create');
Route::get('paypal','PaypalController@create');
Route::get('test/{id}/{url}','frontController@indexTest');
Route::post('new_payment','PaymentsController@store');