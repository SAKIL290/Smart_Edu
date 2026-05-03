<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller {
    public function create(Course $course) {
        return view('lectures.create', compact('course'));
    }

    public function store(Request $request, Course $course) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'video'       => 'required|mimetypes:video/mp4,video/avi,video/quicktime|max:204800',
            'description' => 'nullable|string',
        ]);

        $videoPath = $request->file('video')->store('lectures', 'public');
        $order = $course->lectures()->count() + 1;

        Lecture::create([
            'course_id'   => $course->id,
            'title'       => $request->title,
            'video_path'  => $videoPath,
            'description' => $request->description,
            'order'       => $order,
        ]);

        return redirect()->route('courses.show', $course)->with('success', 'Lecture uploaded!');
    }

    public function destroy(Course $course, Lecture $lecture) {
        $lecture->delete();
        return redirect()->route('courses.show', $course)->with('success', 'Lecture deleted!');
    }
}