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
        'title',
    ];

    public function exam_details()
    {
        return $this->hasMany('App\Models\Exam_details', 'exam_id')->inRandomOrder();
    }
}
