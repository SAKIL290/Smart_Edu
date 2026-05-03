<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller {
    public function index(Course $course) {
        $user = auth()->user();
        $enrolled = $course->students()->where('user_id', $user->id)->exists();
        $isTutor = $course->user_id === $user->id;

        if (!$enrolled && !$isTutor) abort(403);

        $messages = $course->messages()->with('user')->get();
        return view('messages.chat', compact('course', 'messages'));
    }

    public function store(Request $request, Course $course) {
        $request->validate(['message' => 'required|string|max:1000']);

        Message::create([
            'user_id'  => auth()->id(),
            'course_id'=> $course->id,
            'message'  => $request->message,
        ]);

        return back();
    }
}