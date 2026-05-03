@extends('layouts.app')
@section('title', 'Browse Courses')
@section('content')

{{-- Key Modal --}}
<div id="keyModal" style="display:none; position:fixed; inset:0; z-index:1000; align-items:center; justify-content:center; background:rgba(15,23,42,0.5); backdrop-filter:blur(6px);">
    <div style="background:white; border:1.5px solid var(--blue-100); border-radius:24px; padding:36px; width:100%; max-width:420px; position:relative; box-shadow:0 24px 60px rgba(37,99,235,0.15);">
        <button onclick="closeKeyModal()" style="position:absolute; top:14px; right:14px; background:var(--slate-100); border:none; color:var(--slate-500); border-radius:8px; width:30px; height:30px; cursor:pointer; font-size:1rem; display:flex; align-items:center; justify-content:center;">✕</button>

        <div style="width:52px; height:52px; background:var(--blue-50); border:1.5px solid var(--blue-100); border-radius:16px; display:flex; align-items:center; justify-content:center; margin-bottom:18px;">
            <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
        </div>

        <h3 style="font-family:'Nunito',sans-serif; font-size:1.2rem; font-weight:900; color:var(--slate-800); margin-bottom:4px;">Enter Enrollment Key</h3>
        <p id="modalCourseName" style="font-size:0.82rem; color:var(--slate-400); margin-bottom:22px;"></p>

        <form action="{{ route('enroll') }}" method="POST">
            @csrf
            <div style="margin-bottom:16px;">
                <label class="form-label">Enrollment Key</label>
                <input type="text" name="enrollment_key" id="modalKeyInput"
                    placeholder="e.g. AB12CD34"
                    autocomplete="off"
                    class="form-input"
                    style="text-align:center; font-family:'Courier New',monospace; font-size:1.2rem; font-weight:800; letter-spacing:0.2em; text-transform:uppercase;"
                    value="{{ old('enrollment_key') }}" required>
                @error('enrollment_key')
                    <p style="color:#ef4444; font-size:0.78rem; margin-top:6px; font-weight:600;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info box --}}
            <div style="background:#fffbeb; border:1.5px solid #fde68a; border-radius:12px; padding:12px 16px; margin-bottom:20px; display:flex; gap:10px; align-items:flex-start;">
                <svg width="16" height="16" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0; margin-top:1px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p style="font-size:0.78rem; color:#92400e; margin:0; font-weight:600;">Don't have a key? Contact the tutor first using the <strong>Chat with Tutor</strong> button to get your enrollment key.</p>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="button" onclick="closeKeyModal()" class="btn-secondary" style="flex:1; justify-content:center;">Cancel</button>
                <button type="submit" class="btn-primary" style="flex:2; justify-content:center;">Enroll Now</button>
            </div>
        </form>
    </div>
</div>

{{-- Header --}}
<div class="fade-1" style="background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:24px; padding:28px 32px; margin-bottom:24px; color:white; position:relative; overflow:hidden;">
    <div style="position:absolute; top:-40px; right:-40px; width:160px; height:160px; background:rgba(255,255,255,0.07); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-50px; right:160px; width:120px; height:120px; background:rgba(255,255,255,0.05); border-radius:50%;"></div>
    <p style="font-size:0.72rem; font-weight:800; letter-spacing:0.12em; text-transform:uppercase; opacity:0.7; margin-bottom:6px;">Course Marketplace</p>
    <h2 style="font-family:'Nunito',sans-serif; font-size:1.8rem; font-weight:900; margin-bottom:8px;">Browse Courses</h2>
    <p style="opacity:0.8; font-size:0.9rem; margin:0;">To enroll, contact the tutor and get your <strong>enrollment key</strong>.</p>
</div>

{{-- How it works --}}
<div class="fade-2" style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:24px;">
    <div style="background:white; border:1.5px solid var(--blue-100); border-radius:16px; padding:18px; display:flex; align-items:flex-start; gap:12px;">
        <div style="width:36px; height:36px; background:#dbeafe; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <span style="font-size:1rem;">👀</span>
        </div>
        <div>
            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem; margin-bottom:3px;">Step 1 — Browse</p>
            <p style="font-size:0.75rem; color:var(--slate-400); line-height:1.4;">Find a course you are interested in below.</p>
        </div>
    </div>
    <div style="background:white; border:1.5px solid var(--blue-100); border-radius:16px; padding:18px; display:flex; align-items:flex-start; gap:12px;">
        <div style="width:36px; height:36px; background:#dbeafe; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <span style="font-size:1rem;">💬</span>
        </div>
        <div>
            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem; margin-bottom:3px;">Step 2 — Contact Tutor</p>
            <p style="font-size:0.75rem; color:var(--slate-400); line-height:1.4;">Chat with the tutor and request the enrollment key.</p>
        </div>
    </div>
    <div style="background:white; border:1.5px solid var(--blue-100); border-radius:16px; padding:18px; display:flex; align-items:flex-start; gap:12px;">
        <div style="width:36px; height:36px; background:#dbeafe; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <span style="font-size:1rem;">🔑</span>
        </div>
        <div>
            <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem; margin-bottom:3px;">Step 3 — Enroll</p>
            <p style="font-size:0.75rem; color:var(--slate-400); line-height:1.4;">Use the key to enroll and start learning!</p>
        </div>
    </div>
