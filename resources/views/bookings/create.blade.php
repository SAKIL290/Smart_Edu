@extends('layouts.app')
@section('title','Book a Tutor')
@section('content')
<div style="max-width:640px; margin:0 auto;">
<div class="card fade-1" style="padding:36px;">
    <div style="display:flex; align-items:center; gap:14px; margin-bottom:28px; padding-bottom:24px; border-bottom:1px solid var(--blue-50);">
        <div style="width:48px; height:48px; background:var(--blue-50); border-radius:14px; display:flex; align-items:center; justify-content:center; border:1.5px solid var(--blue-100);">
            <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <h2 style="font-family:'Nunito',sans-serif; font-weight:900; font-size:1.3rem; color:var(--slate-800);">Book a Tutoring Session</h2>
            <p style="font-size:0.82rem; color:var(--slate-400);">Schedule a 1-on-1 session with your preferred tutor.</p>
        </div>
    </div>
    <form action="{{ route('bookings.store') }}" method="POST" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        <div>
            <label class="form-label">Select Tutor *</label>
            <select name="tutor_id" class="form-input" required>
                <option value="">— Choose a Tutor —</option>
                @foreach($tutors as $t)
                    <option value="{{ $t->id }}" {{ old('tutor_id')==$t->id?'selected':'' }}>{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Subject (optional)</label>
            <select name="subject_id" class="form-input">
                <option value="">— Choose a Subject —</option>
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}" {{ old('subject_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Session Date & Time *</label>
            <input type="datetime-local" name="session_time" value="{{ old('session_time') }}" class="form-input" required>
        </div>
        <div>
            <label class="form-label">Notes (optional)</label>
            <textarea name="notes" rows="3" class="form-input" style="resize:none;" placeholder="Topics you want to cover...">{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:14px; font-size:1rem;">Send Booking Request</button>
    </form>
</div>
</div>
@endsection