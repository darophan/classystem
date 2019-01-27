<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::orderBy("created_at", "DESC")->paginate(5);
        return view("course.index", compact("courses"));
    }
}
