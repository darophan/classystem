<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if($request->edit == 1 && $request->id) {
            $edit_schedule = Schedule::findOrFail($request->id);
        }
        $schedules = Schedule::paginate(10);
        return view("schedule.index", compact("schedules", "edit_schedule"));
    }
    public function store(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'day' => 'required',
            'time' => 'required'
        ]);

        $course = Schedule::create($request->input());
        session()->flash("success", "Schedule created!");
        return redirect()->route("schedule.index");
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'day' => 'required',
            'time' => 'required'
        ]);

        Schedule::findOrFail($request->id)->update($request->input());
        session()->flash("success", "Schedule updated!");
        return redirect()->route("schedule.index");
    }
    public function delete(Request $request)
    {
        if($request->delete == 1 && $request->id) {
            Schedule::findOrFail($request->id)->delete();
            session()->flash("success", "Schedule deleted");
            return redirect()->route("schedule.index");
        }
    }
}
