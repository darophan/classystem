<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;

class TermController extends Controller
{
    public function index(Request $request)
    {

        if($request->edit == 1 && $request->id) {
            $edit_term = Term::findOrFail($request->id);
        }
        $terms = Term::orderBy('created_at', 'desc')->paginate(5);

        return view("term.index", compact('terms', 'edit_term'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d'
        ]);
        // dd($request->input());
        $term = Term::create($request->input());
        session()->flash("success", "Term created.");
        return redirect()->route("term.index");
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d'
        ]);
        // dd($request->input());
        Term::findOrFail($request->id)->update($request->input());
        session()->flash("success", "Term updated.");
        return redirect()->route("term.index");
    }
    public function delete(Request $request)
    {
        if($request->delete == 1 && $request->id) {
            Term::findOrFail($request->id)->delete();
            session()->flash("success", "Term deleted.");
            return redirect()->route("term.index");
        }
    }
}
