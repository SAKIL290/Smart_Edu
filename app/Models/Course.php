<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model {
    protected $fillable = ['user_id', 'title', 'description', 'thumbnail', 'enrollment_key'];

    protected static function boot() {
        parent::boot();
        static::creating(function ($course) {
            if (empty($course->enrollment_key)) {
                $course->enrollment_key = strtoupper(Str::random(8));
            }
        });
    }

    public function tutor() { return $this->belongsTo(User::class, 'user_id'); }
    public function lectures() { return $this->hasMany(Lecture::class)->orderBy('order'); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function students() { return $this->belongsToMany(User::class, 'enrollments'); }
    public function messages() { return $this->hasMany(Message::class)->orderBy('created_at'); }
}