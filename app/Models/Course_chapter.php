<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'chapter_number',
        'thumbnail',
    ];

    public function course_details()
    {
        return $this->hasMany('App\Models\Course_details', 'course_chapter_id');
    }

    public function exam()
    {
        return $this->hasMany('App\Models\Exam', 'course_chapter_id');
    }

    public function course_quiz()
    {
        return $this->hasMany('App\Models\Course_quiz', 'course_chapter_id');
    }
}
