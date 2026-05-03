<?php
namespace App\Http\Controllers;

use App\Models\DirectMessage;
use App\Models\User;
use Illuminate\Http\Request;

class DirectMessageController extends Controller
{
    // Inbox — list all conversations
    public function inbox()
    {
        $user = auth()->user();

        $allMessages = DirectMessage::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderByDesc('created_at')
            ->get();

        $conversations = $allMessages
            ->groupBy(function ($msg) use ($user) {
                return $msg->sender_id === $user->id
                    ? $msg->receiver_id
                    : $msg->sender_id;
            })
            ->map(function ($msgs) use ($user) {
                $latest  = $msgs->first();
                $otherId = $latest->sender_id === $user->id
                    ? $latest->receiver_id
                    : $latest->sender_id;
                $other   = User::find($otherId);
                $unread  = $msgs->where('receiver_id', $user->id)
                                ->where('is_read', false)
                                ->count();
                return [
                    'user'      => $other,
                    'last_msg'  => $latest->message,
                    'last_time' => $latest->created_at,
                    'unread'    => $unread,
                ];
            })->values();

        return view('direct_messages.inbox', compact('conversations'));
    }

    // Open chat with a specific user
    public function chat(User $user)
    {
        $me = auth()->user();

        // Mark received messages as read
        DirectMessage::where('sender_id', $user->id)
            ->where('receiver_id', $me->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = DirectMessage::where(function ($q) use ($me, $user) {
                $q->where('sender_id', $me->id)
                  ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($q) use ($me, $user) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $me->id);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        return view('direct_messages.chat', compact('user', 'messages'));
    }

    // Send a message
    public function send(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        DirectMessage::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $user->id,
            'message'     => $request->message,
        ]);

        return back();
    }

    // Student contacts tutor from browse page
    public function startWithTutor(User $tutor)
    {
        $userId = $tutor->id;
        return redirect('/messages/' . $userId);
    }
}