@extends('layouts.app')
@section('title', 'My Courses')
@section('content')

@section('content')
<div class="fade-1" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <p style="color:var(--slate-400); font-weight:600; font-size:0.875rem;">{{ $courses->count() }} course(s) total</p>
    <a href="{{ route('courses.create') }}" class="btn-primary">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Create Course
    </a>
</div>

@if($courses->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center">
        <p class="text-5xl mb-4">📚</p>
        <p class="text-xl font-bold text-slate-700 mb-2">No courses yet</p>
        <p class="text-slate-400 mb-6">Create your first course to start teaching.</p>
        <a href="{{ route('courses.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700">Create First Course</a>
    </div>
@else
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($courses as $course)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg transition group">
        @if($course->thumbnail)
            <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-44 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                <span class="text-white text-5xl">📚</span>
            </div>
        @endif
        <div class="p-5">
            <h3 class="font-bold text-slate-800 text-lg mb-1">{{ $course->title }}</h3>
            <p class="text-sm text-slate-400 mb-3 line-clamp-2">{{ $course->description }}</p>
            <div class="flex items-center gap-3 text-xs text-slate-500 mb-4">
                <span>👥 {{ $course->students_count }} students</span>
                <span>🎥 {{ $course->lectures_count }} lectures</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl mb-4">
                <p class="text-xs text-slate-400 mb-1">Enrollment Key</p>
                <p class="font-mono font-bold text-slate-700 tracking-widest">{{ $course->enrollment_key }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('courses.show', $course) }}" class="flex-1 text-center py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700">Manage</a>
                <a href="{{ route('messages.index', $course) }}" class="px-3 py-2 border border-slate-200 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">💬</a>
                <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 border border-red-200 rounded-xl text-red-400 hover:bg-red-50 text-sm">🗑</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection