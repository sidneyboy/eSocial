<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
        'instructor_id',
        'amount',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\User', 'instructor_id');
    }
}
