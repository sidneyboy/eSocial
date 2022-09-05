<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Instructor_controller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function instructor_profile()
    {
        $user_data = User::find(auth()->user()->id);
        return view('instructor_profile',[
            'user_data' => $user_data,
        ]);
    }

    
}
