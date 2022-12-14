<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'number_of_exams',
        'course_chapter_id',
        // 'question_type',
        'certificate',
        'title',
        'status',
    ];

    public function exam_details()
    {
        return $this->hasMany('App\Models\Exam_details', 'exam_id')->inRandomOrder();
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function exam_question()
    {
        return $this->hasMany('App\Models\Exam_questions', 'course_exam_id');
    }

    public function student_exam_score()
    {
        return $this->hasOne('App\Models\Taken', 'exam_id')->where('student_id', auth()->user()->id);
    }
}
