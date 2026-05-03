@extends('layouts.app')
@section('title', 'Subjects')
@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-500">{{ $subjects->count() }} subject(s)</p>
    <div class="flex gap-3">
        <a href="{{ route('subjects.assign.form') }}" class="px-4 py-2 border border-indigo-200 text-indigo-600 text-sm font-semibold rounded-xl hover:bg-indigo-50">My Subjects</a>
        <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700">+ Add Subject</a>
    </div>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($subjects as $subject)
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
        <div class="flex items-start justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                {{ strtoupper(substr($subject->name, 0, 1)) }}
            </div>
            <div class="flex gap-2">
                <a href="{{ route('subjects.edit', $subject) }}" class="text-xs text-slate-400 hover:text-indigo-600 px-2 py-1 rounded">Edit</a>
                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-400 hover:text-red-600 px-2 py-1 rounded">Delete</button>
                </form>
            </div>
        </div>
        <h3 class="font-bold text-slate-800 mb-1">{{ $subject->name }}</h3>
        <p class="text-sm text-slate-400 mb-3">{{ $subject->description }}</p>
        <p class="text-xs text-slate-400">👨‍🏫 {{ $subject->tutors_count }} tutor(s)</p>
    </div>
    @endforeach
</div>
@endsection