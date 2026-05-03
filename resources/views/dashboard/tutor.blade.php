@extends('layouts.app')
@section('title', 'Tutor Dashboard')
@section('content')

{{-- Welcome Banner --}}
<div class="fade-1" style="background:linear-gradient(135deg,#2563eb 0%,#1d4ed8 60%,#1e40af 100%); border-radius:24px; padding:32px 36px; margin-bottom:28px; position:relative; overflow:hidden; color:white;">
    <div style="position:absolute; top:-40px; right:-40px; width:180px; height:180px; background:rgba(255,255,255,0.07); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-50px; right:120px; width:140px; height:140px; background:rgba(255,255,255,0.05); border-radius:50%;"></div>
    <div style="position:absolute; top:20px; right:36px; opacity:0.15;">
        <svg width="64" height="64" fill="white" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
    </div>
    <p style="font-size:0.72rem; font-weight:800; letter-spacing:0.12em; text-transform:uppercase; opacity:0.7; margin-bottom:6px;">Welcome back, Tutor 👋</p>
    <h2 style="font-family:'Nunito',sans-serif; font-size:2rem; font-weight:900; margin-bottom:8px;">{{ auth()->user()->name }}</h2>
    <p style="opacity:0.75; font-size:0.9rem;">
        You have <strong>{{ $courses->count() }} course(s)</strong> active &nbsp;·&nbsp;
        <strong>{{ $bookings->where('status','pending')->count() }} booking(s)</strong> awaiting response
    </p>
</div>

{{-- Stats --}}
<div class="fade-2" style="display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:28px;">

    <div class="stat-card blue">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
            <div>
                <p class="stat-label">Total Courses</p>
                <p class="stat-num count-anim">{{ $courses->count() }}</p>
            </div>
            <div class="stat-icon" style="background:#dbeafe;">
                <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
            </div>
        </div>
        <div style="padding-top:14px; border-top:1px solid var(--blue-50);">
            <a href="{{ route('courses.create') }}" style="font-size:0.78rem; font-weight:700; color:var(--blue-600); text-decoration:none;">+ Create new course →</a>
        </div>
    </div>

    <div class="stat-card indigo">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
            <div>
                <p class="stat-label">Total Students</p>
                <p class="stat-num count-anim">{{ $courses->sum('students_count') }}</p>
            </div>
            <div class="stat-icon" style="background:#e0e7ff;">
                <svg width="22" height="22" fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
        </div>
        <div style="padding-top:14px; border-top:1px solid var(--blue-50);">
            <span style="font-size:0.78rem; font-weight:700; color:#4f46e5;">Across all your courses</span>
        </div>
    </div>

    <div class="stat-card amber">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
            <div>
                <p class="stat-label">Pending Bookings</p>
                <p class="stat-num count-anim" style="color:#d97706;">{{ $bookings->where('status','pending')->count() }}</p>
            </div>
            <div class="stat-icon" style="background:#fef3c7;">
                <svg width="22" height="22" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <div style="padding-top:14px; border-top:1px solid var(--blue-50);">
            <a href="{{ route('bookings.index') }}" style="font-size:0.78rem; font-weight:700; color:#d97706; text-decoration:none;">View all bookings →</a>
        </div>
    </div>
</div>

{{-- My Courses --}}
<div class="fade-3" style="margin-bottom:28px;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <h2 class="section-title">My Courses</h2>
        <a href="{{ route('courses.create') }}" class="btn-primary">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            New Course
        </a>
    </div>

    @if($courses->isEmpty())
    <div class="card empty-state">
        <div class="empty-icon"><svg width="26" height="26" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg></div>
        <p style="font-weight:700; color:var(--slate-700); margin-bottom:6px;">No courses yet</p>
        <p style="color:var(--slate-400); font-size:0.875rem; margin-bottom:20px;">Create your first course and start teaching students.</p>
        <a href="{{ route('courses.create') }}" class="btn-primary">Create First Course</a>
    </div>
    @else
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:18px;">
        @foreach($courses as $course)
        <div class="course-card">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" style="width:100%; height:148px; object-fit:cover;">
            @else
                @php $colors = [['#dbeafe','#2563eb'],['#e0e7ff','#4f46e5'],['#d1fae5','#059669'],['#fef3c7','#d97706'],['#fce7f3','#db2777']]; $c = $colors[$course->id % 5]; @endphp
                <div style="height:148px; background:{{ $c[0] }}; display:flex; align-items:center; justify-content:center;">
                    <svg width="40" height="40" fill="none" stroke="{{ $c[1] }}" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            @endif
            <div style="padding:18px;">
                <h3 style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.95rem; margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $course->title }}</h3>
                <div style="display:flex; gap:12px; margin-bottom:14px;">
                    <span style="font-size:0.75rem; color:var(--slate-400); font-weight:600;">👥 {{ $course->students_count }}</span>
                    <span style="font-size:0.75rem; color:var(--slate-400); font-weight:600;">🎥 {{ $course->lectures_count }}</span>
                </div>
                <div style="background:var(--blue-50); border:1.5px dashed #93c5fd; border-radius:10px; padding:10px 14px; margin-bottom:14px;">
                    <p style="font-size:0.62rem; font-weight:800; color:var(--blue-500); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:2px;">Enrollment Key</p>
                    <p style="font-family:'Courier New',monospace; font-weight:900; color:var(--blue-700); font-size:1rem; letter-spacing:0.18em;">{{ $course->enrollment_key }}</p>
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('courses.show', $course) }}" class="btn-primary" style="flex:1; justify-content:center; padding:9px 14px;">Manage</a>
                    <a href="{{ route('messages.index', $course) }}" class="btn-secondary" style="padding:9px 14px;">💬</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Recent Bookings --}}
<div class="fade-4">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <h2 class="section-title">Recent Bookings</h2>
        <a href="{{ route('bookings.index') }}" style="font-size:0.82rem; font-weight:700; color:var(--blue-600); text-decoration:none;">View all →</a>
    </div>
    <div class="card" style="overflow:hidden;">
        @if($bookings->isEmpty())
        <div class="empty-state">
            <p style="color:var(--slate-400); font-size:0.875rem;">No bookings yet. Students will appear here when they book sessions.</p>
        </div>
        @else
        <table class="data-table">
            <thead><tr>
                <th style="text-align:left;">Student</th>
                <th style="text-align:left;">Subject</th>
                <th style="text-align:left;">Date & Time</th>
                <th style="text-align:left;">Status</th>
                <th style="text-align:left;">Update</th>
            </tr></thead>
            <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div class="avatar" style="width:32px; height:32px; border-radius:8px; font-size:0.72rem;">{{ strtoupper(substr($b->student->name,0,1)) }}</div>
                        <span style="font-weight:700; color:var(--slate-700);">{{ $b->student->name }}</span>
                    </div>
                </td>
                <td>{{ $b->subject->name ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->session_time)->format('d M Y, h:i A') }}</td>
                <td><span class="badge badge-{{ $b->status }}">{{ ucfirst($b->status) }}</span></td>
                <td>
                    <form action="{{ route('bookings.status', $b) }}" method="POST" style="display:flex; gap:6px;">
                        @csrf @method('PATCH')
                        <select name="status" style="background:white; border:1.5px solid var(--slate-200); color:var(--slate-700); border-radius:8px; padding:5px 8px; font-size:0.78rem; font-weight:600; outline:none; font-family:'Plus Jakarta Sans',sans-serif;">
                            @foreach(['pending','approved','completed','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $b->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-primary" style="padding:5px 14px; font-size:0.78rem;">Save</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection