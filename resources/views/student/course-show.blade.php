@extends('layouts.app')
@section('title', $course->title)
@section('content')

<div class="flex items-start justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">{{ $course->title }}</h2>
        <p class="text-slate-400">Instructor: {{ $course->tutor->name }}</p>
    </div>
    <a href="{{ route('messages.index', $course) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700">💬 Group Chat</a>
</div>

@if($lectures->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <p class="text-slate-400">No lectures uploaded yet. Check back later!</p>
    </div>
@else
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Video Player -->
    <div class="lg:col-span-2">
        <div class="bg-black rounded-2xl overflow-hidden mb-4" id="videoContainer">
            <video id="mainVideo" controls class="w-full" style="max-height:420px">
                <source src="{{ Storage::url($lectures->first()->video_path) }}" id="videoSrc">
            </video>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5">
            <h3 id="videoTitle" class="text-lg font-bold text-slate-800">{{ $lectures->first()->title }}</h3>
            <p id="videoDesc" class="text-slate-400 mt-1 text-sm">{{ $lectures->first()->description }}</p>
        </div>
    </div>

    <!-- Playlist -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 class="font-bold text-slate-800 mb-4">📋 Course Content ({{ $lectures->count() }})</h3>
        <div class="space-y-2" id="playlist">
            @foreach($lectures as $i => $lecture)
            <div class="playlist-item flex items-start gap-3 p-3 rounded-xl cursor-pointer hover:bg-indigo-50 transition {{ $i === 0 ? 'bg-indigo-50' : '' }}"
                data-video="{{ Storage::url($lecture->video_path) }}"
                data-title="{{ $lecture->title }}"
                data-desc="{{ $lecture->description }}">
                <div class="w-7 h-7 rounded-lg {{ $i === 0 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center text-xs font-bold shrink-0">{{ $i+1 }}</div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $lecture->title }}</p>
                    @if($lecture->description)
                        <p class="text-xs text-slate-400 truncate">{{ $lecture->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.playlist-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.playlist-item').forEach(i => i.classList.remove('bg-indigo-50'));
        item.classList.add('bg-indigo-50');
        document.getElementById('mainVideo').src = item.dataset.video;
        document.getElementById('mainVideo').play();
        document.getElementById('videoTitle').textContent = item.dataset.title;
        document.getElementById('videoDesc').textContent = item.dataset.desc;
    });
});
</script>
@endif
@endsection