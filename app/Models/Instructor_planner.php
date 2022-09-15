<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor_planner extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'instructor_id',
        'todo',
    ];
}
