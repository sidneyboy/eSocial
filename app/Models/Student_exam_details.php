<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_exam_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_exam_id',
        'question',
        'question_answer',
        'student_answer',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
        'remarks',
        'status',
    ];
}
