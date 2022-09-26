<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_assignment_id',
        'question',
        'answer',
        'course_chapter_id',
        'question_type',
        'score',
    ];

    public function assignment_details()
    {
        return $this->hasOne('App\Models\Assignment_details', 'assignment_question_id');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'course_assignment_id');
    }


    public function assignment_matching()
    {
        return $this->hasMany('App\Models\Assignment_matching', 'assignment_question_id');
    }
}
