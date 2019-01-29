<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\Course;
use App\Instructor;
use App\Schedule;
use DB;

class AssigningController extends Controller
{
    public function index(Request $request)
    {
        $terms = Term::orderBy("created_at", "DESC")->take(5)->get();
        return view("assigning.index", compact("terms"));
    }
    public function selectTerm(Request $request)
    {
        $term = Term::findOrFail($request->term_id);
        return redirect()->route("assigning.assigning", ['id' => $term->id] );
    }
    public function assigning(Request $request)
    {
        $term = Term::findOrFail($request->id)->load("courses");
        $courses = $term->courses()->paginate(5);
        return view("assigning.term", compact("term", "courses"));
    }
    public function assigningCourse(Request $request)
    {
        $this->validate($request, [
            "term_id" => "required",
            "course_id" => "required",
            'instructor_id' => 'required',
            "schedule_id" => "required"
        ]);
        try {
            DB::table("course_term")->insert(
                $request->except("_token")
            );

        } catch (\Illuminate\Database\QueryException $e) {
            $instructor = Instructor::findOrFail($request->instructor_id);
            $schedule = Schedule::findOrFail($request->schedule_id);
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                session()->flash("danger", "Instructor: ".$instructor->name." already assinged to the schedule: ".$schedule->day."(".$schedule->time.")"."!");
                return back();
            }
        }

        session()->flash("success", "Assigning course/class successfully!");
        return back();

    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'schedule_id' => 'required',
            'instructor_id' => 'required'
        ]);
        try {
            $course_term = DB::table("course_term")->where("schedule_id","=",$request->old_schedule_id)
            ->where("instructor_id", "=",$request->old_instructor_id)
            ->update([
                "course_id" => $request->course_id,
                "schedule_id" => $request->schedule_id,
                "instructor_id" => $request->instructor_id
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            $instructor = Instructor::findOrFail($request->instructor_id);
            $schedule = Schedule::findOrFail($request->schedule_id);
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                session()->flash("danger", "Instructor: ".$instructor->name." already assinged to the schedule: ".$schedule->day."(".$schedule->time.")"."!");
                return back();
            }
        }
        session()->flash("success", "Updated successfully!");
        return back();
    }
    public function delete(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            "term_id" => "required",
            "course_id" => "required",
            'instructor_id' => 'required',
            "schedule_id" => "required"
        ]);
        try {
            DB::table("course_term")->where('term_id', $request->term_id)
                                    ->where("course_id", $request->course_id)
                                    ->where("instructor_id", $request->instructor_id)
                                    ->where("schedule_id", $request->schedule_id)
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
