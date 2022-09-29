<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_chapter_id',
        'quiz_title',
        'number_of_questions',
        'status',
    ];

    public function quiz_question()
    {
        return $this->hasMany('App\Models\Quiz_questions', 'course_quiz_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function student_quiz_score()
    {
        return $this->hasOne('App\Models\Taken', 'quiz_id')->where('student_id',auth()->user()->id);
    }

   
}
