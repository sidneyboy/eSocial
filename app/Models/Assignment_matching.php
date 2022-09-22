<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_matching extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_question_id',
        'choices',
    ];
}
