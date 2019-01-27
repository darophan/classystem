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
    Route::post("/course", "CourseController@store")->name("course.store");
    Route::get("/course/{id}/edit", "CourseController@index")->name("course.edit");
    Route::post("/course/{id}", "CourseController@update")->name("course.update");
    Route::get("/course/{id}/delete", "CourseController@delete")->name("course.delete");
    // Schedules
    Route::get("/schedule", "ScheduleController@index")->name("schedule.index");
    Route::post("/schedule", "ScheduleController@store")->name("schedule.store");
    Route::get("/schedule/{id}/edit", "ScheduleController@index")->name("schedule.edit");
    Route::post("/schedule/{id}", "ScheduleController@update")->name("schedule.update");
    Route::get("/schedule/{id}/delete", "ScheduleController@delete")->name("schedule.delete");
    // Instructors
    Route::get("/instructor", "InstructorController@index")->name("instructor.index");
    Route::post("/instructor", "InstructorController@store")->name("instructor.store");
    Route::get("/instructor/{id}/edit", "InstructorController@index")->name("instructor.edit");
    Route::post("/instructor/{id}", "InstructorController@update")->name("instructor.update");
    Route::get("/instructor/{id}/delete", "InstructorController@delete")->name("instructor.delete");
});
