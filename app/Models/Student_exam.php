<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
        'exam_id',
        'instructor_id',
        'student_exam_percentage',
        'remarks',
    ];
}
