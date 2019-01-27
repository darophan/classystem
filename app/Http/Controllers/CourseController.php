<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if($request->edit == 1 && $request->id) {
            $edit_course = Course::findOrFail($request->id);
        }
        $courses = Course::orderBy("created_at", "DESC")->paginate(5);
        return view("course.index", compact("courses", "edit_course"));
    }
    public function store(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'name' => 'required'
        ]);

        $course = Course::create($request->input());
        session()->flash("success", "Course/Class created!");
        return redirect()->route("course.index");
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Course::findOrFail($request->id)->update($request->input());
        session()->flash("success", "Course/Class updated!");
        return redirect()->route("course.index");
    }
    public function delete(Request $request)
    {
        if($request->delete == 1 && $request->id) {
            Course::findOrFail($request->id)->delete();
            session()->flash("success", "Course/Class deleted");
            return redirect()->route("course.index");
        }
    }
}
