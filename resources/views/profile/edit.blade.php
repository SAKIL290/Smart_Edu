@extends('layouts.app')
@section('title','My Profile')
@section('content')
<div style="max-width:640px; margin:0 auto;">
<div class="card fade-1" style="padding:36px;">
    <div style="display:flex; align-items:center; gap:18px; margin-bottom:28px; padding-bottom:24px; border-bottom:1px solid var(--blue-50);">
        @if($user->profile_image)
            <img src="{{ Storage::url($user->profile_image) }}" style="width:72px; height:72px; border-radius:18px; object-fit:cover; border:3px solid var(--blue-100);">
        @else
            <div style="width:72px; height:72px; border-radius:18px; background:linear-gradient(135deg,#2563eb,#1d4ed8); display:flex; align-items:center; justify-content:center; font-family:'Nunito',sans-serif; font-size:1.8rem; font-weight:900; color:white;">
                {{ strtoupper(substr($user->name,0,1)) }}
            </div>
        @endif
        <div>
            <h2 style="font-family:'Nunito',sans-serif; font-weight:900; font-size:1.3rem; color:var(--slate-800); margin-bottom:4px;">{{ $user->name }}</h2>
            <span class="role-pill">{{ ucfirst($user->role) }}</span>
        </div>
    </div>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:18px;">
        @csrf
        <div><label class="form-label">Full Name</label><input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-input" required></div>
        <div><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone',$user->phone) }}" class="form-input" placeholder="Your phone number"></div>
        <div><label class="form-label">Bio</label><textarea name="bio" rows="4" class="form-input" style="resize:none;" placeholder="Tell students about yourself...">{{ old('bio',$user->bio) }}</textarea></div>
        <div><label class="form-label">Profile Picture</label>
            <input type="file" name="profile_image" accept="image/*" class="form-input" style="padding:10px;">
        </div>
        <button type="submit" class="btn-primary" style="align-self:flex-end; padding:12px 28px;">Save Changes</button>
    </form>
</div>
</div>
@endsection