<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'course_type_id',
        'course_title',
        'course_description',
        'course_monitization',
        'course_amount',
        'user_id',
        'status',
        'image_template',
    ];

    public function course_type()
    {
        return $this->belongsTo('App\Models\Course_type', 'course_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function course_details()
    {
        return $this->hasMany('App\Models\Course_details', 'course_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'course_id');
    }

    public function comments_count()
    {
        return $this->hasMany('App\Models\Comments', 'course_id')->where('status','!=','replied');
    }

}
