<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model {
    protected $fillable = ['course_id', 'title', 'video_path', 'description', 'order'];
    public function course() { return $this->belongsTo(Course::class); }
}