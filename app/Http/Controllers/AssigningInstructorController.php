<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\Course;
use App\Instructor;
use App\Schedule;
use DB;

class AssigningInstructorController extends Controller
{
    public function index(Request $request)
    {
        $terms = Term::orderBy("created_at", "DESC")->take(5)->get();
        return view("assigning.index", compact("terms"));
    }
    public function selectTerm(Request $request)
    {
        $term = Term::findOrFail($request->term_id);
        return redirect()->route("calendar.index", ['term_id' => $term->id] );
    }
    public function assigning(Request $request)
    {
        $term = Term::with('instructors')->findOrFail($request->id);
        $instructors = $term->instructors()->paginate(10);
        return view("assigning.instructor", compact("term", "instructors"));
    }
    public function assigningCourse(Request $request)
    {
        $this->validate($request, [
            "term_id" => "required",
            "instructor_id" => "required",
            "schedule_id" => "required",
            "course_id" => "required",
            "priority" => "required"
        ]);
        $term = Term::findOrFail($request->input("term_id"));
        try {
             $term->instructors()->attach($request->input("instructor_id"), ['schedule_id' => $request->input('schedule_id'),'course_id' => $request->input('course_id'), 'priority' => $request->input("priority")]);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash("danger", "Something went wrong!");
            return back();
        }
        session()->flash("success", "Assigning instructor successfully!");
        return back();
    }
    public function update(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'instructor_id' => 'required',
            'schedule_id' => 'required',
            'course_id' => 'required',
            'priority' => 'required'
        ]);
       $course_term = DB::table("instructor_term")->where("id","=",$request->instructor_term_id)
       ->update([
           "instructor_id" => $request->instructor_id,
           "schedule_id" => $request->schedule_id,
           "course_id" => $request->course_id,
           'priority' => $request->priority,
           "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
       ]);
        session()->flash("success", "Updated successfully!");
        return back();
    }
    public function delete(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            "instructor_term_id" => "required",
        ]);
        try {
            DB::table("instructor_term")->where('id', $request->instructor_term_id)
                                    ->delete();

        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash("danger", "Something went wrong!");
            return back();
        }

        session()->flash("success", "Deletion successfully!");
        return back();

    }
    public function dataAjaxForCourse(Request $request)
    {
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = Course::select('id','name')->where('name','LIKE',"%$search%")
                    ->get();
        }


        return response()->json($data);
    }
    public function dataAjaxForSchedule(Request $request)
    {
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = Schedule::select('id','day', 'time')->where('day','LIKE',"%$search%")
                    ->orWhere('time', 'LIKE',"%$search%")
                    ->get();
        }


        return response()->json($data);
    }
    public function dataAjaxForInstructor(Request $request)
    {
        $data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = Instructor::select('id','name')->where('name','LIKE',"%$search%")
                    ->get();
        }


        return response()->json($data);
    }
}
