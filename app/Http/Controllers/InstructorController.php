<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        if($request->edit == 1 && $request->id) {
            $edit_instructor = Instructor::findOrFail($request->id);
        }
        $instructors = Instructor::orderBy("created_at", "DESC")->paginate(5);
        return view("instructor.index", compact("instructors", "edit_instructor"));
    }
    public function store(Request $request)
    {
        // dd($request->input());
        $this->validate($request, [
            'name' => 'required'
        ]);

        $instructor = Instructor::create($request->input());
        session()->flash("success", "Instructor created!");
        return redirect()->route("instructor.index");
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Instructor::findOrFail($request->id)->update($request->input());
        session()->flash("success", "Instructor updated!");
        return redirect()->route("instructor.index");
    }
    public function delete(Request $request)
    {
        if($request->delete == 1 && $request->id) {
            Instructor::findOrFail($request->id)->delete();
            session()->flash("success", "Instructor deleted");
            return redirect()->route("instructor.index");
        }
    }
}
