@extends('layouts.app')
@section('title', 'My Bookings')
@section('content')

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    @if($bookings->isEmpty())
        <div class="text-center py-16">
            <p class="text-5xl mb-4">📅</p>
            <p class="text-slate-400">No bookings found.</p>
            @if(auth()->user()->isStudent())
                <a href="{{ route('bookings.create') }}" class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold">Book a Tutor</a>
            @endif
        </div>
    @else
    <table class="w-full">
        <thead class="bg-slate-50 text-xs text-slate-500 uppercase">
            <tr>
                <th class="text-left px-6 py-4">{{ auth()->user()->isTutor() ? 'Student' : 'Tutor' }}</th>
                <th class="text-left px-6 py-4">Subject</th>
                <th class="text-left px-6 py-4">Date & Time</th>
                <th class="text-left px-6 py-4">Notes</th>
                <th class="text-left px-6 py-4">Status</th>
                @if(auth()->user()->isTutor())<th class="text-left px-6 py-4">Action</th>@endif
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($bookings as $b)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-medium text-slate-800">
                    {{ auth()->user()->isTutor() ? $b->student->name : $b->tutor->name }}
                </td>
                <td class="px-6 py-4 text-slate-500">{{ $b->subject->name ?? '—' }}</td>
                <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($b->session_time)->format('d M Y, h:i A') }}</td>
                <td class="px-6 py-4 text-slate-400 text-sm max-w-xs truncate">{{ $b->notes ?? '—' }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $b->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $b->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $b->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $b->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                    ">{{ ucfirst($b->status) }}</span>
                </td>
                @if(auth()->user()->isTutor())
                <td class="px-6 py-4">
                    <form action="{{ route('bookings.status', $b) }}" method="POST" class="flex gap-2">
                        @csrf @method('PATCH')
                        <select name="status" class="text-xs border rounded-lg px-2 py-1">
                            @foreach(['pending','approved','completed','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $b->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded-lg">Save</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection