<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_question_id',
        'question',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
    ];
}
