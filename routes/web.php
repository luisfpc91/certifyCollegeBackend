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



Auth::routes();

Route::get('/', function(){
    return redirect()->route('login');
});

Route::resource('results','DbResultsController');
Route::get('test_details/{id}', 'DbResultsController@test_details')->name('test_details');
Route::get('/payres/','PaypalController@response');

//if(Auth::user()->level == 'admin') {

    Route::prefix('categorie')->group(function(){
        Route::get('create','CategoriesController@create')->name('categorie_new');
        Route::post('create','CategoriesController@store')->name('categorie_create');
        Route::get('list','CategoriesController@index')->name('categorie_list');
        Route::get('edit/{id}','CategoriesController@edit')->name('categorie_edit');
        Route::put('update/{id}','CategoriesController@update')->name('categorie_update');
        Route::delete('delete/{id}','CategoriesController@destroy')->name('categorie_delete');
        Route::get('show','CategoriesController@show')->name('categorie_show');
    });

    Route::prefix('quiz')->group(function() {
        Route::get('create', 'quizController@index')->name('new_create');
        Route::post('create','quizController@store')->name('quiz_create');
        Route::get('detail/{id}','quizController@show_edit')->name('quiz_detail');
        Route::get('list','quizController@getlist')->name('quiz_list');
        Route::get('edit/{id}','quizController@edit')->name('quiz_edit');
        Route::put('update/{id}','quizController@update')->name('quiz_update');
        Route::delete('delete/{id}','quizController@delete')->name('quiz_delete');
    });

    Route::prefix('question')->group(function() {
        Route::post('create','questionController@store')->name('question_create');
        Route::get('edit/{id}','questionController@edit')->name('question_edit');
        Route::put('update/{id}','questionController@update')->name('question_update');
        Route::delete('delete/{id}','questionController@delete')->name('question_delete');
    });

    Route::prefix('answer')->group(function() {
        Route::post('create','answerController@store')->name('answer_create');
        Route::put('update/{id}/{id_q}','answerController@update')->name('answer_update');
        Route::delete('delete/{id}/{id_q}','answerController@delete')->name('answer_delete');
    });

    Route::get('practica/{id}','frontController@practica')->name('practica');
    Route::post('practica/{id}/{p}','frontController@practica2')->name('practica2');

    Route::prefix('user')->group(function(){
        Route::get('list','userController@index')->name('user_list');
        Route::get('edit/{id}','userController@edit')->name('user_edit');
        Route::put('update/{id}','userController@update')->name('user_update');
        Route::delete('delete/{id}','userController@delete')->name('user_delete');
        Route::get('logout','userController@logout')->name('logout_user');
        Route::get('myUser', 'userController@myUser')->name('editMyUser');
    });

    Route::prefix('specialist')->group(function(){
        Route::get('index','DbEspecialistaController@index')->name('new_specialist');
        Route::post('create','DbEspecialistaController@store')->name('create_specialist');
        Route::get('list','DbEspecialistaController@show')->name('list_specialist');
        Route::get('edit/{id}','DbEspecialistaController@edit')->name('edit_specialist');
        Route::put('update/{id}','DbEspecialistaController@update')->name('update_specialist');
        Route::delete('delete/{id}','DbEspecialistaController@destroy')->name('remove_specialist');
    });

//};

Route::prefix('prueba')->group(function(){
    Route::get('{id}/{url}/{token}','frontController@index');
    Route::post('{id}','frontController@prueba')->name('prueba');    
});


