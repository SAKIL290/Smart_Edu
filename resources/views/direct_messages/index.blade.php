@extends('layouts.app')
@section('title', 'Messages')
@section('content')

<div style="max-width:700px; margin:0 auto;">

    {{-- Banner --}}
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

    {{-- Conversations --}}
    <div class="card fade-2" style="overflow:hidden;">
        @if($conversations->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="24" height="24" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <p style="font-weight:700; color:var(--slate-700); margin-bottom:6px;">No conversations yet</p>
                <p style="color:var(--slate-400); font-size:0.875rem; margin-bottom:18px;">
                    @if(auth()->user()->isStudent())
                        Browse courses and tap <strong>Contact Tutor</strong> to start a conversation.
                    @else
                        Students will message you here when they want to learn more about your courses.
                    @endif
                </p>
                @if(auth()->user()->isStudent())
                    <a href="{{ route('courses.browse') }}" class="btn-primary">Browse Courses</a>
                @endif
            </div>
        @else
            @foreach($conversations as $conv)
            <a href="{{ route('dm.chat', $conv['user']->id) }}"
                style="display:flex; align-items:center; gap:14px; padding:18px 22px; border-bottom:1px solid var(--blue-50); text-decoration:none; background:white; transition:background 0.15s;"
                onmouseover="this.style.background='#f0f6ff'"
                onmouseout="this.style.background='white'">

                {{-- Avatar with unread badge --}}
                <div style="position:relative; flex-shrink:0;">
                    <div class="avatar" style="width:46px; height:46px; border-radius:14px; font-size:1rem;">
                        {{ strtoupper(substr($conv['user']->name, 0, 1)) }}
                    </div>
                    @if($conv['unread'] > 0)
                        <span style="position:absolute; top:-5px; right:-5px; width:20px; height:20px; background:#ef4444; border-radius:50%; border:2px solid white; display:flex; align-items:center; justify-content:center; font-size:0.6rem; font-weight:800; color:white;">
                            {{ $conv['unread'] }}
                        </span>
                    @endif
                </div>

                {{-- Info --}}
                <div style="flex:1; min-width:0;">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                        <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.95rem;">
                            {{ $conv['user']->name }}
                        </p>
                        <p style="font-size:0.7rem; color:var(--slate-400); font-weight:600; flex-shrink:0; margin-left:8px;">
                            {{ $conv['last_time']->diffForHumans() }}
                        </p>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <p style="font-size:0.8rem; color:var(--slate-400); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; flex:1;">
                            {{ Str::limit($conv['last_msg'], 55) }}
                        </p>
                        <span style="background:var(--blue-50); color:var(--blue-600); border-radius:100px; padding:2px 10px; font-size:0.65rem; font-weight:800; text-transform:uppercase; flex-shrink:0; border:1px solid var(--blue-100);">
                            {{ ucfirst($conv['user']->role) }}
                        </span>
                    </div>
                </div>

                <svg width="16" height="16" fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @endforeach
        @endif
    </div>

</div>
@endsection