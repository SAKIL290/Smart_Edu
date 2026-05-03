<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller {
    public function enroll(Request $request) {
    $request->validate([
        'enrollment_key' => 'required|string|min:1'
    ]);

    $user = auth()->user();

    $course = Course::where('enrollment_key', strtoupper(trim($request->enrollment_key)))->first();

    if (!$course) {
        return back()->withErrors(['enrollment_key' => 'Invalid enrollment key. Please check the key and try again.'])->withInput();
    }

    $already = Enrollment::where('user_id', $user->id)
                          ->where('course_id', $course->id)->exists();

    if ($already) {
        return back()->withErrors(['enrollment_key' => 'You are already enrolled in this course.'])->withInput();
    }

    Enrollment::create(['user_id' => $user->id, 'course_id' => $course->id]);

    return redirect()->route('student.course.show', $course)
                     ->with('success', 'Enrolled successfully! Welcome to ' . $course->title);
}
    public function browse() {
    $user = auth()->user();
    
    // Get all courses with tutor info, lecture count, student count
    // Exclude courses the student is already enrolled in
    $enrolledIds = $user->enrollments()->pluck('course_id');
    
    $courses = Course::whereNotIn('id', $enrolledIds)
                     ->with('tutor')
                     ->withCount(['lectures', 'students'])
                     ->latest()
                     ->get();

    $enrolledCourses = $user->enrolledCourses()->with('tutor')->withCount(['lectures','students'])->get();

    return view('enrollments.browse', compact('courses', 'enrolledCourses'));
    }
    
}