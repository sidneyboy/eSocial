<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_quiz_id',
        'course_chapter_id',
        'question',
        'answer',
        'question_type',
    ];

    public function quiz_details()
    {
        return $this->hasOne('App\Models\Quiz_details', 'quiz_question_id');
    }

    public function quiz_matching()
    {
        return $this->hasMany('App\Models\Quiz_matching', 'quiz_question_id');
    }
}
