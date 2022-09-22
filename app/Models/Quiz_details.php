<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_question_id',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
    ];
}
