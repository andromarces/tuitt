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

Route::get("/", "HomeController@index")->name("home");

// check email if exists in database
Route::post("checkEmail", "UserController@checkEmail");

// check username if exists in database
Route::post("checkUsername", "UserController@checkUsername");

// change password
Route::post("editPassword", "UserController@editPassword");

// get email
Route::post("updateUser", "UserController@updateUser");

// create admin
Route::post("createAdmin", "UserController@createAdmin");

// create event
Route::post("createEvent", "EventController@createEvent");

// edit event
Route::post("editEvent", "EventController@editEvent");

// delete event
Route::post("deleteEvent", "EventController@deleteEvent");

// add comment
Route::post("addComment", "CommentController@addComment");

// edit comment
Route::post("editComment", "CommentController@editComment");

// delete comment
Route::post("deleteComment", "CommentController@deleteComment");

// delete account
Route::get("deleteAccount", "UserController@deleteAccount");

// delete user
Route::post("deleteUser", "UserController@deleteUser");