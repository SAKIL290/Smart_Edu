<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Education</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-white">

<!-- Navbar -->
<nav class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100 px-6 py-4">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                </svg>
            </div>
            <span class="font-black text-slate-900 text-xl tracking-tight">SmartEdu</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">Login</a>
            <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-semibold bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-md shadow-indigo-200">Get Started</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="pt-32 pb-20 px-6 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="max-w-4xl mx-auto text-center">
        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-bold px-4 py-1.5 rounded-full mb-6 tracking-widest uppercase">Learning Management System</span>
        <h1 class="text-5xl md:text-7xl font-black text-slate-900 mb-6 leading-tight">
            Learn Smarter.<br><span class="text-indigo-600">Teach Better.</span>
        </h1>
        <p class="text-xl text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
            A modern platform where tutors create courses, students enroll and learn, and 1-on-1 tutoring sessions are just one booking away.
        </p>
        <div class="flex gap-4 justify-center flex-wrap">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 text-lg">Start Learning Free</a>
            <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-2xl hover:bg-slate-50 transition border border-slate-200 text-lg">Sign In</a>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-24 px-6 bg-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-black text-center text-slate-900 mb-4">Everything You Need</h2>
        <p class="text-center text-slate-500 mb-16 text-lg">Built for students and tutors who want more.</p>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['📚','Course Creation','Tutors create beautifully organized courses with video lectures.','indigo'],
                ['🔑','Easy Enrollment','Students join courses instantly with unique enrollment keys.','purple'],
                ['💬','Group Chat','Every course gets its own chat room for real-time collaboration.','blue'],
                ['📅','1:1 Booking','Students book personal tutoring sessions with their favorite tutors.','emerald'],
                ['🎥','Video Lectures','Upload and organize lecture videos in a clean playlist view.','orange'],
                ['👤','Smart Profiles','Build your tutor profile and showcase your expertise.','pink'],
            ] as [$icon,$title,$desc,$color])
            <div class="p-8 rounded-3xl border border-slate-100 hover:border-{{ $color }}-200 hover:shadow-xl transition-all group">
                <div class="text-4xl mb-4">{{ $icon }}</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-{{ $color }}-600 transition">{{ $title }}</h3>
                <p class="text-slate-500 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 px-6 bg-indigo-600">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl font-black text-white mb-4">Ready to Start?</h2>
        <p class="text-indigo-200 mb-8 text-lg">Join hundreds of tutors and students already on SmartEdu.</p>
        <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-indigo-600 font-black rounded-2xl hover:bg-indigo-50 transition text-lg">Create Free Account</a>
    </div>
</section>

<footer class="py-8 text-center text-slate-400 text-sm border-t border-slate-100">
    © {{ date('Y') }} Smart Education. Built with Laravel & Tailwind CSS.
</footer>

</body>
</html>