<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Course_details;
use App\Models\Tutorial;
use App\Models\Comments;
use App\Models\Direct_message;
use App\Models\Enrolled_course;
use App\Models\Exam;
use App\Models\Exam_details;
use App\Models\Student_exam;
use App\Models\Student_exam_details;
use App\Models\Invite_student;
use App\Models\Instructor_planner;
use App\Models\Student_logs;
use App\Models\Course_chapter;
use App\Models\Course_quiz;
use App\Models\Quiz_questions;
use App\Models\Quiz_details;
use App\Models\Exam_questions;
use App\Models\Exam_matching;
use App\Models\Assignment_taken;
use App\Models\Assignment_taken_details;
use App\Models\Assignment;
use App\Models\Assignment_questions;
use App\Models\Assignment_details;
use App\Models\Assignment_matching;
use App\Models\Quiz_matching;


use App\Models\Taken;
use App\Models\Taken_details;

// use Illuminate\Http\Response;

use Illuminate\Support\Facades\Response;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Student_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function student_landing()
    {
        $user = User::find(auth()->user()->id);

        if ($user->status == "Suspended") {
            Auth::logout();
            return redirect()->back()->with('error', 'Cannot login. You are currently suspended');
        } else {
            $tutorial = Tutorial::simplePaginate(1);
            return view('student_landing', [
                'tutorial' => $tutorial,
            ]);
        }
    }

    public function student_course()
    {
        $enrolled_data = Enrolled_course::where('student_id', auth()->user()->id)->get();
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();


        if (count($enrolled_data) != 0) {
            foreach ($enrolled_data as $key => $data) {
                $id[] = $data->course_id;
            }
            $course = Course::whereNotIn('id', $id)->orderBy('id', 'Desc')->where('status', 'Approved')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_course', [
                'user_data' => $user_data,
                'course' => $course,
                'count' => $count,
            ]);
        } else {
            $course = Course::orderBy('id', 'Desc')->where('status', 'Approved')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_course', [
                'user_data' => $user_data,
                'course' => $course,
                'count' => $count,
            ]);
        }
    }

    public function student_profile()
    {
        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
        $certificate = Student_exam::where('remarks', '!=', 'fail')->where('student_id', auth()->user()->id)->count();
        $courses = Enrolled_course::where('student_id', auth()->user()->id)->count();
        return view('student_profile', [
            'user_data' => $user_data,
            'certificate' => $certificate,
            'courses' => $courses,
            'count' => $count,
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

        return redirect('student_update')->with('success', 'Successfully updated your profile');
    }

    public function student_search_course(Request $request)
    {
        $enrolled_data = Enrolled_course::where('student_id', auth()->user()->id)->get();

        if (count($enrolled_data) != 0) {
            foreach ($enrolled_data as $key => $data) {
                $id[] = $data->course_id;
            }

            $search = $request->input('search_box');
            $course = Course::whereNotIn('id', $id)->where('course_title', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();

            $user_data = User::find(auth()->user()->id);
            $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

            return view('student_search_course', [
                'course' => $course,
                'user_data' => $user_data,
                'count' => $count,
            ]);

            // $course = Course::whereNotIn('id', $id)->orderBy('id', 'Desc')->get();
            // $user_data = User::find(auth()->user()->id);
            // return view('student_course', [
            //     'user_data' => $user_data,
            //     'course' => $course,
            //     'count' => $count,
            // ]);
        } else {
            $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

            $course = Course::orderBy('id', 'Desc')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_search_course', [
                'user_data' => $user_data,
                'course' => $course,
                'count' => $count,
            ]);
        }
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

        return redirect('student_enrolled_courses')->with('success', 'Successfully add new comment');
    }

    public function student_show_image_file($course_details_id, $course_id, $course_chapter_id)
    {
        //return $course_chapter_id;
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i a');
        $day = date('l');

        $date_time = date('Y-m-d H:i:s');

        $course_data = Course_details::find($course_details_id);
        $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();
        if ($check_student_log) {
            Student_logs::where('id', $check_student_log->id)
                ->update([
                    'content' => $check_student_log->content . "<br />" . 'view image file ' . $course_data->file,
                ]);
        } else {
            $new_student_log = new Student_logs([
                'content' => 'view image file ' . $course_data->file,
                'course_id' => $course_id,
                'course_chapter_id' => $course_chapter_id,
                'course_details_id' => $course_details_id,
                'created_at' => $date_time,
                'student_id' => auth()->user()->id,
                'date' => $date,
            ]);
            $new_student_log->save();
        }

        // if ($day == 'Monday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'monday' => $check_student_log->monday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'monday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Tuesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'tuesday' => $check_student_log->tuesday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'tuesday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Wednesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'wednesday' => $check_student_log->wednesday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'wednesday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Thursday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'thursday' => $check_student_log->thursday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'thursday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Friday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'friday' => $check_student_log->friday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'friday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Saturday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'saturday' => $check_student_log->saturday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'saturday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Sunday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'sunday' => $check_student_log->sunday . "<br />" . 'view image file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'sunday' => 'view image file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // }

        $course_data = Course_details::find($course_details_id);
        return view('student_show_image_file', [
            'course_data' => $course_data,
        ]);
    }

    public function student_show_pdf_file($course_details_id, $course_id)
    {
        // return 'asdasdasd';
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i a');
        $day = date('l');

        $date_time = date('Y-m-d H:i:s');


        $course_data = Course_details::find($course_details_id);

        $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        if ($check_student_log) {
            Student_logs::where('id', $check_student_log->id)
                ->update([
                    'monday' => $check_student_log->monday . "<br />" . 'view document file ' . $course_data->file,
                ]);
        } else {
            $new_student_log = new Student_logs([
                'monday' => 'view document file ' . $course_data->file,
                'course_id' => $course_id,
                'course_chapter_id' => $course_data->course_chapter_id,
                'course_details_id' => $course_details_id,
                'created_at' => $date_time,
                'student_id' => auth()->user()->id,
                'date' => $date,
            ]);
            $new_student_log->save();
        }

        // if ($day == 'Monday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'monday' => $check_student_log->monday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'monday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Tuesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'tuesday' => $check_student_log->tuesday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'tuesday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Wednesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'wednesday' => $check_student_log->wednesday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'wednesday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Thursday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'thursday' => $check_student_log->thursday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'thursday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Friday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'friday' => $check_student_log->friday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'friday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Saturday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'saturday' => $check_student_log->saturday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'saturday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Sunday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'sunday' => $check_student_log->sunday . "<br />" . 'view document file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'sunday' => 'view document file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_data->course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // }

        $file = public_path() . "/storage/" . $course_data->file;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $course_data->file, $headers);
    }

    public function student_show_video($course_details_id, $course_id, $course_chapter_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i a');
        $day = date('l');

        $date_time = date('Y-m-d H:i:s');

        $course_data = Course_details::find($course_details_id);

        $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        if ($check_student_log) {
            Student_logs::where('id', $check_student_log->id)
                ->update([
                    'content' => $check_student_log->content . "<br />" . 'view video file ' . $course_data->file,
                ]);
        } else {
            $new_student_log = new Student_logs([
                'content' => 'view video file ' . $course_data->file,
                'course_id' => $course_id,
                'course_chapter_id' => $course_chapter_id,
                'course_details_id' => $course_details_id,
                'created_at' => $date_time,
                'student_id' => auth()->user()->id,
                'date' => $date,
            ]);
            $new_student_log->save();
        }

        // if ($day == 'Monday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'monday' => $check_student_log->monday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'monday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Tuesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'tuesday' => $check_student_log->tuesday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'tuesday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Wednesday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'wednesday' => $check_student_log->wednesday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'wednesday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Thursday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'thursday' => $check_student_log->thursday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'thursday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Friday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'friday' => $check_student_log->friday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'friday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Saturday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'saturday' => $check_student_log->saturday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'saturday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // } else if ($day == 'Sunday') {
        //     $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

        //     if ($check_student_log) {
        //         Student_logs::where('id', $check_student_log->id)
        //             ->update([
        //                 'sunday' => $check_student_log->sunday . "<br />" . 'view video file ' . $course_data->file,
        //             ]);
        //     } else {
        //         $new_student_log = new Student_logs([
        //             'sunday' => 'view video file ' . $course_data->file,
        //             'course_id' => $course_id,
        //             'course_chapter_id' => $course_chapter_id,
        //             'course_details_id' => $course_details_id,
        //             'created_at' => $date_time,
        //             'student_id' => auth()->user()->id,
        //         ]);
        //         $new_student_log->save();
        //     }
        // }

        return view('student_show_video', [
            'course_data' => $course_data,
        ]);
    }

    public function student_message_process(Request $request)
    {
        //dd($request->all());

        $dm_id = $request->input('dm_id');
        if (isset($dm_id)) {
            foreach ($request->input('dm_id') as $key => $dm_id) {
                Direct_message::where('id', $dm_id)
                    ->update(['status' => 'replied']);
            }
        }

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
                'user_typer' => 'Student',
            ]);

            $new_message->save();
        } else {
            $new_message = new Direct_message([
                'comment' => $request->input('comment'),
                'user_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'user_typer' => 'Student',
            ]);

            $new_message->save();
        }

        return redirect('student_direct_message')->with('success', 'Message sent');
    }

    public function student_direct_message()
    {
        $user_data = User::find(auth()->user()->id);
        $instructors = User::where('user_type', 'Instructor')->get();
        foreach ($instructors as $key => $data) {
            $id[] = $data->id;
            $count_message[$data->id] = Direct_message::where('instructor_id', $data->id)
                ->where('status', null)
                ->where('user_typer', 'Instructor')
                ->where('user_id', auth()->user()->id)
                ->count();
        }




        $message = Direct_message::whereIn('instructor_id', $id)->where('user_id', auth()->user()->id)->get();
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();


        return view('student_direct_message', [
            'user_data' => $user_data,
            'count' => $count,
            'instructors' => $instructors,
            'message' => $message,
            'count_message' => $count_message,
        ]);
    }

    public function student_show_exam($course_id)
    {
        $passed_exam = Student_exam::where('course_id', $course_id)
            ->where('student_id', auth()->user()->id)
            ->where('remarks', 'passed')
            ->get();

        if (count($passed_exam) != 0) {
            foreach ($passed_exam as $key => $data) {
                $exam_id[] = $data->id;
            }

            $exam_data = Exam::whereNotIn('id', $exam_id)->where('course_id', $course_id)->get();
            return view('student_show_exam', [
                'exam_data' => $exam_data,
            ]);
        } else {
            $exam_data = Exam::where('course_id', $course_id)->get();
            return view('student_show_exam', [
                'exam_data' => $exam_data,
            ]);
        }
    }

    public function student_exam_process(Request $request)
    {
        return $request->input();
    }

    public function student_enroll_course(Request $request)
    {

        $invitation_id = $request->input('invitation_id');
        if (isset($invitation_id)) {
            Invite_student::where('id', $invitation_id)
                ->update(['status' => 'Accepted']);

            $new_enrolled = new Enrolled_course([
                'course_id' => $request->input('course_id'),
                'student_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'amount' => 0,
                'course_type' => 'Free',
            ]);

            $new_enrolled->save();

            return redirect('student_course')->with('success', 'Successfully enrolled');
        } else {
            $new_enrolled = new Enrolled_course([
                'course_id' => $request->input('course_id'),
                'student_id' => auth()->user()->id,
                'instructor_id' => $request->input('instructor_id'),
                'amount' => 0,
                'course_type' => 'Free',
            ]);

            $new_enrolled->save();

            return redirect('student_course')->with('success', 'Successfully enrolled');
        }
    }

    public function student_enrolled_courses()
    {
        $enrolled_data = Enrolled_course::where('student_id', auth()->user()->id)->get();

        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

        if (count($enrolled_data) != 0) {
            foreach ($enrolled_data as $key => $data) {
                $id[] = $data->course_id;
            }
            $course = Course::whereIn('id', $id)->orderBy('id', 'Desc')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_enrolled_courses', [
                'user_data' => $user_data,
                'course' => $course,
                'count' => $count,
            ]);
        } else {
            // $course = Course::orderBy('id', 'Desc')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_enrolled_courses', [
                'user_data' => $user_data,
                'count' => $count,
                // 'course' => $course,
            ]);
        }
    }

    public function student_enrolled_search_course(Request $request)
    {
        $search = $request->input('search_box');
        $course_search = Course::where('course_title', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();

        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
        return view('student_enrolled_search_course', [
            'course_search' => $course_search,
            'user_data' => $user_data,
            'count' => $count,
        ]);
    }

    public function student_answer_exam(Request $request, $exam_id, $instructor_id, $course_id)
    {
        $exam_id . " - " . $instructor_id . " - " . $course_id;
        $new_student_exam = new Student_exam([
            'course_id' => $course_id,
            'student_id' => auth()->user()->id,
            'exam_id' => $exam_id,
            'instructor_id' => $instructor_id,
        ]);

        $new_student_exam->save();

        $get_exam_details = Exam_details::where('exam_id', $exam_id)->get();


        foreach ($get_exam_details as $key => $data) {
            $new_student_exam_details = new Student_exam_details([
                'student_exam_id' => $new_student_exam->id,
                'question' => $data->question,
                'question_answer' => $data->answer,
                'choice_a' => $data->choice_a,
                'choice_b' => $data->choice_b,
                'choice_c' => $data->choice_c,
                'choice_d' => $data->choice_d,
            ]);

            $new_student_exam_details->save();
        }

        return redirect()->route('student_answer_exam_proceed', ['student_exam_id' => $new_student_exam->id]);
    }

    public function student_answer_exam_proceed($student_exam_id)
    {
        $exam_details = Student_exam_details::where('student_exam_id', $student_exam_id)->paginate(1);
        return view('student_answer_exam', [
            'exam_details' => $exam_details,
        ]);
    }

    public function student_taken_process(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        if ($request->input('type') == 'assignment') {
            $assignment_question = Assignment_questions::find($request->input('question_id'));
            $check = Taken::find($request->input('taken_id'));
            if ($request->input('question_type') == 'Enumeration') {

                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Multitple Choice') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Identification') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Matching Type') {
                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            }
        } else if ($request->input('type') == 'quiz') {
            $assignment_question = Quiz_questions::find($request->input('question_id'));
            $check = Taken::find($request->input('taken_id'));
            if ($request->input('question_type') == 'Enumeration') {

                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Multitple Choice') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Identification') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Matching Type') {
                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            }
        } else if ($request->input('type') == 'exam') {
            $assignment_question = Exam_questions::find($request->input('question_id'));
            $check = Taken::find($request->input('taken_id'));
            if ($request->input('question_type') == 'Enumeration') {

                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Multitple Choice') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Identification') {
                if ($request->input('question_answer') == strtolower($request->input('student_answer'))) {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => strtolower($request->input('student_answer')),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            } else if ($request->input('question_type') == 'Matching Type') {
                //return $request->input();
                $question_answer = explode('|', $request->input('question_answer'));
                $student_answer = explode(',', strtolower($request->input('student_answer')));
                // Sort the array elements
                sort($question_answer);
                sort($student_answer);
                // Check for equality
                if ($question_answer == $student_answer) {
                    //echo "Both arrays are same\n";
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => $request->input('student_answer'),
                        'remarks' => 'checked',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();

                    Taken::where('id', $check->id)
                        ->update([
                            'score' => $check->score + $assignment_question->score,
                            'remarks' => 'unfinished',
                        ]);
                } else {
                    $taken_details = new Taken_details([
                        'taken_id' => $check->id,
                        'question_id' => $request->input('question_id'),
                        'question_answer' => $request->input('question_answer'),
                        'student_answer' => $request->input('student_answer'),
                        'remarks' => 'wrong',
                        'score' => $assignment_question->score,
                        'status' => 'answered',
                        'type' => $request->input('type'),
                        'student_id' => auth()->user()->id,
                        'question_type' => $request->input('question_type'),
                    ]);

                    $taken_details->save();
                }
            }
        }









































































































        // if ($request->input('student_answer') == $request->input('answer')) {
        //     $remarks = 'Checked';
        // } else {
        //     $remarks = 'Wrong';
        // }

        // Student_exam_details::where('id', $request->input('student_exam_details_id'))
        //     ->update([
        //         'status' => 'answered',
        //         'student_answer' => $request->input('student_answer'),
        //         'remarks' => $remarks,
        //     ]);
    }

    public function student_answer_exam_finalized($student_exam_id)
    {
        //return $student_exam_id;

        $student_exam_item_count = Student_exam_details::where('student_exam_id', $student_exam_id)->count();
        $student_item_check_count = Student_exam_details::where('student_exam_id', $student_exam_id)->where('remarks', 'Checked')->count();
        $student_item_wrong_count = Student_exam_details::where('student_exam_id', $student_exam_id)->where('remarks', 'Wrong')->count();

        $student_percentage = ($student_item_check_count / $student_exam_item_count) * 100;

        if ($student_percentage >= 80) {
            student_exam::where('id', $student_exam_id)
                ->update([
                    'remarks' => 'passed',
                    'student_exam_percentage' => $student_percentage,
                ]);

            return redirect('student_enrolled_courses')->with('success', 'You have successfully passed the exam. please check your certificates. Thank you');
        } else {
            student_exam::where('id', $student_exam_id)
                ->update([
                    'remarks' => 'fail',
                    'student_exam_percentage' => $student_percentage,
                ]);

            return redirect('student_enrolled_courses')->with('error', 'Sorry, you have failed the exam. you can always retake the exam.');
        }
    }

    public function student_show_certificate()
    {
        $student_exam = Student_exam::where('remarks', '!=', 'fail')->where('student_id', auth()->user()->id)->get();
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

        if (count($student_exam) != 0) {
            foreach ($student_exam as $key => $data) {
                $exam_id[] = $data->exam_id;
            }
            $user_data = User::find(auth()->user()->id);
            $exam = Exam::whereIn('id', $exam_id)->get();

            return view('student_show_certificate', [
                'exam' => $exam,
                'user_data' => $user_data,
                'count' => $count,
            ]);
        } else {
            $user_data = User::find(auth()->user()->id);
            return view('student_show_no_certificate', [
                'user_data' => $user_data,
                'count' => $count,
            ]);
        }
    }

    public function student_instructor_invitation()
    {
        $invitation = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->orderBy('id', 'desc')->get();

        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
        return view('student_instructor_invitation', [
            'user_data' => $user_data,
            'invitation' => $invitation,
            'count' => $count,
        ]);
    }

    public function student_to_do()
    {
        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
        return view('student_to_do', [
            'user_data' => $user_data,
            'count' => $count,
        ]);
    }

    public function student_todo_process(Request $request)
    {
        $new = new Instructor_planner([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'instructor_id' => auth()->user()->id,
            'todo' => $request->input('todo'),
        ]);

        $new->save();

        return redirect()->route('student_to_do')->with('success', 'Successfully added new plan');
    }

    public function student_to_do_list()
    {

        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
        $todo = Instructor_planner::where('instructor_id', auth()->user()->id)->where('status', null)->orderBy('date')->get();
        return view('student_to_do_list', [
            'user_data' => $user_data,
            'count' => $count,
            'todo' => $todo,
        ]);
    }

    public function student_planner_prompt(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        return $planner = Instructor_planner::where('instructor_id', auth()->user()->id)
            ->where('date', $date)
            ->where('status', null)
            ->count();
    }


    public function student_planner_approved($planner_id)
    {
        Instructor_planner::where('id', $planner_id)
            ->update(['status' => 'approved']);

        return redirect()->route('student_to_do_list')->with('success', 'Planner Acknowledge');
    }

    public function student_show_course_chapter($course_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i a');

        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

        $student_exam = Student_exam::where('course_id', $course_id)
            ->where('student_id', auth()->user()->id)
            ->where('remarks', '!=', 'fail')
            ->first();

        if ($student_exam) {
            $course_chapter = Course_chapter::where('id', '>', $student_exam->course_chapter_id)
                ->orderBy('id')
                ->get();
            return view('student_show_course_chapter', [
                'user_data' => $user_data,
                'count' => $count,
                'course_chapter' => $course_chapter,
                'date' => $date,
            ]);
        } else {
            $course_chapter = Course_chapter::where('course_id', $course_id)->take(1)->get();
            return view('student_show_course_chapter', [
                'user_data' => $user_data,
                'count' => $count,
                'course_chapter' => $course_chapter,
                'date' => $date,
            ]);
        }
    }

    public function student_show_taken($id, $type)
    {
        //return $id;
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        if ($type == 'assignment') {
            $assignment = Assignment::find($id);
            $check_if_taken = Taken::where('assignment_id', $id)->where('student_id', auth()->user()->id)->where('remarks', 'pass')->orWhere('remarks', 'failed')->where('type', 'assignment')->first();
            if ($check_if_taken) {
                return redirect()->route('student_show_course_chapter', ['course_id' => $check_if_taken->course_id])->with('error', 'Cannot take assignment anymore');
            } else {
                $user_data = User::find(auth()->user()->id);
                $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
                $assignment_question = Assignment_questions::where('course_assignment_id', $id)->paginate(1);
                foreach ($assignment_question as $key => $data) {
                    $taken_details = Taken_details::where('question_id', $data->id)
                        ->where('student_id', auth()->user()->id)
                        ->first();
                    if ($taken_details) {
                        $status = $taken_details->status;
                    } else {
                        $status = 'wala';
                    }
                }
                $check_taken_table = Taken::where('assignment_id', $id)->where('student_id', auth()->user()->id)->first();

                if ($check_taken_table) {
                    if ($assignment->deadline >= $date) {
                        return view('student_show_taken_page', [
                            'assignment_question' => $assignment_question,
                            'count' => $count,
                            'user_data' => $user_data,
                            'type' => $type,
                            'status' => $status,
                            'taken_id' => $check_taken_table->id,
                        ]);
                    } else {
                        return redirect()->route('student_show_course_chapter', ['course_id' => $assignment->course_id])->with('error', 'Assignment due date lapse, Cannot Take.');
                    }
                } else {
                    $new = new Taken([
                        'assignment_id' => $assignment->id,
                        'instructor_id' => $assignment->course->user_id,
                        'student_id' => auth()->user()->id,
                        'course_chapter_id' => $assignment->course_chapter_id,
                        'course_id' => $assignment->course_id,
                        'type' => $type,
                        'date' => $date,
                    ]);

                    $new->save();

                    if ($assignment->deadline >= $date) {
                        return view('student_show_taken_page', [
                            'assignment_question' => $assignment_question,
                            'count' => $count,
                            'user_data' => $user_data,
                            'type' => $type,
                            'status' => $status,
                            'taken_id' => $new->id,
                        ]);
                    } else {
                        return redirect()->route('student_show_course_chapter', ['course_id' => $assignment->course_id])->with('error', 'Assignment due date lapse, Cannot Take.');
                    }
                }
            }
        } else if ($type == 'quiz') {
            $quiz = Course_quiz::find($id);

            $check_if_taken = Taken::where('quiz_id', $id)->where('student_id', auth()->user()->id)->where('remarks', 'pass')->orWhere('remarks', 'failed')->where('type', 'quiz')->first();

            if ($check_if_taken) {
                return redirect()->route('student_show_course_chapter', ['course_id' => $check_if_taken->course_id])->with('error', 'Cannot take quiz anymore');
            } else {
                $user_data = User::find(auth()->user()->id);
                $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
                $quiz_questions = Quiz_questions::where('course_quiz_id', $id)->paginate(1);
                foreach ($quiz_questions as $key => $data) {
                    $taken_details = Taken_details::where('question_id', $data->id)
                        ->where('student_id', auth()->user()->id)
                        ->first();
                    if ($taken_details) {
                        $status = $taken_details->status;
                    } else {
                        $status = 'wala';
                    }
                }
                $check_taken_table = Taken::where('quiz_id', $id)->where('student_id', auth()->user()->id)->first();

                if ($check_taken_table) {
                    return view('student_show_taken_page', [
                        'assignment_question' => $quiz_questions,
                        'count' => $count,
                        'user_data' => $user_data,
                        'type' => $type,
                        'status' => $status,
                        'taken_id' => $check_taken_table->id,
                    ]);
                } else {
                    $new = new Taken([
                        'quiz_id' => $quiz->id,
                        'instructor_id' => $quiz->course->user_id,
                        'student_id' => auth()->user()->id,
                        'course_chapter_id' => $quiz->course_chapter_id,
                        'course_id' => $quiz->course_id,
                        'type' => $type,
                        'date' => $date,
                    ]);

                    $new->save();


                    return view('student_show_taken_page', [
                        'assignment_question' => $quiz_questions,
                        'count' => $count,
                        'user_data' => $user_data,
                        'type' => $type,
                        'status' => $status,
                        'taken_id' => $new->id,
                    ]);
                }
            }
        } else if ($type == 'exam') {
            $quiz = Exam::find($id);

            $check_if_taken = Taken::where('exam_id', $id)->where('student_id', auth()->user()->id)->where('remarks', 'pass')->orWhere('remarks', 'failed')->where('type', 'exam')->first();

            if ($check_if_taken) {
                return redirect()->route('student_show_course_chapter', ['course_id' => $check_if_taken->course_id])->with('error', 'Cannot take exam anymore');
            } else {
                $user_data = User::find(auth()->user()->id);
                $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();
                $quiz_questions = Exam_questions::where('course_exam_id', $id)->paginate(1);
                foreach ($quiz_questions as $key => $data) {
                    $taken_details = Taken_details::where('question_id', $data->id)
                        ->where('student_id', auth()->user()->id)
                        ->first();
                    if ($taken_details) {
                        $status = $taken_details->status;
                    } else {
                        $status = 'wala';
                    }
                }
                $check_taken_table = Taken::where('exam_id', $id)->where('student_id', auth()->user()->id)->first();

                if ($check_taken_table) {
                    return view('student_show_taken_page', [
                        'assignment_question' => $quiz_questions,
                        'count' => $count,
                        'user_data' => $user_data,
                        'type' => $type,
                        'status' => $status,
                        'taken_id' => $check_taken_table->id,
                    ]);
                } else {
                    $new = new Taken([
                        'exam_id' => $quiz->id,
                        'instructor_id' => $quiz->course->user_id,
                        'student_id' => auth()->user()->id,
                        'course_chapter_id' => $quiz->course_chapter_id,
                        'course_id' => $quiz->course_id,
                        'type' => $type,
                        'date' => $date,
                    ]);

                    $new->save();


                    return view('student_show_taken_page', [
                        'assignment_question' => $quiz_questions,
                        'count' => $count,
                        'user_data' => $user_data,
                        'type' => $type,
                        'status' => $status,
                        'taken_id' => $new->id,
                    ]);
                }
            }
        }
    }

    public function student_taken_submit($taken_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $day = date('l');

        $taken = Taken::find($taken_id);

        if ($taken->type == 'assignment') {
            $assignment = Assignment::find($taken->assignment_id);
            $count_assignment_question = Assignment_questions::where('course_assignment_id', $taken->assignment_id)->count();
            $count_assignment_question_total_score = Assignment_questions::where('course_assignment_id', $taken->assignment_id)->sum('score');

            $count_student_answer = Taken_details::where('taken_id', $taken_id)
                ->where('student_id', auth()->user()->id)
                ->where('remarks', 'checked')
                ->sum('score');

            $percentage = ($count_student_answer / $count_assignment_question_total_score) * 100;

            if ($percentage >= 80) {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'pass',
                    ]);
                $remarks = 'pass';
            } else {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'failed',
                    ]);
                $remarks = 'failed';
            }

            $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();


            if ($check_student_log) {
                Student_logs::where('id', $check_student_log->id)
                    ->update([
                        'content' => $check_student_log->content . "<br />" . 'Turned in assignment with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    ]);
            } else {
                $new_logs = new Student_logs([
                    'content' => 'Turned in assignment with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    'course_id' => $taken->course_id,
                    'course_chapter_id' => $taken->course_chapter_id,
                    'assignment_id' => $taken->assignment_id,
                    'student_id' => auth()->user()->id,
                    'date' => $date,
                ]);

                $new_logs->save();
            }


            return redirect()->route('student_show_course_chapter', ['course_id' => $taken->course_id])->with('success', 'assignment successfully turned in');
        } elseif ($taken->type == 'quiz') {
            $assignment = Course_quiz::find($taken->quiz_id);
            $count_assignment_question = Quiz_questions::where('course_quiz_id', $taken->quiz_id)->count();
            $count_assignment_question_total_score = Quiz_questions::where('course_quiz_id', $taken->quiz_id)->sum('score');

            $count_student_answer = Taken_details::where('taken_id', $taken_id)
                ->where('student_id', auth()->user()->id)
                ->where('remarks', 'checked')
                ->sum('score');

            $percentage = ($count_student_answer / $count_assignment_question_total_score) * 100;

            if ($percentage >= 80) {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'pass',
                    ]);
                $remarks = 'pass';
            } else {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'failed',
                    ]);
                $remarks = 'failed';
            }

            $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

            if ($check_student_log) {
                Student_logs::where('id', $check_student_log->id)
                    ->update([
                        'content' => $check_student_log->monday . '<br />Turned in quiz with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    ]);
            } else {
                $new_logs = new Student_logs([
                    'content' => 'Turned in quiz with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    'course_id' => $taken->course_id,
                    'course_chapter_id' => $taken->course_chapter_id,
                    'assignment_id' => $taken->assignment_id,
                    'student_id' => auth()->user()->id,
                    'date' => $date,
                ]);

                $new_logs->save();
            }

            return redirect()->route('student_show_course_chapter', ['course_id' => $taken->course_id])->with('success', 'quiz successfully turned in');
        } elseif ($taken->type == 'exam') {
            $assignment = Exam::find($taken->exam_id);
            $count_assignment_question = Exam_questions::where('course_exam_id', $taken->exam_id)->count();
            $count_assignment_question_total_score = Exam_questions::where('course_exam_id', $taken->exam_id)->sum('score');

            $count_student_answer = Taken_details::where('taken_id', $taken_id)
                ->where('student_id', auth()->user()->id)
                ->where('remarks', 'checked')
                ->sum('score');

            $percentage = ($count_student_answer / $count_assignment_question_total_score) * 100;

            if ($percentage >= 80) {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'pass',
                    ]);
                $remarks = 'pass';
            } else {
                Taken::where('id', $taken_id)
                    ->update([
                        'score' => $count_student_answer,
                        'total_points' => $count_assignment_question_total_score,
                        'remarks' => 'failed',
                    ]);
                $remarks = 'failed';
            }

            $check_student_log = Student_logs::where('student_id', auth()->user()->id)->where('date', $date)->first();

            if ($check_student_log) {
                Student_logs::where('id', $check_student_log->id)
                    ->update([
                        'content' => $check_student_log->content . '<br />Turned in exam with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    ]);
            } else {
                $new_logs = new Student_logs([
                    'content' => 'Turned in exam with a score of ' . $count_student_answer . ' over ' . $count_assignment_question_total_score . ' and a percentage of ' . round($percentage, 2) . '. remarks ' . $remarks,
                    'course_id' => $taken->course_id,
                    'course_chapter_id' => $taken->course_chapter_id,
                    'exam_id' => $taken->exam_id,
                    'student_id' => auth()->user()->id,
                    'date' => $date,
                ]);

                $new_logs->save();
            }

            return redirect()->route('student_show_course_chapter', ['course_id' => $taken->course_id])->with('success', 'exam successfully turned in');
        }
    }
}
