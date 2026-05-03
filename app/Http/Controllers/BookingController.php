<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller {
    public function create() {
        $subjects = Subject::all();
        $tutors = User::where('role', 'tutor')->get();
        return view('bookings.create', compact('subjects', 'tutors'));
    }

    public function store(Request $request) {
        $request->validate([
            'tutor_id'     => 'required|exists:users,id',
            'subject_id'   => 'nullable|exists:subjects,id',
            'session_time' => 'required|date|after:now',
            'notes'        => 'nullable|string',
        ]);

        Booking::create([
            'student_id'   => auth()->id(),
            'tutor_id'     => $request->tutor_id,
            'subject_id'   => $request->subject_id,
            'session_time' => $request->session_time,
            'notes'        => $request->notes,
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking request sent!');
    }

    public function index() {
        $user = auth()->user();
        if ($user->isTutor()) {
            $bookings = Booking::where('tutor_id', $user->id)->with('student','subject')->latest()->get();
        } else {
            $bookings = Booking::where('student_id', $user->id)->with('tutor','subject')->latest()->get();
        }
        return view('bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking) {
        $request->validate(['status' => 'required|in:pending,approved,completed,cancelled']);
        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Booking status updated!');
    }
}