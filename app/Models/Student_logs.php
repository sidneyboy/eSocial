<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'course_id',
        'course_chapter_id',
        'assignment_id',
        'quiz_id',
        'exam_id',
        'course_details_id',
        'student_id',
        'content',
        'date',
    ];
}
