<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\DirectMessageController;

Route::get('/', fn() => view('welcome'));

require __DIR__.'/auth.php';

Route::middleware('auth')
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// ── SHARED (both roles) ─────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    Route::get('/courses/{course}/chat',  [MessageController::class, 'index'])->name('messages.index');
    Route::post('/courses/{course}/chat', [MessageController::class, 'store'])->name('messages.store');

    // Direct Messages
    Route::get('/messages',          [DirectMessageController::class, 'inbox'])->name('dm.inbox');
    Route::get('/messages/{user}',   [DirectMessageController::class, 'chat'])->name('dm.chat');
    Route::post('/messages/{user}',  [DirectMessageController::class, 'send'])->name('dm.send');
});

// ── TUTOR ───────────────────────────────────────────────────
Route::middleware(['auth', 'role:tutor'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/lectures/create',       [LectureController::class, 'create'])->name('lectures.create');
    Route::post('courses/{course}/lectures',             [LectureController::class, 'store'])->name('lectures.store');
    Route::delete('courses/{course}/lectures/{lecture}', [LectureController::class, 'destroy'])->name('lectures.destroy');

    Route::resource('subjects', SubjectController::class);
    Route::get('/my-subjects',  [SubjectController::class, 'assignForm'])->name('subjects.assign.form');
    Route::post('/my-subjects', [SubjectController::class, 'assign'])->name('subjects.assign');

    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.status');
});

// ── STUDENT ─────────────────────────────────────────────────
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/browse-courses', [EnrollmentController::class, 'browse'])->name('courses.browse');
    Route::get('/enroll',         [EnrollmentController::class, 'browse'])->name('enroll.form');
    Route::post('/enroll',        [EnrollmentController::class, 'enroll'])->name('enroll');

    Route::get('/my-courses/{course}', [StudentCourseController::class, 'show'])->name('student.course.show');

    Route::get('/book-tutor',  [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/book-tutor', [BookingController::class, 'store'])->name('bookings.store');

    // Contact tutor → opens DM chat
    Route::get('/contact-tutor/{user}', [DirectMessageController::class, 'startWithTutor'])->name('dm.start');
});