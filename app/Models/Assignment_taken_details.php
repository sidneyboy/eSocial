<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_taken_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_taken_id',
        'assignment_question_id',
        'student_answer',
        'remarks',
    ];
}
