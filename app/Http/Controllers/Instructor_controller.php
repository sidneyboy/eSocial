<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course_type;
use App\Models\Course;
use App\Models\Course_details;

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
        return view('instructor_profile', [
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_course()
    {
        $course_type = Course_type::get();
        return view('instructor_add_course', [
            'course_type' => $course_type,
        ]);
    }

    public function instructor_add_course_process(Request $request)
    {
        //return $request->input();
        $new = new Course([
            'course_type_id' => $request->input('course_type'),
            'course_title' => $request->input('course_title'),
            'course_description' => $request->input('course_description'),
            'course_monitization' => $request->input('course_monitization'),
            'course_amount' => $request->input('course_amount'),
            'status' => 'Pending Approval',
            'user_id' => auth()->user()->id,
        ]);

        $new->save();

        return redirect()->route('instructor_add_course_phase_2', ['course_id' => $new->id])->with('success', 'Successfully added new course. Please add files');
    }

    public function instructor_add_course_phase_2($course_id)
    {
        // $course = Course::find($course_id);
        return view('instructor_add_course_phase_2', [
            'course_id' => $course_id,
        ]);
    }

    public function instructor_add_course_phase_2_process(Request $request)
    {
        //dd($request->all());

        $course_file = $request->file('course_file');
        $course_file_name = 'course_file-' . time() . '.' . $course_file->getClientOriginalExtension();
        $course_file_type = $course_file->getClientMimeType();
        $path_course_file = $course_file->storeAs('public', $course_file_name);

        $new_course_details = new Course_details([
            'file' => $course_file_name,
            'course_id' => $request->input('course_id'),
            'file_type' => $course_file_type,
        ]);

        $new_course_details->save();

        return redirect()->route('instructor_add_course')->with('success', 'Successfully added course_file');
    }

    public function instructor_courses()
    {
        $course = Course::where('user_id',auth()->user()->id)->get();
        return view('instructor_courses',[
            'course' => $course,
        ]);
    }
}
