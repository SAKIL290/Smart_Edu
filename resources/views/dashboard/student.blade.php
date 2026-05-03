@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')

{{-- Welcome Banner --}}
<div class="fade-1" style="background:linear-gradient(135deg,#0ea5e9 0%,#2563eb 60%,#1d4ed8 100%); border-radius:24px; padding:32px 36px; margin-bottom:28px; position:relative; overflow:hidden; color:white;">
    <div style="position:absolute; top:-40px; right:-40px; width:180px; height:180px; background:rgba(255,255,255,0.07); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-50px; right:150px; width:120px; height:120px; background:rgba(255,255,255,0.05); border-radius:50%;"></div>
    <div style="position:absolute; top:20px; right:36px; opacity:0.15;">
        <svg width="64" height="64" fill="white" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 11-6-11-6z"/></svg>
    </div>
    <p style="font-size:0.72rem; font-weight:800; letter-spacing:0.12em; text-transform:uppercase; opacity:0.7; margin-bottom:6px;">Welcome back, Student 🎓</p>
    <h2 style="font-family:'Nunito',sans-serif; font-size:2rem; font-weight:900; margin-bottom:8px;">{{ auth()->user()->name }}</h2>
    <p style="opacity:0.75; font-size:0.9rem;">You are enrolled in <strong>{{ $enrolledCourses->count() }} course(s)</strong>. Keep learning!</p>
</div>

{{-- Stats --}}
<div class="fade-2" style="display:grid; grid-template-columns:repeat(2,1fr); gap:18px; margin-bottom:28px;">

    <div class="stat-card blue">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
            <div>
                <p class="stat-label">Enrolled Courses</p>
                <p class="stat-num count-anim">{{ $enrolledCourses->count() }}</p>
            </div>
            <div class="stat-icon" style="background:#dbeafe;">
                <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
            </div>
        </div>
        <div style="padding-top:14px; border-top:1px solid var(--blue-50);">
            <a href="{{ route('courses.browse') }}" style="font-size:0.78rem; font-weight:700; color:var(--blue-600); text-decoration:none;">Browse more courses →</a>
        </div>
    </div>

    <div class="stat-card sky">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
            <div>
                <p class="stat-label">My Bookings</p>
                <p class="stat-num count-anim" style="color:#0284c7;">{{ $bookings->count() }}</p>
            </div>
            <div class="stat-icon" style="background:#e0f2fe;">
                <svg width="22" height="22" fill="none" stroke="#0284c7" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <div style="padding-top:14px; border-top:1px solid var(--blue-50);">
            <a href="{{ route('bookings.create') }}" style="font-size:0.78rem; font-weight:700; color:#0284c7; text-decoration:none;">+ Book a tutor →</a>
        </div>
    </div>
</div>

{{-- My Courses --}}
<div class="fade-3" style="margin-bottom:28px;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <h2 class="section-title">My Courses</h2>
        <a href="{{ route('courses.browse') }}" class="btn-primary">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
            Browse Courses
        </a>
    </div>

    @if($enrolledCourses->isEmpty())
    <div class="card empty-state">
        <div class="empty-icon"><svg width="26" height="26" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg></div>
        <p style="font-weight:700; color:var(--slate-700); margin-bottom:6px;">No courses yet</p>
        <p style="color:var(--slate-400); font-size:0.875rem; margin-bottom:20px;">Browse courses and use your enrollment key to get started.</p>
        <a href="{{ route('courses.browse') }}" class="btn-primary">Browse Courses</a>
    </div>
    @else
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:18px;">
        @foreach($enrolledCourses as $course)
        <div class="course-card">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" style="width:100%; height:148px; object-fit:cover;">
            @else
                @php $colors = [['#dbeafe','#2563eb'],['#e0e7ff','#4f46e5'],['#d1fae5','#059669'],['#fef3c7','#d97706'],['#fce7f3','#db2777']]; $c = $colors[$course->id % 5]; @endphp
                <div style="height:148px; background:{{ $c[0] }}; display:flex; align-items:center; justify-content:center;">
                    <svg width="40" height="40" fill="none" stroke="{{ $c[1] }}" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                </div>
            @endif
            <div style="padding:18px;">
                <h3 style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.95rem; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $course->title }}</h3>
                <p style="font-size:0.78rem; color:var(--slate-400); font-weight:600; margin-bottom:14px;">by {{ $course->tutor->name }}</p>
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('student.course.show', $course) }}" class="btn-primary" style="flex:1; justify-content:center; padding:9px 14px; font-size:0.82rem;">View Course</a>
                    <a href="{{ route('messages.index', $course) }}" class="btn-secondary" style="padding:9px 14px; font-size:0.82rem;">💬</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Bookings --}}
<div class="fade-4">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <h2 class="section-title">My Bookings</h2>
        <a href="{{ route('bookings.index') }}" style="font-size:0.82rem; font-weight:700; color:var(--blue-600); text-decoration:none;">View all →</a>
    </div>
    <div class="card" style="overflow:hidden;">
        @if($bookings->isEmpty())
        <div class="empty-state">
            <p style="color:var(--slate-400); font-size:0.875rem;">No bookings yet. <a href="{{ route('bookings.create') }}" style="color:var(--blue-600); font-weight:700;">Book a tutor session →</a></p>
        </div>
        @else
        <table class="data-table">
            <thead><tr>
                <th style="text-align:left;">Tutor</th>
                <th style="text-align:left;">Subject</th>
                <th style="text-align:left;">Date & Time</th>
                <th style="text-align:left;">Status</th>
            </tr></thead>
            <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div class="avatar" style="width:32px; height:32px; border-radius:8px; font-size:0.72rem;">{{ strtoupper(substr($b->tutor->name,0,1)) }}</div>
                        <span style="font-weight:700; color:var(--slate-700);">{{ $b->tutor->name }}</span>
                    </div>
                </td>
                <td>{{ $b->subject->name ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->session_time)->format('d M Y, h:i A') }}</td>
                <td><span class="badge badge-{{ $b->status }}">{{ ucfirst($b->status) }}</span></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection