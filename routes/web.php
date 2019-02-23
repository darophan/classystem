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

Route::prefix("/admin")->middleware(['auth'])->group(function() {
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
    // Course_Term Assigning
    Route::get("/assigning", "AssigningController@index")->name("assigning.index");
    Route::post("/assigning/selectTerm", "AssigningController@selectTerm")->name("assigning.selectTerm");
    Route::get("/assigning/{id}/term", "AssigningController@assigning")->name("assigning.assigning");
    Route::post("/assigning", "AssigningController@assigningCourse")->name("assigning.assigningCourse");
    Route::post("/assigning/update", "AssigningController@update")->name("assigning.update");
    Route::post("/assigning/delete", "AssigningController@delete")->name("assigning.delete");
    // Instructor Assigning
    Route::get("/assigning/instructor", "AssigningInstructorController@index")->name("assigningInstructor.index");
    Route::post("/assigning/instructor/selectTerm", "AssigningInstructorController@selectTerm")->name("assigningInstructor.selectTerm");
    Route::get("/assigning/instructor/{id}/term", "AssigningInstructorController@assigning")->name("assigningInstructor.assigning");
    Route::post("/assigning/instructor", "AssigningInstructorController@assigningCourse")->name("assigningInstructor.assigningCourse");
    Route::post("/assigning/instructor/update", "AssigningInstructorController@update")->name("assigningInstructor.update");
    Route::post("/assigning/instructor/delete", "AssigningInstructorController@delete")->name("assigningInstructor.delete");
    // Dropdown search select2
    Route::get("/select2-autocomplete-ajax-course", "AssigningController@dataAjaxForCourse");
    Route::get("/select2-autocomplete-ajax-schedule", "AssigningController@dataAjaxForSchedule");
    Route::get("/select2-autocomplete-ajax-instructor", "AssigningController@dataAjaxForInstructor");
    // Calendar
    Route::get("/calendar", "CalendarController@term")->name("calendar.term");
    Route::any("/calendar/term", "CalendarController@index")->name("calendar.index");
    // Confirm course instructor
    Route::post("/calendar/confirm", "CalendarController@confirm")->name("calendar.confirm");
    Route::post("/calendar/unset", "CalendarController@unset")->name("calendar.unset");
});
