<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite_student extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
        'instructor_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\User', 'instructor_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id','id');
    }
}
