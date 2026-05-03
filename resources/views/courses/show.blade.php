@extends('layouts.app')
@section('title', $course->title)
@section('content')

<div class="flex items-start justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">{{ $course->title }}</h2>
        <p class="text-slate-400 mt-1">{{ $course->description }}</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('messages.index', $course) }}" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-50">💬 Group Chat</a>
        <a href="{{ route('lectures.create', $course) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700">+ Add Lecture</a>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Lectures -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 mb-4">📹 Lectures ({{ $lectures->count() }})</h3>
            @if($lectures->isEmpty())
                <div class="text-center py-10">
                    <p class="text-slate-400 mb-4">No lectures yet.</p>
                    <a href="{{ route('lectures.create', $course) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm">Upload First Lecture</a>
                </div>
            @else
            <div class="space-y-3">
                @foreach($lectures as $i => $lecture)
                <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm shrink-0">{{ $i+1 }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-800">{{ $lecture->title }}</p>
                        @if($lecture->description)
                            <p class="text-xs text-slate-400 mt-1">{{ $lecture->description }}</p>
                        @endif
                        <video controls class="mt-3 w-full rounded-xl" style="max-height:200px">
                            <source src="{{ Storage::url($lecture->video_path) }}">
                        </video>
                    </div>
                    <form action="{{ route('lectures.destroy', [$course, $lecture]) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 text-sm">🗑</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-4">
        <!-- Enrollment Key -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 mb-3">🔑 Enrollment Key</h3>
            <div class="bg-indigo-50 rounded-xl p-4 text-center">
                <p class="font-mono text-2xl font-black text-indigo-700 tracking-widest">{{ $course->enrollment_key }}</p>
            </div>
            <p class="text-xs text-slate-400 mt-2 text-center">Share this key with students to enroll</p>
        </div>

        <!-- Students -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 mb-3">👥 Students ({{ $students->count() }})</h3>
            @if($students->isEmpty())
                <p class="text-slate-400 text-sm">No students enrolled yet.</p>
            @else
            <div class="space-y-2">
                @foreach($students as $student)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <p class="text-sm font-medium text-slate-700">{{ $student->name }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection