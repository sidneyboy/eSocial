<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_matching extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_question_id',
        'choices',
    ];
}
