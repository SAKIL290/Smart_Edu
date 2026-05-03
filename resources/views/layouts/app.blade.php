<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Education — @yield('title','Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-50:  #eff6ff;
            --blue-100: #dbeafe;
            --blue-200: #bfdbfe;
            --blue-400: #60a5fa;
            --blue-500: #3b82f6;
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --slate-50:  #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f4ff; color: var(--slate-700); }
        h1,h2,h3,.font-display { font-family: 'Nunito', sans-serif; }

        /* Sidebar */
        .sidebar {
            background: white;
            border-right: 1px solid var(--blue-100);
            box-shadow: 4px 0 24px rgba(37,99,235,0.06);
        }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; border-radius: 12px;
            color: var(--slate-500); font-size: 0.875rem; font-weight: 600;
            text-decoration: none; transition: all 0.18s;
        }
        .nav-link:hover { background: var(--blue-50); color: var(--blue-600); }
        .nav-link.active {
            background: linear-gradient(135deg, var(--blue-600), #1d4ed8);
            color: white;
            box-shadow: 0 4px 14px rgba(37,99,235,0.35);
        }
        .nav-link.active svg { stroke: white; }

        /* Cards */
        .card {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--blue-100);
            box-shadow: 0 2px 12px rgba(37,99,235,0.06);
        }
        .stat-card {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--blue-100);
            box-shadow: 0 2px 12px rgba(37,99,235,0.06);
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.25s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(37,99,235,0.12); }
        .stat-card::after {
            content: ''; position: absolute;
            top: 0; right: 0; width: 80px; height: 80px;
            border-radius: 0 20px 0 80px;
            opacity: 0.07;
        }
        .stat-card.blue::after   { background: #2563eb; }
        .stat-card.indigo::after { background: #4f46e5; }
        .stat-card.sky::after    { background: #0ea5e9; }
        .stat-card.emerald::after{ background: #10b981; }
        .stat-card.amber::after  { background: #f59e0b; }

        /* Course cards */
        .course-card {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--blue-100);
            box-shadow: 0 2px 12px rgba(37,99,235,0.05);
            overflow: hidden;
            transition: all 0.25s;
        }
        .course-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(37,99,235,0.14); border-color: var(--blue-200); }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white; font-weight: 700; border-radius: 12px;
            padding: 10px 20px; font-size: 0.875rem; border: none;
            cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none; font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(37,99,235,0.4); }
        .btn-secondary {
            background: var(--blue-50); color: var(--blue-600);
            font-weight: 700; border-radius: 12px;
            padding: 10px 20px; font-size: 0.875rem;
            border: 1px solid var(--blue-200); cursor: pointer;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-secondary:hover { background: var(--blue-100); }

        /* Table */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th { font-size: 0.7rem; font-weight: 800; color: var(--blue-600); text-transform: uppercase; letter-spacing: 0.08em; padding: 12px 20px; background: var(--blue-50); }
        .data-table th:first-child { border-radius: 12px 0 0 12px; }
        .data-table th:last-child  { border-radius: 0 12px 12px 0; }
        .data-table td { padding: 14px 20px; border-bottom: 1px solid var(--blue-50); font-size: 0.875rem; color: var(--slate-600); }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #f8fbff; }

        /* Badges */
        .badge { display: inline-block; padding: 4px 12px; border-radius: 100px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; }
        .badge-pending   { background: #fef3c7; color: #92400e; }
        .badge-approved  { background: #d1fae5; color: #065f46; }
        .badge-completed { background: #dbeafe; color: #1e40af; }
        .badge-cancelled { background: #fee2e2; color: #991b1b; }

        /* Alerts */
        .alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; gap: 10px; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 14px; padding: 14px 18px; }

        /* Inputs */
        .form-input {
            width: 100%; background: white;
            border: 1.5px solid var(--slate-200);
            border-radius: 12px; padding: 12px 16px;
            color: var(--slate-700); font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem; transition: all 0.2s; outline: none;
        }
        .form-input:focus { border-color: var(--blue-400); box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
        .form-input::placeholder { color: var(--slate-400); }
        .form-label { font-size: 0.78rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 8px; }

        /* Animations */
        @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
        @keyframes countAnim { from { opacity:0; transform:scale(0.8); } to { opacity:1; transform:scale(1); } }
        .fade-1 { animation: fadeUp 0.45s ease both; }
        .fade-2 { animation: fadeUp 0.45s 0.07s ease both; }
        .fade-3 { animation: fadeUp 0.45s 0.14s ease both; }
        .fade-4 { animation: fadeUp 0.45s 0.21s ease both; }
        .fade-5 { animation: fadeUp 0.45s 0.28s ease both; }
        .count-anim { animation: countAnim 0.5s 0.2s ease both; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--blue-50); }
        ::-webkit-scrollbar-thumb { background: var(--blue-200); border-radius: 10px; }

        /* Key pill */
        .key-pill {
            background: linear-gradient(135deg, var(--blue-50), #eff6ff);
            border: 1.5px dashed var(--blue-300, #93c5fd);
            border-radius: 10px; padding: 8px 14px;
            font-family: 'Courier New', monospace;
            font-weight: 800; font-size: 1rem;
            color: var(--blue-700); letter-spacing: 0.18em;
        }

        /* Section title */
        .section-title { font-family:'Nunito',sans-serif; font-size:1.1rem; font-weight:800; color:var(--slate-800); }

        /* Avatar */
        .avatar { width:36px; height:36px; border-radius:10px; background:linear-gradient(135deg,#2563eb,#1d4ed8); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:0.8rem; color:white; font-family:'Nunito',sans-serif; flex-shrink:0; }

        /* Topbar */
        .topbar { background:white; border-bottom:1px solid var(--blue-100); padding:14px 32px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:40; box-shadow:0 2px 12px rgba(37,99,235,0.06); }

        /* Role pill */
        .role-pill { background:var(--blue-100); color:var(--blue-700); border-radius:100px; padding:4px 14px; font-size:0.72rem; font-weight:800; text-transform:uppercase; letter-spacing:0.08em; }

        /* Empty state */
        .empty-state { padding: 48px; text-align: center; }
        .empty-icon { width:60px; height:60px; background:var(--blue-50); border-radius:18px; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; border:1.5px solid var(--blue-100); }

        /* Stat number */
        .stat-num { font-family:'Nunito',sans-serif; font-size:2.4rem; font-weight:900; color:var(--slate-800); line-height:1; }
        .stat-label { font-size:0.72rem; font-weight:700; color:var(--slate-400); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:10px; }
        .stat-icon { width:46px; height:46px; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    </style>
</head>
<body>
<div style="display:flex; min-height:100vh;">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar" style="width:248px; display:flex; flex-direction:column; position:fixed; height:100vh; z-index:50;">

        <!-- Logo -->
        <div style="padding:24px 20px 18px; border-bottom:1px solid var(--blue-50);">
            <a href="{{ route('dashboard') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                <div style="width:38px; height:38px; background:linear-gradient(135deg,#2563eb,#1d4ed8); border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(37,99,235,0.35);">
                    <svg width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p style="font-family:'Nunito',sans-serif; font-weight:900; font-size:1.15rem; color:var(--slate-800); line-height:1;">SmartEdu</p>
                    <p style="font-size:0.65rem; color:var(--blue-500); font-weight:700; letter-spacing:0.05em;">LEARNING PLATFORM</p>
                </div>
            </a>
        </div>

        <!-- Nav -->
        <nav style="flex:1; padding:16px 12px; overflow-y:auto; display:flex; flex-direction:column; gap:3px;">
            <p style="font-size:0.65rem; font-weight:800; color:var(--slate-400); text-transform:uppercase; letter-spacing:0.1em; padding:8px 14px 6px;">Navigation</p>

            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>

            @if(auth()->user()->isTutor())
                <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    My Courses
                </a>
                <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Subjects
                </a>
            @else
                <a href="{{ route('courses.browse') }}" class="nav-link {{ request()->routeIs('courses.browse') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                    Browse Courses
                </a>
                <a href="{{ route('bookings.create') }}" class="nav-link {{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Book a Tutor
                </a>
            @endif
            <a href="{{ route('bookings.index') }}" class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                Bookings
            </a>
            <a href="{{ route('dm.inbox') }}" class="nav-link {{ request()->routeIs('dm.*') ? 'active' : '' }}" style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Messages
                @php
                    $unreadCount = \App\Models\DirectMessage::where('receiver_id', auth()->id())->where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span style="margin-left:auto; background:#ef4444; color:white; border-radius:100px; padding:1px 7px; font-size:0.65rem; font-weight:800;">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profile
            </a>
        </nav>

        <!-- User -->
        <div style="padding:14px 12px; border-top:1px solid var(--blue-50);">
            <div style="display:flex; align-items:center; gap:10px; padding:10px 12px; background:var(--blue-50); border-radius:14px; margin-bottom:8px; border:1px solid var(--blue-100);">
                @if(auth()->user()->profile_image)
                    <img src="{{ Storage::url(auth()->user()->profile_image) }}" style="width:36px; height:36px; border-radius:10px; object-fit:cover; flex-shrink:0;">
                @else
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                @endif
                <div style="overflow:hidden; flex:1;">
                    <p style="font-size:0.82rem; font-weight:700; color:var(--slate-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                    <p style="font-size:0.68rem; color:var(--blue-600); font-weight:700; text-transform:capitalize;">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="width:100%; background:white; border:1.5px solid #fecaca; color:#ef4444; border-radius:10px; padding:8px 12px; font-size:0.8rem; font-weight:700; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:6px; font-family:'Plus Jakarta Sans',sans-serif;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='white'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <main style="flex:1; margin-left:248px; min-height:100vh; display:flex; flex-direction:column;">
        <header class="topbar">
            <div style="display:flex; align-items:center; gap:14px;">
                <div style="width:4px; height:28px; background:linear-gradient(180deg,#2563eb,#1d4ed8); border-radius:4px;"></div>
                <h1 style="font-family:'Nunito',sans-serif; font-weight:900; font-size:1.3rem; color:var(--slate-800);">@yield('title','Dashboard')</h1>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:0.78rem; color:var(--slate-400); font-weight:600;">{{ now()->format('D, d M Y') }}</span>
                <span class="role-pill">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </header>

        <div style="padding:28px 32px; flex:1;">
            @if(session('success'))
            <div class="alert-success fade-1" style="margin-bottom:22px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span style="font-weight:600; font-size:0.875rem;">{{ session('success') }}</span>
            </div>
            @endif
            @if($errors->any())
            <div class="alert-error fade-1" style="margin-bottom:22px;">
                <ul style="list-style:disc; padding-left:18px; space-y:2px;">
                    @foreach($errors->all() as $e)<li style="font-size:0.875rem; font-weight:600;">{{ $e }}</li>@endforeach
                </ul>
            </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>