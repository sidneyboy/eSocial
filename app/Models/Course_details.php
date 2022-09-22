<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'course_id',
        'file_type',
        'course_chapter_id',
        'status',
    ];
}
