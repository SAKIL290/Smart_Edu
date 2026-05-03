@extends('layouts.app')
@section('title', 'Messages')
@section('content')

<div style="max-width:900px; margin:0 auto;">

    {{-- Header --}}
    <div class="fade-1" style="background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:20px; padding:24px 28px; margin-bottom:22px; color:white; display:flex; align-items:center; justify-content:space-between;">
        <div>
            <p style="font-size:0.72rem; font-weight:800; letter-spacing:0.1em; text-transform:uppercase; opacity:0.7; margin-bottom:4px;">Direct Messages</p>
            <h2 style="font-family:'Nunito',sans-serif; font-size:1.5rem; font-weight:900; margin:0;">Your Conversations</h2>
        </div>
        <div style="width:48px; height:48px; background:rgba(255,255,255,0.15); border-radius:14px; display:flex; align-items:center; justify-content:center;">
            <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

        {{-- LEFT: Conversations --}}
        <div>
            <h3 class="section-title" style="margin-bottom:14px;">
                💬 My Conversations
            </h3>
            <div class="card" style="overflow:hidden;">
                @if($conversations->isEmpty())
                    <div class="empty-state" style="padding:32px;">
                        <div class="empty-icon">
                            <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <p style="font-weight:700; color:var(--slate-600); margin-bottom:4px; font-size:0.9rem;">No conversations yet</p>
                        <p style="color:var(--slate-400); font-size:0.78rem;">Start by messaging a tutor →</p>
                    </div>
                @else
                    @foreach($conversations as $conv)
                    <a href="/messages/{{ $conv['user']->id }}"
                        style="display:flex; align-items:center; gap:12px; padding:14px 18px; border-bottom:1px solid var(--blue-50); text-decoration:none; background:white; transition:background 0.15s;"
                        onmouseover="this.style.background='#f0f6ff'"
                        onmouseout="this.style.background='white'">
                        <div style="position:relative; flex-shrink:0;">
                            <div class="avatar" style="width:40px; height:40px; border-radius:12px; font-size:0.9rem;">
                                {{ strtoupper(substr($conv['user']->name, 0, 1)) }}
                            </div>
                            @if($conv['unread'] > 0)
                                <span style="position:absolute; top:-4px; right:-4px; width:18px; height:18px; background:#ef4444; border-radius:50%; border:2px solid white; display:flex; align-items:center; justify-content:center; font-size:0.55rem; font-weight:800; color:white;">
                                    {{ $conv['unread'] }}
                                </span>
                            @endif
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:3px;">
                                <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem;">{{ $conv['user']->name }}</p>
                                <p style="font-size:0.65rem; color:var(--slate-400); font-weight:600;">{{ $conv['last_time']->diffForHumans() }}</p>
                            </div>
                            <p style="font-size:0.75rem; color:var(--slate-400); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                {{ Str::limit($conv['last_msg'], 40) }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- RIGHT: All Tutors to contact --}}
        <div>
            <h3 class="section-title" style="margin-bottom:14px;">
                👨‍🏫 Contact a Tutor
            </h3>
            <div class="card" style="overflow:hidden;">
                @php
                    $tutors = \App\Models\User::where('role', 'tutor')->get();
                @endphp

                @if($tutors->isEmpty())
                    <div class="empty-state" style="padding:32px;">
                        <p style="color:var(--slate-400); font-size:0.875rem;">No tutors available yet.</p>
                    </div>
                @else
                    @foreach($tutors as $tutor)
                    <div style="display:flex; align-items:center; gap:12px; padding:14px 18px; border-bottom:1px solid var(--blue-50); background:white; transition:background 0.15s;"
                        onmouseover="this.style.background='#f8fbff'"
                        onmouseout="this.style.background='white'">

                        {{-- Avatar --}}
                        <div style="position:relative; flex-shrink:0;">
                            @if($tutor->profile_image)
                                <img src="{{ Storage::url($tutor->profile_image) }}" style="width:42px; height:42px; border-radius:12px; object-fit:cover;">
                            @else
                                <div class="avatar" style="width:42px; height:42px; border-radius:12px; font-size:0.9rem;">
                                    {{ strtoupper(substr($tutor->name, 0, 1)) }}
                                </div>
                            @endif
                            <div style="position:absolute; bottom:-2px; right:-2px; width:11px; height:11px; background:#22c55e; border-radius:50%; border:2px solid white;"></div>
                        </div>

                        {{-- Info --}}
                        <div style="flex:1; min-width:0;">
                            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem; margin-bottom:2px;">{{ $tutor->name }}</p>
                            <p style="font-size:0.72rem; color:var(--slate-400); margin-bottom:0;">
                                {{ $tutor->courses()->count() }} course(s)
                                @if($tutor->bio)
                                    &middot; {{ Str::limit($tutor->bio, 25) }}
                                @endif
                            </p>
                        </div>

                        {{-- Chat button --}}
                        <a href="/messages/{{ $tutor->id }}"
                            class="btn-primary"
                            style="padding:8px 14px; font-size:0.75rem; flex-shrink:0; text-decoration:none;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Chat
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>

            {{-- Info box --}}
            <div style="background:#fffbeb; border:1.5px solid #fde68a; border-radius:14px; padding:14px 16px; margin-top:14px; display:flex; gap:10px; align-items:flex-start;">
                <svg width="16" height="16" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0; margin-top:1px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p style="font-size:0.78rem; color:#92400e; font-weight:700; margin-bottom:3px;">How to enroll?</p>
                    <p style="font-size:0.75rem; color:#b45309; margin:0; line-height:1.5;">
                        Chat with a tutor → Ask for enrollment key → Use key to enroll in their course.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection