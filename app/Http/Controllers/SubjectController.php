<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller {
    public function index() {
        $subjects = Subject::withCount('tutors')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create() { return view('subjects.create'); }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255', 'description' => 'nullable|string']);
        Subject::create($request->only('name','description'));
        return redirect()->route('subjects.index')->with('success', 'Subject created!');
    }

    public function edit(Subject $subject) { return view('subjects.edit', compact('subject')); }

    public function update(Request $request, Subject $subject) {
        $request->validate(['name' => 'required|string|max:255', 'description' => 'nullable|string']);
        $subject->update($request->only('name','description'));
        return redirect()->route('subjects.index')->with('success', 'Subject updated!');
    }

    public function destroy(Subject $subject) {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted!');
    }

    // Assign subjects to tutor
    public function assignForm() {
        $subjects = Subject::all();
        return view('subjects.assign', compact('subjects'));
    }

    public function assign(Request $request) {
        $request->validate(['subjects' => 'array']);
        auth()->user()->subjects()->sync($request->subjects ?? []);
        return back()->with('success', 'Subjects updated!');
    }
}