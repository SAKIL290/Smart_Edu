<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
        'phone', 'bio', 'profile_image'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function isStudent(): bool { return $this->role === 'student'; }
    public function isTutor(): bool  { return $this->role === 'tutor'; }

    // Tutor relationships
    public function courses() { return $this->hasMany(Course::class); }
    public function subjects() { return $this->belongsToMany(Subject::class, 'subject_tutor'); }
    public function bookingsAsTutor() { return $this->hasMany(Booking::class, 'tutor_id'); }

    // Student relationships
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function enrolledCourses() { return $this->belongsToMany(Course::class, 'enrollments'); }
    public function bookingsAsStudent() { return $this->hasMany(Booking::class, 'student_id'); }

    // Shared
    public function messages() { return $this->hasMany(Message::class); }
}