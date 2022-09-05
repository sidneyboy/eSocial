<?php

namespace App\Http\Controllers;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class Student_controller extends Controller
{
    public function student_landing()
    {
        // $user = User::find(auth()->user()->id);
        $tutorial = Tutorial::simplePaginate(1);
        return view('student_landing',[
            'tutorial' => $tutorial,
        ]);
    }

    public function student_course()
    {
        return view('student_course');
    }
}