</div>

{{-- Quick key entry --}}
<div class="fade-2" style="background:var(--blue-50); border:1.5px solid var(--blue-200); border-radius:16px; padding:18px 22px; margin-bottom:24px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
    <div style="width:38px; height:38px; background:white; border:1.5px solid var(--blue-200); border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <svg width="18" height="18" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
    </div>
    <div style="flex:1; min-width:160px;">
        <p style="font-size:0.82rem; font-weight:800; color:var(--blue-700); margin-bottom:2px;">Already have an enrollment key?</p>
        <p style="font-size:0.75rem; color:var(--blue-500); margin:0;">Enter it here to enroll instantly.</p>
    </div>
    <form action="{{ route('enroll') }}" method="POST" style="display:flex; gap:10px; align-items:center; flex:1; min-width:260px;">
        @csrf
        <input type="text" name="enrollment_key"
            placeholder="ENTER KEY HERE"
            class="form-input"
            style="flex:1; font-family:'Courier New',monospace; font-size:0.9rem; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; background:white;"
            value="{{ old('enrollment_key') }}">
        <button type="submit" class="btn-primary" style="white-space:nowrap; padding:10px 20px;">
            Enroll →
        </button>
    </form>
    @error('enrollment_key')
        <p style="width:100%; color:#ef4444; font-size:0.8rem; margin:4px 0 0; font-weight:600;">{{ $message }}</p>
    @enderror
</div>

