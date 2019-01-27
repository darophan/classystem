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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix("/admin")->group(function() {
    // Terms
    Route::get("/term", "TermController@index")->name("term.index");
    Route::post("/term", "TermController@store")->name("term.store");
    Route::get("/term/{id}/edit", "TermController@index")->name("term.edit");
    Route::post("/term/{id}", "TermController@update")->name("term.update");
    Route::get("/term/{id}/delete", "TermController@delete")->name("term.delete");
    // Courses
    Route::get("/course", "CourseController@index")->name("course.index");

});
