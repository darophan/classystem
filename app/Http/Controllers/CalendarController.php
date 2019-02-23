<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\CourseInstructorTerm;
use App\CourseTerm;
use App\InstructorTerm;
use DB;

class CalendarController extends Controller
{
    public function term()
    {
        $terms = Term::orderBy("created_at", "DESC")->take(5)->get();
        return view("calendar.selectTerm", compact('terms'));
    }
    public function selectTerm(Request $request)
    {
        $term = Term::findOrFail($request->term_id);
        return redirect()->route("assigning.assigning", ['id' => $term->id] );
    }
    public function index(Request $request)
    {
        $term = Term::findOrFail($request->term_id)->load('courses', 'instructors');

        $courses = $term->courses;
        $calendarCourses = array();

        $calendarCourses['800']['Mon']= $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Mon']= $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Mon'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Mon'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Mon'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Mon'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Tue']= $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Tue']= $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Tue'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Tue'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Tue'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Tue'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Wed']= $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Wed']= $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Wed'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Wed'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Wed'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Wed'] = $courses->where('pivot.schedule.day', 'Mon/Wed')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Thu']= $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Thu']= $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Thu'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Thu'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Thu'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Thu'] = $courses->where('pivot.schedule.day', 'Tue/Thu')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Fri']= $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Fri']= $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Fri'] = $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Fri'] = $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Fri'] = $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Fri'] = $courses->where('pivot.schedule.day', 'Fri')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Sat']= $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Sat']= $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Sat'] = $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Sat'] = $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Sat'] = $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Sat'] = $courses->where('pivot.schedule.day', 'Sat')->where('pivot.schedule.time', '19:00-20:30');

        $calendarCourses['800']['Sun']= $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '8:00-9:30');
        $calendarCourses['930']['Sun']= $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '9:30-11:00');
        $calendarCourses['1400']['Sun'] = $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '14:00-15:30');
        $calendarCourses['1530']['Sun'] = $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '15:30-17:00');
        $calendarCourses['1730']['Sun'] = $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '17:30-19:00');
        $calendarCourses['1900']['Sun'] = $courses->where('pivot.schedule.day', 'Sun')->where('pivot.schedule.time', '19:00-20:30');
        // dd($calendarCourses);
        // dd($courses->first()->pivot->schedule_id);

        $instructors = $term->instructors;
        $calendarInstructors = array();

        $courseInstructorTerms = CourseInstructorTerm::where('term_id', $term->id)->get();

        // dd($instructors);
        // dd($calendarInstructors['930']['Tue']->first()->name);
        return view("calendar.index", compact('term', 'calendarCourses', 'instructors', 'courseInstructorTerms'));
    }
    public function confirm(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'term_id' => 'required',
            'course_id' => 'required',
            'schedule_id' => 'required',
            'instructor_id' => 'required',
            'course_term_id' => 'required',
            'instructor_term_id' => 'required'
        ]);
        try {
            DB::table('course_instructor_term')
            ->updateOrInsert(
                [
                    'course_term_id' => $request->input('course_term_id'),
                    'instructor_term_id' => $request->input('instructor_term_id')
                ],
                [
                    'schedule_id' => $request->input('schedule_id'),
                    'instructor_id' => $request->input('instructor_id'),
                    'course_id' => $request->input('course_id'),
                    'term_id' => $request->input('term_id'),
                    "created_at" => \Carbon\Carbon::now(),  # \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
                ]
            );
            CourseTerm::findOrFail($request->input('course_term_id'))->update(['is_taken' => 1]);
            InstructorTerm::findOrFail($request->input('instructor_term_id'))->update(['is_taken' => 1]);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash("danger", "Something went wrong!");
            return back();
        }
        session()->flash("success", "Confirming course/instructor successfully!");
        return back();
    }
    public function unset(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'term_id' => 'required',
            'course_id' => 'required',
            'schedule_id' => 'required',
            'instructor_id' => 'required',
            'course_term_id' => 'required',
            'instructor_term_id' => 'required'
        ]);
        try {
            CourseTerm::findOrFail($request->input('course_term_id'))->update(['is_taken' => 0]);
            InstructorTerm::findOrFail($request->input('instructor_term_id'))->update(['is_taken' => 0]);
            DB::table('course_instructor_term')
            ->where(
                [
                    'term_id' => $request->input('term_id'),
                    'course_id' => $request->input('course_id'),
                    'instructor_id' => $request->input('instructor_id'),
                    'schedule_id' => $request->input('schedule_id')
                ]
            )
            ->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash("danger", "Something went wrong!");
            return back();
        }
        session()->flash("success", "Unsetting course/instructor successfully!");
        return back();
    }
}
