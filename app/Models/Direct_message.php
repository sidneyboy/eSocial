<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direct_message extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'instructor_id',
        'status',
        'file',
        'file_type',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\User', 'instructor_id','id');
    }


}
