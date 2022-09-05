<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Instructor_controller extends Controller
{
    public function instructor_landing()
    {
        $user = User::find(auth()->user()->id);
        if ($user->status == '') {
            return redirect('auth.login')->with('error', 'Please wait for admin approval');
        } else {
            return view('instructor_landing', [
                'user' => $user,
            ]);
        }
    }
}
