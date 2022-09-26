<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_taken extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'instructor_id',
        'student_id',
        'course_chapter_id',
        'course_id',
        'score',
        'total_points',
        'remarks',
    ];
}
