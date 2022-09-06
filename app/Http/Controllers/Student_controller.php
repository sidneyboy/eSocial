<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class Student_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function student_landing()
    {
        // $user = User::find(auth()->user()->id);
        $tutorial = Tutorial::simplePaginate(1);

        return view('student_landing', [
            'tutorial' => $tutorial,
        ]);
    }

    public function student_course()
    {
        $course = Course::orderBy('id', 'Desc')->get();
        $user_data = User::find(auth()->user()->id);
        return view('student_course',[
            'user_data' => $user_data,
            'course' => $course,
        ]);
    }

    public function student_profile()
    {
        $user_data = User::find(auth()->user()->id);
        return view('student_profile', [
            'user_data' => $user_data,
        ]);
    }

    public function student_profile_add_image(Request $request)
    {
        $user_image = $request->file('user_image');
        $user_image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $user_image_name);

        User::where('id', $request->input('user_id'))
            ->update([
                'user_image' => $user_image_name,
            ]);

        return redirect('student_profile')->with('success', 'Successfully approved selected student');
    }

    public function student_search_course(Request $request)
    {
        $search = $request->input('search_box');
        $course_search = Course::where('course_title', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();

        $user_data = User::find(auth()->user()->id);
        return view('student_search_course',[
            'course_search' => $course_search,
            'user_data' => $user_data,
        ]);
    }
}
