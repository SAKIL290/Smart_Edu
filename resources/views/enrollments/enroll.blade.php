@extends('layouts.app')
@section('title', 'Enroll in Course')
@section('content')

<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 text-center">
        <div class="text-5xl mb-4">🔑</div>
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Join a Course</h2>
        <p class="text-slate-400 mb-8">Enter the enrollment key given by your tutor to join their course.</p>
        <form action="{{ route('enroll') }}" method="POST">
            @csrf
            <div class="mb-6">
                <input type="text" name="enrollment_key" placeholder="Enter enrollment key (e.g. AB12CD34)"
                    class="w-full border-2 border-slate-200 rounded-2xl px-6 py-4 text-center text-xl font-mono font-bold tracking-widest focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none uppercase"
                    value="{{ old('enrollment_key') }}" required style="letter-spacing:0.3em">
                @error('enrollment_key')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 text-lg">Enroll Now</button>
        </form>
    </div>
</div>
@endsection