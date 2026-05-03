@extends('layouts.app')
@section('title', 'Add Subject')
@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Add New Subject</h2>
        <form action="{{ route('subjects.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Subject Name *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none resize-none">{{ old('description') }}</textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <a href="{{ route('subjects.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 font-semibold rounded-xl">Cancel</a>
                <button class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700">Save Subject</button>
            </div>
        </form>
    </div>
</div>
@endsection