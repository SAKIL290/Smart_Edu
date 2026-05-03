<?php
namespace App\Http\Controllers;

use App\Models\Course;

class StudentCourseController extends Controller {
    public function show(Course $course) {
        $user = auth()->user();
        $enrolled = $course->students()->where('user_id', $user->id)->exists();
        if (!$enrolled) abort(403, 'You are not enrolled in this course.');

        $lectures = $course->lectures;
        return view('student.course-show', compact('course', 'lectures'));
    }
}