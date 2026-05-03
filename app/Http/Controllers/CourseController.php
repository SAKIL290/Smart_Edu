<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
    public function index() {
        $courses = Course::where('user_id', auth()->id())->withCount(['students','lectures'])->get();
        return view('courses.index', compact('courses'));
    }

    public function create() {
        return view('courses.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Course created!');
    }

    public function show(Course $course) {
        $this->authorizeCourse($course);
        $lectures = $course->lectures;
        $students = $course->students;
        return view('courses.show', compact('course', 'lectures', 'students'));
    }

    public function edit(Course $course) {
        $this->authorizeCourse($course);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course) {
        $this->authorizeCourse($course);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($data);
        return redirect()->route('courses.show', $course)->with('success', 'Course updated!');
    }

    public function destroy(Course $course) {
        $this->authorizeCourse($course);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted!');
    }

    private function authorizeCourse(Course $course) {
        if ($course->user_id !== auth()->id()) abort(403);
    }
}