@extends('layouts.app')
@section('title', 'My Subjects')
@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">My Teaching Subjects</h2>
        <p class="text-slate-400 mb-6">Select all subjects you teach so students can find you.</p>
        <form action="{{ route('subjects.assign') }}" method="POST" class="space-y-3">
            @csrf
            @foreach($subjects as $subject)
            <label class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-indigo-300 cursor-pointer transition">
                <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                    {{ auth()->user()->subjects->contains($subject->id) ? 'checked' : '' }}
                    class="w-4 h-4 text-indigo-600 rounded">
                <div>
                    <p class="font-semibold text-slate-800">{{ $subject->name }}</p>
                    <p class="text-xs text-slate-400">{{ $subject->description }}</p>
                </div>
            </label>
            @endforeach
            <button class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl mt-4 hover:bg-indigo-700">Save My Subjects</button>
        </form>
    </div>
</div>
@endsection