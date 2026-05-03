@extends('layouts.app')
@section('title', 'Create Course')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Create New Course</h2>
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Course Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Web Engineering, OOP, Algorithms"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="What will students learn?"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none resize-none">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Thumbnail Image</label>
                <input type="file" name="thumbnail" accept="image/*"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 file:font-medium">
            </div>
            <div class="p-4 bg-indigo-50 rounded-xl">
                <p class="text-sm text-indigo-700 font-medium">✨ An enrollment key will be auto-generated for your course.</p>
            </div>
            <div class="flex gap-3 justify-end">
                <a href="{{ route('courses.index') }}" class="px-6 py-3 border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 shadow-md shadow-indigo-100">Create Course</button>
            </div>
        </form>
    </div>
</div>
@endsection