{{-- Available Courses --}}
<div class="fade-3" style="margin-bottom:32px;">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <h3 class="section-title">
            Available Courses
            <span style="font-size:0.78rem; font-weight:600; color:var(--slate-400); margin-left:8px;">{{ $courses->count() }} course(s)</span>
        </h3>
    </div>

    @if($courses->isEmpty())
    <div class="card empty-state">
        <div class="empty-icon">
            <svg width="26" height="26" fill="none" stroke="#2563eb" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
        </div>
        <p style="font-weight:700; color:var(--slate-700); margin-bottom:6px;">No courses available</p>
        <p style="color:var(--slate-400); font-size:0.875rem;">You have enrolled in all available courses, or no courses exist yet.</p>
    </div>
    @else
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">
        @foreach($courses as $course)
        <div class="course-card" style="position:relative;">

            {{-- Thumbnail --}}
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" style="width:100%; height:160px; object-fit:cover;">
            @else
                @php
                    $colors = [['#dbeafe','#2563eb'],['#e0e7ff','#4f46e5'],['#d1fae5','#059669'],['#fef3c7','#d97706'],['#fce7f3','#db2777']];
                    $c = $colors[$course->id % 5];
                @endphp
                <div style="height:160px; background:{{ $c[0] }}; display:flex; align-items:center; justify-content:center;">
                    <svg width="40" height="40" fill="none" stroke="{{ $c[1] }}" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                </div>
            @endif

            {{-- Key required badge --}}
            <div style="position:absolute; top:12px; right:12px; background:rgba(255,255,255,0.95); border:1.5px solid var(--blue-200); border-radius:100px; padding:4px 10px; display:flex; align-items:center; gap:5px; box-shadow:0 2px 8px rgba(37,99,235,0.1);">
                <svg width="10" height="10" fill="none" stroke="#d97706" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4"/></svg>
                <span style="font-size:0.62rem; font-weight:800; color:#d97706; letter-spacing:0.05em;">KEY REQUIRED</span>
            </div>

            {{-- Card body --}}
            <div style="padding:18px;">
                <h3 style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:1rem; margin-bottom:6px; line-height:1.3;">{{ $course->title }}</h3>

                {{-- Tutor info --}}
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">
                    <div style="width:24px; height:24px; border-radius:6px; background:linear-gradient(135deg,#2563eb,#1d4ed8); display:flex; align-items:center; justify-content:center; font-size:0.62rem; font-weight:800; color:white; font-family:'Nunito',sans-serif;">
                        {{ strtoupper(substr($course->tutor->name, 0, 1)) }}
                    </div>
                    <span style="font-size:0.8rem; color:var(--slate-500); font-weight:600;">{{ $course->tutor->name }}</span>
                </div>

                {{-- Description --}}
                @if($course->description)
                <p style="font-size:0.8rem; color:var(--slate-400); margin-bottom:12px; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $course->description }}</p>
                @endif

                {{-- Stats --}}
                <div style="display:flex; gap:12px; margin-bottom:16px; padding:10px 12px; background:var(--blue-50); border-radius:10px; border:1px solid var(--blue-100);">
                    <div style="display:flex; align-items:center; gap:5px;">
                        <svg width="13" height="13" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                        <span style="font-size:0.75rem; color:var(--slate-500); font-weight:600;">{{ $course->lectures_count }} lectures</span>
                    </div>
                    <div style="width:1px; background:var(--blue-100);"></div>
                    <div style="display:flex; align-items:center; gap:5px;">
                        <svg width="13" height="13" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span style="font-size:0.75rem; color:var(--slate-500); font-weight:600;">{{ $course->students_count }} enrolled</span>
                    </div>
                </div>

                {{-- TWO BUTTONS: Contact Tutor + Enroll with Key --}}
                <div style="display:flex; flex-direction:column; gap:8px;">

                    {{-- Step 1: Contact Tutor (PRIMARY ACTION) --}}
                    <a href="{{ route('dm.start', ['user' => $course->tutor->id]) }}"
                        class="btn-primary"
                        style="width:100%; justify-content:center; padding:11px; font-size:0.875rem; text-decoration:none;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Chat with Tutor
                    </a>

                    {{-- Step 2: Enroll with Key (SECONDARY ACTION) --}}
                    <button type="button"
                        onclick="openKeyModal('{{ addslashes($course->title) }}')"
                        class="btn-secondary"
                        style="width:100%; justify-content:center; padding:10px; font-size:0.82rem;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        I have a Key — Enroll
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Already Enrolled --}}
@if($enrolledCourses->isNotEmpty())
<div class="fade-4">
    <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
        <h3 class="section-title">Already Enrolled</h3>
        <span style="background:#d1fae5; color:#065f46; border-radius:100px; font-size:0.7rem; font-weight:800; padding:3px 12px; border:1px solid #a7f3d0;">{{ $enrolledCourses->count() }}</span>
    </div>
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px;">
        @foreach($enrolledCourses as $course)
        <div style="background:white; border:1.5px solid var(--blue-100); border-radius:16px; padding:16px; display:flex; align-items:center; gap:14px; box-shadow:0 2px 8px rgba(37,99,235,0.05);">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" style="width:52px; height:52px; border-radius:12px; object-fit:cover; flex-shrink:0;">
            @else
                @php $c = $colors[$course->id % 5] ?? ['#dbeafe','#2563eb']; @endphp
                <div style="width:52px; height:52px; border-radius:12px; background:{{ $c[0] }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg width="22" height="22" fill="none" stroke="{{ $c[1] }}" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                </div>
            @endif
            <div style="flex:1; min-width:0;">
                <p style="font-family:'Nunito',sans-serif; font-weight:800; color:var(--slate-800); font-size:0.88rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:2px;">{{ $course->title }}</p>
                <p style="font-size:0.72rem; color:var(--slate-400); margin-bottom:8px;">{{ $course->tutor->name }}</p>
                <a href="{{ route('student.course.show', $course) }}" style="font-size:0.75rem; font-weight:700; color:var(--blue-600); text-decoration:none;">Continue learning →</a>
            </div>
            <div style="width:30px; height:30px; background:#d1fae5; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; border:1.5px solid #a7f3d0;">
                <svg width="14" height="14" fill="none" stroke="#059669" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Modal JS --}}
<script>
function openKeyModal(courseTitle) {
    document.getElementById('modalCourseName').textContent = 'Course: ' + courseTitle;
    document.getElementById('modalKeyInput').value = '';
    const modal = document.getElementById('keyModal');
    modal.style.display = 'flex';
    setTimeout(() => document.getElementById('modalKeyInput').focus(), 100);
}
function closeKeyModal() {
    document.getElementById('keyModal').style.display = 'none';
}
document.getElementById('keyModal').addEventListener('click', function(e) {
    if (e.target === this) closeKeyModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeKeyModal();
});
</script>

@endsection