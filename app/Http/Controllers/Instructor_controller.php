<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Instructor_controller extends Controller
{
    public function instructor_landing()
    {
        $user = User::find(auth()->user()->id);
        if ($user->status == '') {
            Auth::logout();
            return redirect('/')->with('error', 'Please wait for admin approval');
        } else {
            return view('instructor_landing', [
                'user' => $user,
            ]);
        }
    }

    public function approved_instructor()
    {
        $instructor = User::where('user_type','Instructor')->get();
        return view('approved_instructor',[
            'instructor' => $instructor
        ]);
    }
}
