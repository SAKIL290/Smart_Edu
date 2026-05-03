<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = ['student_id', 'tutor_id', 'subject_id', 'session_time', 'status', 'notes'];
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function tutor() { return $this->belongsTo(User::class, 'tutor_id'); }
    public function subject() { return $this->belongsTo(Subject::class); }
}