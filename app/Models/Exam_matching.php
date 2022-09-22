<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_matching extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_question_id',
        'choices',
    ];
}
