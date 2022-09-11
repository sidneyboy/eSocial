<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Course_details;
use App\Models\Tutorial;
use App\Models\Comments;
use App\Models\direct_message;
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
        return view('student_course', [
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
        return view('student_search_course', [
            'course_search' => $course_search,
            'user_data' => $user_data,
        ]);
    }

    public function student_comment_process(Request $request)
    {
        //return auth()->user()->id;
        // return $request->input();
        $new_comment = new Comments([
            'course_id' => $request->input('course_id'),
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
        ]);

        $new_comment->save();

        return redirect('student_course')->with('success', 'Successfully add new comment');
    }

    public function student_show_image_file($course_id)
    {
        $search = 'image';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->get();

        return view('student_show_image_file', [
            'course_data' => $course_data
        ]);
    }

    public function student_show_pdf_file($course_id)
    {
        $search = 'application';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);

        return view('student_show_pdf_file', [
            'course_data' => $course_data,
        ]);
    }

    public function student_show_video($course_id)
    {
        $search = 'video';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);

        return view('student_show_video', [
            'course_data' => $course_data,
        ]);
    }

    public function student_message_process(Request $request)
    {
        //dd($request->all());
        if ($request->file('message_file')) {
            $message_file = $request->file('message_file');
            $message_file_name = $message_file->getClientOriginalName();
            $message_file_type = $message_file->getClientMimeType();
            $path_message_file = $message_file->storeAs('public', $message_file_name);

            $new_message = new Direct_message([
                'comment' => $request->input('comment'),
                'user_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'file' => $message_file_name,
                'file_type' => $message_file_type,
            ]);

            $new_message->save();
        } else {
            $new_message = new Direct_message([
                'comment' => $request->input('comment'),
                'user_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'user_type' => 'Student',
            ]);

            $new_message->save();
        }

        return redirect('student_course')->with('success', 'Message sent');
    }

    public function student_direct_message()
    {
        $user_data = User::find(auth()->user()->id);
        $instructors = User::where('user_type', 'Instructor')->get();
        foreach ($instructors as $key => $data) {
            $id[] = $data->id;
        }
        $message = Direct_message::whereIn('instructor_id', $id)->where('user_id', auth()->user()->id)->get();



        return view('student_direct_message',[
            'user_data' => $user_data,
            'instructors' => $instructors,
            'message' => $message,
        ]);
    }
}
