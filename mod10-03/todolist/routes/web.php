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

// Route::get('/', function () {
//     return view('welcome');
// });

// display tasks
Route::get('/', 'TaskController@displayTasks');

// add a new task
Route::post('/task', 'TaskController@addTask');

// delete task
Route::get('/task/{id}', 'TaskController@deleteTask');

// edit task
Route::post('/task/{id}', 'TaskController@editTask');

// add comment
Route::post('/comment', 'CommentController@addComment');

// edit comment
Route::post('/comment/{id}', 'CommentController@editComment');

// delete comment
Route::get('/comment/{id}', 'CommentController@deleteComment');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
