<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taken_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'taken_id',
        'question_id',
        'question_answer',
        'student_answer',
        'remarks',
        'score',
        'status',
        'type',
        'student_id',
        'question_type',
    ];
}
