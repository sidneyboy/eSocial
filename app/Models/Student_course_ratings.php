<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_course_ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'instructor_id',
        'rating',
    ];
}
