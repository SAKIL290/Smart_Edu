<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Booking;

class DashboardController extends Controller {
    public function index() {
        $user = auth()->user();

        if ($user->isTutor()) {
            $courses = Course::where('user_id', $user->id)->withCount('students')->get();
            $bookings = Booking::where('tutor_id', $user->id)->with('student','subject')->latest()->take(5)->get();
            return view('dashboard.tutor', compact('courses', 'bookings'));
        }

        $enrolledCourses = $user->enrolledCourses()->with('tutor')->get();
        $bookings = Booking::where('student_id', $user->id)->with('tutor','subject')->latest()->take(5)->get();
        return view('dashboard.student', compact('enrolledCourses', 'bookings'));
    }
}