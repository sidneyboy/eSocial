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
            $course = Course::whereNotIn('id', $id)->orderBy('id', 'Desc')->get();
            $user_data = User::find(auth()->user()->id);
            return view('student_course', [
                'user_data' => $user_data,
                'course' => $course,
                'count' => $count,
            ]);
        } else {
            $course = Course::orderBy('id', 'Desc')->get();
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

        return view('student_profile', [
            'user_data' => $user_data,
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

        return redirect('student_profile')->with('success', 'Successfully approved selected student');
    }

    public function student_search_course(Request $request)
    {
        $search = $request->input('search_box');
        $course = Course::where('course_title', 'like', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();

        $user_data = User::find(auth()->user()->id);
        $count = Invite_student::where('student_id', auth()->user()->id)->where('status', 'Pending Approval')->count();

        return view('student_search_course', [
            'course' => $course,
            'user_data' => $user_data,
            'count' => $count,
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

        return redirect('student_enrolled_courses')->with('success', 'Successfully add new comment');
    }

    public function student_show_image_file($course_id)
    {
        $search = 'image';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);

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
                ->where('user_typer', 'Instructor')
                ->where('user_id', auth()->user()->id)
                ->where('status', null)->get();
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

    public function student_answer_exam_process(Request $request)
    {
        if ($request->input('student_answer') == $request->input('answer')) {
            $remarks = 'Checked';
        } else {
            $remarks = 'Wrong';
        }

        Student_exam_details::where('id', $request->input('student_exam_details_id'))
            ->update([
                'status' => 'answered',
                'student_answer' => $request->input('student_answer'),
                'remarks' => $remarks,
            ]);
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
        $todo = Instructor_planner::where('instructor_id', auth()->user()->id)->orderBy('date')->get();
        return view('student_to_do_list', [
            'user_data' => $user_data,
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
}
