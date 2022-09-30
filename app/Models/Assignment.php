<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'number_of_questions',
        'course_chapter_id',
        'deadline',
        'title',
        'status',
    ];

    public function assignment_details()
    {
        return $this->hasMany('App\Models\Assignment_details', 'assignment_question_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function assignment_question()
    {
        return $this->hasMany('App\Models\Assignment_questions', 'course_assignment_id');
    }

    public function student_assignment_score()
    {
        return $this->hasOne('App\Models\Taken', 'assignment_id')->where('student_id',auth()->user()->id);
    }
}
