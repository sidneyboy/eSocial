<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question',
        'choice_a',
        'choice_b',
        'choice_c',
        'choice_d',
        'file',
        'file_type',
        'answer',
    ];
}
