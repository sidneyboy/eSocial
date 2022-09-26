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

    public function taken_details()
    {
        return $this->hasMany('App\Models\Taken_details', 'taken_id');
    }
}
