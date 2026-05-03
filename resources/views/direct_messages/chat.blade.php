@extends('layouts.app')
@section('title', 'Chat with '.$user->name)
@section('content')

<div style="max-width:780px; margin:0 auto;">
<div class="card fade-1" style="overflow:hidden; display:flex; flex-direction:column; height:80vh;">

    {{-- Header --}}
    <div style="padding:16px 22px; border-bottom:1.5px solid var(--blue-100); background:var(--blue-50); display:flex; align-items:center; justify-content:space-between; flex-shrink:0;">
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="/messages"
                style="width:36px; height:36px; background:white; border:1.5px solid var(--blue-200); border-radius:10px; display:flex; align-items:center; justify-content:center; text-decoration:none; flex-shrink:0;"
                onmouseover="this.style.background='#dbeafe'"
                onmouseout="this.style.background='white'">
                <svg width="16" height="16" fill="none" stroke="#2563eb" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div style="position:relative;">
                <div class="avatar" style="width:42px; height:42px; border-radius:13px; font-size:1rem; flex-shrink:0;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div style="position:absolute; bottom:-2px; right:-2px; width:12px; height:12px; background:#22c55e; border-radius:50%; border:2px solid white;"></div>
            </div>
            <div>
                <p style="font-family:'Nunito',sans-serif; font-weight:900; color:var(--slate-800); font-size:1rem; margin-bottom:2px;">{{ $user->name }}</p>
                <span class="role-pill" style="font-size:0.65rem; padding:2px 10px;">{{ ucfirst($user->role) }}</span>
            </div>
        </div>

        <div style="display:flex; align-items:center; gap:8px;">
            @if(auth()->user()->isStudent() && $user->isTutor())
                <a href="/book-tutor" class="btn-secondary" style="font-size:0.78rem; padding:8px 14px;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Book Session
                </a>
                <a href="/browse-courses" class="btn-primary" style="font-size:0.78rem; padding:8px 14px;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Enroll in Course
                </a>
            @endif
        </div>
    </div>

    {{-- Info bar --}}
    @if(auth()->user()->isStudent() && $user->isTutor())
    <div style="background:#fffbeb; border-bottom:1px solid #fde68a; padding:10px 22px; display:flex; align-items:center; gap:10px; flex-shrink:0;">
        <svg width="15" height="15" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p style="font-size:0.78rem; color:#92400e; font-weight:600; margin:0;">
            💡 Ask <strong>{{ $user->name }}</strong> for the <strong>enrollment key</strong> to join their course. Once you have the key, click <strong>Enroll in Course</strong> above.
        </p>
    </div>
    @endif

    {{-- Messages --}}
    <div id="chatBox" style="flex:1; overflow-y:auto; padding:20px 22px; display:flex; flex-direction:column; gap:14px; background:#f8fbff;">

        @forelse($messages as $msg)
        <div style="display:flex; align-items:flex-end; gap:10px; {{ $msg->sender_id === auth()->id() ? 'flex-direction:row-reverse;' : '' }}">
            <div class="avatar" style="width:32px; height:32px; border-radius:9px; font-size:0.72rem; flex-shrink:0;">
                {{ strtoupper(substr($msg->sender->name, 0, 1)) }}
            </div>
            <div style="max-width:65%;">
                <p style="font-size:0.68rem; color:var(--slate-400); font-weight:600; margin-bottom:5px; {{ $msg->sender_id === auth()->id() ? 'text-align:right;' : '' }}">
                    {{ $msg->sender->name }} &middot; {{ $msg->created_at->diffForHumans() }}
                </p>
                <div style="padding:12px 16px; border-radius:18px; font-size:0.875rem; line-height:1.6; word-break:break-word;
                    {{ $msg->sender_id === auth()->id()
                        ? 'background:linear-gradient(135deg,#2563eb,#1d4ed8); color:white; border-bottom-right-radius:4px;'
                        : 'background:white; color:var(--slate-700); border:1.5px solid var(--blue-100); border-bottom-left-radius:4px; box-shadow:0 2px 8px rgba(37,99,235,0.06);'
                    }}">
                    {{ $msg->message }}
                </div>
            </div>
        </div>

        @empty
        <div style="flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:40px 20px;">
            <div style="width:64px; height:64px; background:var(--blue-50); border:1.5px solid var(--blue-100); border-radius:20px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                <svg width="28" height="28" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-700); font-size:1rem; margin-bottom:12px;">
                Start your conversation with {{ $user->name }}!
            </p>
            @if(auth()->user()->isStudent())
            <div style="background:var(--blue-50); border:1.5px solid var(--blue-100); border-radius:14px; padding:14px 18px; max-width:360px; text-align:left;">
                <p style="font-size:0.8rem; color:var(--blue-700); font-weight:700; margin-bottom:10px;">💬 Suggested messages:</p>
                <div style="display:flex; flex-direction:column; gap:8px;">
                    <button onclick="fillMessage('Hi! I am interested in your course. Can you share the enrollment key?')"
                        style="background:white; border:1.5px solid var(--blue-200); border-radius:10px; padding:10px 14px; font-size:0.78rem; color:var(--slate-600); cursor:pointer; text-align:left; font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; transition:all 0.15s;"
                        onmouseover="this.style.background='#dbeafe'"
                        onmouseout="this.style.background='white'">
                        👋 Hi! I'm interested in your course. Can I get the enrollment key?
                    </button>
                    <button onclick="fillMessage('Hello! What topics does your course cover? I would like to enroll.')"
                        style="background:white; border:1.5px solid var(--blue-200); border-radius:10px; padding:10px 14px; font-size:0.78rem; color:var(--slate-600); cursor:pointer; text-align:left; font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; transition:all 0.15s;"
                        onmouseover="this.style.background='#dbeafe'"
                        onmouseout="this.style.background='white'">
                        📚 What topics does your course cover? I'd like to enroll.
                    </button>
                    <button onclick="fillMessage('Hi! Can you please send me the enrollment key for your course?')"
                        style="background:white; border:1.5px solid var(--blue-200); border-radius:10px; padding:10px 14px; font-size:0.78rem; color:var(--slate-600); cursor:pointer; text-align:left; font-family:'Plus Jakarta Sans',sans-serif; font-weight:600; transition:all 0.15s;"
                        onmouseover="this.style.background='#dbeafe'"
                        onmouseout="this.style.background='white'">
                        🔑 Can you please send me the enrollment key?
                    </button>
                </div>
            </div>
            @else
            <p style="color:var(--slate-400); font-size:0.85rem;">
                This student wants to connect with you. Reply to help them get started!
            </p>
            @endif
        </div>
        @endforelse
    </div>

    {{-- Input --}}
    <div style="padding:16px 20px; border-top:1.5px solid var(--blue-100); background:white; flex-shrink:0;">
        <form action="/messages/{{ $user->id }}" method="POST" style="display:flex; gap:10px; align-items:center;">
            @csrf
            <input
                type="text"
                name="message"
                id="messageInput"
                placeholder="Type your message here..."
                autocomplete="off"
                class="form-input"
                style="flex:1;"
                required>
            <button type="submit" class="btn-primary" style="padding:11px 22px; flex-shrink:0;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Send
            </button>
        </form>
    </div>

</div>
</div>

<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;

    function fillMessage(text) {
        const input = document.getElementById('messageInput');
        input.value = text;
        input.focus();
    }

    document.getElementById('messageInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            this.closest('form').submit();
        }
    });
</script>

@endsection