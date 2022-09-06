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
        $user_data = User::find(auth()->user()->id);
        if ($user->status == '') {
            Auth::logout();
            return redirect('/')->with('error', 'Please wait for admin approval');
        } else {
            return view('instructor_landing', [
                'user' => $user,
                'user_data' => $user_data,
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
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_course', [
            'course_type' => $course_type,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_course_process(Request $request)
    {
        //return $request->input();
        $course_image_template = $request->file('course_image_template');
        $course_image_template_name = 'course_image_template-' . time() . '.' . $course_image_template->getClientOriginalExtension();
        $course_image_template_type = $course_image_template->getClientMimeType();
        $path_course_image_template = $course_image_template->storeAs('public', $course_image_template_name);


        $new = new Course([
            'course_type_id' => $request->input('course_type'),
            'course_title' => $request->input('course_title'),
            'course_description' => $request->input('course_description'),
            'course_monitization' => $request->input('course_monitization'),
            'course_amount' => $request->input('course_amount'),
            'status' => 'Pending Approval',
            'user_id' => auth()->user()->id,
            'image_template' => $course_image_template_name,
        ]);

        $new->save();

        return redirect()->route('instructor_add_course_phase_2', ['course_id' => $new->id])->with('success', 'Successfully added new course. Please add files');
    }

    public function instructor_add_course_phase_2($course_id)
    {
        // $course = Course::find($course_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_course_phase_2', [
            'course_id' => $course_id,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_course_phase_2_process(Request $request)
    {
        //dd($request->all());

        $course_file = $request->file('course_file');
        $course_file_name = $course_file->getClientOriginalName();
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
        $course = Course::where('user_id', auth()->user()->id)->orderBy('id', 'Desc')->get();
        $user_data = User::find(auth()->user()->id);
        return view('instructor_courses', [
            'course' => $course,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_subject_file(Request $request)
    {

        $subject_file = $request->file('subject_file');
        //$subject_file_name = 'subject_file-' . time() . '.' . $subject_file->getClientOriginalExtension();
        $subject_file_name = $subject_file->getClientOriginalName();
        $subject_file_type = $subject_file->getClientMimeType();
        $path_subject_file = $subject_file->storeAs('public', $subject_file_name);

        $new_course_details = new Course_details([
            'file' => $subject_file_name,
            'course_id' => $request->input('course_id'),
            'file_type' => $subject_file_type,
        ]);

        $new_course_details->save();

        return redirect()->route('instructor_courses')->with('success', 'Successfully added new course_file');
    }

    public function instructor_profile_add_image(Request $request)
    {
        $user_image = $request->file('user_image');
        $user_image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $user_image_name);

        User::where('id', $request->input('user_id'))
            ->update([
                'user_image' => $user_image_name,
            ]);

        return redirect('instructor_profile')->with('success', 'Successfully approved selected instructor');
    }

    public function instructor_update_course(Request $request)
    {
        Course::where('id', $request->input('course_id'))
            ->update([
                'course_title' => $request->input('update_course_title'),
                'course_description' => $request->input('update_course_description'),
            ]);

        return redirect('instructor_courses')->with('success', 'Successfully approved selected course');
    }

    public function instructor_show_pdf_file($details_id)
    {
        $course_details = Course_details::find($details_id);
        return view('instructor_show_pdf_file',[
            'course_details' => $course_details,
        ]);
    }

    public function instructor_show_video($details_id)
    {
        $course_details = Course_details::find($details_id);
        return view('instructor_show_video',[
            'course_details' => $course_details,
        ]);
    }

    public function instructor_show_image($details_id)
    {
        $course_details = Course_details::find($details_id);
        return view('instructor_show_image',[
            'course_details' => $course_details,
        ]);
    }
}
