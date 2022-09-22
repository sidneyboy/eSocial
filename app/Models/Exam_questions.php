<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_questions extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'course_id',
        'course_chapter_id',
        'course_assignment_id',
        'course_exam_id',
        'question',
        'answer',
        'question_type',
        'score',
    ];

    public function exam_details()
    {
        return $this->hasOne('App\Models\Exam_details', 'exam_question_id');
    }

    public function exam_matching()
    {
        return $this->hasMany('App\Models\Exam_matching', 'exam_question_id');
    }
}
