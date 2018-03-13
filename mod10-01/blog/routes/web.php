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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Hello world!";
});

Route::get('/articles', function () {
    $article1 = 'Tutorial';
    $article2 = 'Getting Started';
    return view('articles.articles_list', compact('article1', 'article2'));
});

Route::get('/articles', 'ArticlesController@showArticles');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{id}', 'ArticlesController@show');
Route::post('/articles/create', 'ArticlesController@store');
Route::get('/articles/{id}/delete', 'ArticlesController@delete');
Route::get('/articles/{id}/edit', 'ArticlesController@edit');
Route::post('/articles/{id}/edit', 'ArticlesController@update');
