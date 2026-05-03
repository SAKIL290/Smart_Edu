@extends('layouts.app')
@section('title', 'Upload Lecture')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Upload New Lecture</h2>
        <p class="text-slate-400 mb-6">for <span class="font-semibold text-indigo-600">{{ $course->title }}</span></p>
        <form action="{{ route('lectures.store', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Lecture Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Introduction to Arrays"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Video File * (MP4, AVI, MOV — max 200MB)</label>
                <input type="file" name="video" accept="video/*"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-medium" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description (optional)</label>
                <textarea name="description" rows="3"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none resize-none">{{ old('description') }}</textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <a href="{{ route('courses.show', $course) }}" class="px-6 py-3 border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700">Upload Lecture</button>
            </div>
        </form>
    </div>
</div>
@endsection