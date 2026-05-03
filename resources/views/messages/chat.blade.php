@extends('layouts.app')
@section('title','Group Chat — '.$course->title)
@section('content')
<div style="max-width:760px; margin:0 auto;">
<div class="card fade-1" style="overflow:hidden; display:flex; flex-direction:column; height:76vh;">
    <div style="padding:18px 22px; border-bottom:1px solid var(--blue-50); display:flex; align-items:center; gap:12px; background:var(--blue-50);">
        <div style="width:40px; height:40px; border-radius:12px; background:linear-gradient(135deg,#2563eb,#1d4ed8); display:flex; align-items:center; justify-content:center; font-family:'Nunito',sans-serif; font-weight:900; color:white; font-size:1rem;">{{ strtoupper(substr($course->title,0,1)) }}</div>
        <div>
            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.95rem;">{{ $course->title }}</p>
            <p style="font-size:0.72rem; color:var(--blue-500); font-weight:700;">Group Chat</p>
        </div>
    </div>

    <div style="flex:1; overflow-y:auto; padding:20px; display:flex; flex-direction:column; gap:14px; background:#f8fbff;" id="chatBox">
        @forelse($messages as $msg)
        <div style="display:flex; align-items:flex-end; gap:10px; {{ $msg->user_id===auth()->id() ? 'flex-direction:row-reverse;' : '' }}">
            <div class="avatar" style="width:30px; height:30px; border-radius:8px; font-size:0.65rem; flex-shrink:0;">{{ strtoupper(substr($msg->user->name,0,1)) }}</div>
            <div style="max-width:68%;">
                <p style="font-size:0.68rem; color:var(--slate-400); font-weight:600; margin-bottom:4px; {{ $msg->user_id===auth()->id() ? 'text-align:right;' : '' }}">
                    {{ $msg->user->name }} · {{ $msg->created_at->diffForHumans() }}
                </p>
                <div style="padding:10px 16px; border-radius:16px; font-size:0.875rem; line-height:1.5;
                    {{ $msg->user_id===auth()->id()
                        ? 'background:linear-gradient(135deg,#2563eb,#1d4ed8); color:white; border-bottom-right-radius:4px;'
                        : 'background:white; color:var(--slate-700); border:1px solid var(--blue-100); border-bottom-left-radius:4px; box-shadow:0 2px 8px rgba(37,99,235,0.06);' }}">
                    {{ $msg->message }}
                </div>
            </div>
        </div>
        @empty
        <div style="text-align:center; padding:40px;">
            <div class="empty-icon" style="margin:0 auto 12px;"><svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg></div>
            <p style="color:var(--slate-400); font-size:0.875rem;">No messages yet. Start the conversation!</p>
        </div>
        @endforelse
    </div>

    <div style="padding:16px 20px; border-top:1px solid var(--blue-100); background:white;">
        <form action="{{ route('messages.store',$course) }}" method="POST" style="display:flex; gap:10px;">
            @csrf
            <input type="text" name="message" placeholder="Type a message..." autocomplete="off" class="form-input" style="flex:1;" required>
            <button type="submit" class="btn-primary" style="padding:10px 20px; flex-shrink:0;">Send</button>
        </form>
    </div>
</div>
</div>
<script>const cb=document.getElementById('chatBox'); cb.scrollTop=cb.scrollHeight;</script>
@endsection