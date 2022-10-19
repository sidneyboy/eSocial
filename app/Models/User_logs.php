<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
