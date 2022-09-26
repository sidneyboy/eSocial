<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taken extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'quiz_id',
        'assignment_id',
        'instructor_id',
        'student_id',
        'course_chapter_id',
        'course_id',
        'score',
        'total_points',
        'type',
        'remarks',
        'date',
    ];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam', 'exam_id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function course_chapter()
    {
        return $this->belongsTo('App\Models\Course_chapter', 'course_chapter_id');
    }


    public function taken_details()
    {
        return $this->hasMany('App\Models\Taken_details', 'taken_id');
    }
}
