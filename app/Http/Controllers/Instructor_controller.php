<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course_type;
use App\Models\Course;
use App\Models\Course_details;
use App\Models\Comments;
use App\Models\Exam;
use App\Models\Exam_details;
use App\Models\Direct_message;
use App\Models\Enrolled_course;
use App\Models\Invite_student;
use App\Models\Instructor_planner;
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
        $course = Course::where('user_id', auth()->user()->id)->count();
        return view('instructor_profile', [
            'user_data' => $user_data,
            'course' => $course,
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

    public function instructor_show_pdf_file($course_id)
    {
        $search = 'application';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->get();

        return view('instructor_show_pdf_file', [
            'course_data' => $course_data,
        ]);
    }

    public function instructor_show_video($course_id)
    {
        $search = 'video';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);

        return view('instructor_show_video', [
            'course_data' => $course_data,
        ]);
    }

    public function instructor_show_image($course_id)
    {
        $search = 'image';
        $course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);

        return view('instructor_show_image', [
            'course_data' => $course_data
        ]);
    }

    public function instructor_comment_process(Request $request)
    {

        foreach ($request->input('comment_details') as $key => $id) {
            Comments::where('id', $id)
                ->update(['status' => 'replied']);
        }

        $new_comment = new Comments([
            'course_id' => $request->input('course_id'),
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'status' => 'replied',
        ]);

        $new_comment->save();

        return redirect('instructor_courses')->with('success', 'Successfully add new comment');
    }

    public function instructor_add_exam(Request $request)
    {

        return view('instructor_add_exam')
            ->with('course_id', $request->input('course_id'))
            ->with('number_of_exams', $request->input('number_of_exams'));
    }

    public function instructor_add_exam_next_page(Request $request)
    {
        //return $request->input();

        //dd($request->all());

        if ($request->file('exam_file')) {
            $exam_file = $request->file('exam_file');
            $exam_file_name = $exam_file->getClientOriginalName();
            $exam_file_type = $exam_file->getClientMimeType();
            $path_exam_file = $exam_file->storeAs('public', $exam_file_name);

            $new_exam = new Exam([
                'course_id' => $request->input('course_id'),
                'title' => $request->input('title'),
                'number_of_exams' => $request->input('number_of_exams') + 1,
            ]);

            $new_exam->save();

            $new_exam_details = new Exam_details([
                'exam_id' => $new_exam->id,
                'question' => $request->input('question'),
                'choice_a' => $request->input('choice_a'),
                'choice_b' => $request->input('choice_b'),
                'choice_c' => $request->input('choice_c'),
                'choice_d' => $request->input('choice_d'),
                'file' => $exam_file_name,
                'file_type' => $exam_file_type,
                'answer' => $request->input('answer'),
            ]);

            $new_exam_details->save();
        } else {
            $new_exam = new Exam([
                'course_id' => $request->input('course_id'),
                'title' => $request->input('title'),
                'number_of_exams' => $request->input('number_of_exams') + 1,
            ]);

            $new_exam->save();

            $new_exam_details = new Exam_details([
                'exam_id' => $new_exam->id,
                'question' => $request->input('question'),
                'choice_a' => $request->input('choice_a'),
                'choice_b' => $request->input('choice_b'),
                'choice_c' => $request->input('choice_c'),
                'choice_d' => $request->input('choice_d'),
                'answer' => $request->input('answer'),
            ]);

            $new_exam_details->save();
        }


        if ($request->input('number_of_exams') == 0) {
            return redirect('instructor_courses');
        } else {
            return view('instructor_add_exam_next_page')
                ->with('number_of_exams', $request->input('number_of_exams'))
                ->with('exam_id', $new_exam->id);
        }
    }

    public function instructor_add_exam_next_page_process(Request $request)
    {
        // dd($request->all());
        if ($request->file('exam_file')) {
            $exam_file = $request->file('exam_file');
            $exam_file_name = $exam_file->getClientOriginalName();
            $exam_file_type = $exam_file->getClientMimeType();
            $path_exam_file = $exam_file->storeAs('public', $exam_file_name);


            $new_exam_details = new Exam_details([
                'exam_id' => $request->input('exam_id'),
                'question' => $request->input('question'),
                'choice_a' => $request->input('choice_a'),
                'choice_b' => $request->input('choice_b'),
                'choice_c' => $request->input('choice_c'),
                'choice_d' => $request->input('choice_d'),
                'file' => $exam_file_name,
                'file_type' => $exam_file_type,
                'answer' => $request->input('answer'),
            ]);

            $new_exam_details->save();
        } else {
            $new_exam_details = new Exam_details([
                'exam_id' => $request->input('exam_id'),
                'question' => $request->input('question'),
                'choice_a' => $request->input('choice_a'),
                'choice_b' => $request->input('choice_b'),
                'choice_c' => $request->input('choice_c'),
                'choice_d' => $request->input('choice_d'),
                'answer' => $request->input('answer'),
            ]);

            $new_exam_details->save();
        }

        if ($request->input('number_of_exams') == 0) {
            return redirect('instructor_courses');
        } else {
            return view('instructor_add_exam_next_page')
                ->with('number_of_exams', $request->input('number_of_exams'))
                ->with('exam_id', $request->input('exam_id'));
        }
    }

    public function instructor_view_exam($course_id)
    {
        $exam_data = Exam::where('course_id', $course_id)->get();
        return view('instructor_view_exam', [
            'exam_data' => $exam_data,
        ]);
    }

    public function instructor_add_exam_certificate(Request $request)
    {
        //return dd($request->all());
        $certificate = $request->file('certificate');
        $certificate_name = $certificate->getClientOriginalName();
        $certificate_type = $certificate->getClientMimeType();
        $path_certificate = $certificate->storeAs('public', $certificate_name);

        Exam::where('id', $request->input('exam_id'))
            ->update(['certificate' => $certificate_name]);

        return redirect('instructor_courses')->with('success', 'Successfully added exam certificate');
    }

    public function instructor_students(Request $request)
    {
        $user_data = User::find(auth()->user()->id);
        return view('instructor_students', [
            'user_data' => $user_data,
        ]);
    }

    public function instructor_direct_message()
    {


        $enrolled_student = Enrolled_course::where('instructor_id', auth()->user()->id)->groupBy('student_id')->get();
        foreach ($enrolled_student as $key => $data) {
            $count[$data->student_id] = Direct_message::where('user_id', $data->student_id)->where('user_typer', 'Student')->where('status', null)->get();
        }

        foreach ($enrolled_student as $key => $data) {
            $student_id[] = $data->student_id;
        }

        $direct_message = Direct_message::whereIn('user_id', $student_id)->where('instructor_id', auth()->user()->id)->get();

        $user_data = User::find(auth()->user()->id);

        return view('instructor_direct_message', [
            'user_data' => $user_data,
            'direct_message' => $direct_message,
            'enrolled_student' => $enrolled_student,
            'count' => $count,
        ]);
    }

    public function instructor_message_process(Request $request)
    {
        // return dd($request->all());
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
                'user_id' => $request->input('student_id'),
                'instructor_id' => auth()->user()->id,
                'file' => $message_file_name,
                'file_type' => $message_file_type,
                'user_typer' => 'Instructor',
            ]);

            $new_message->save();
        } else {
            $new_message = new Direct_message([
                'comment' => $request->input('comment'),
                'user_id' => $request->input('student_id'),
                'instructor_id' => auth()->user()->id,
                'user_typer' => 'Instructor',
            ]);

            $new_message->save();
        }

        return redirect('instructor_direct_message')->with('success', 'Message sent');
    }

    public function instructor_invite_student($course_id)
    {
        $enrolled_on_this_course = Enrolled_course::select('student_id')->where('course_id', $course_id)->get();


        if (count($enrolled_on_this_course) != 0) {
            foreach ($enrolled_on_this_course as $key => $data) {
                $student_id[] = $data->student_id;
            }

            $students = User::select('name', 'last_name', 'id')->where('user_type', 'Student')->whereNotIn('id', $student_id)->get();
            $user_data = User::find(auth()->user()->id);

            return view('instructor_invite_student', [
                'students' => $students,
                'user_data' => $user_data,
            ])->with('course_id', $course_id);
        } else {
            $students = User::select('name', 'last_name', 'id')->where('user_type', 'Student')->get();
            $user_data = User::find(auth()->user()->id);

            return view('instructor_invite_student', [
                'students' => $students,
                'user_data' => $user_data,
            ])->with('course_id', $course_id);
        }
    }

    public function instructor_invite_student_process($course_id, $student_id)
    {
        $check = Invite_student::where('course_id', $course_id)
            ->where('student_id', $student_id)
            ->first();

        if ($check) {
            return redirect()->route('instructor_invite_student', ['course_id' => $course_id])->with('success', 'Invitation sent successfully');
        } else {
            $new = new Invite_student([
                'course_id' => $course_id,
                'student_id' => $student_id,
                'instructor_id' => auth()->user()->id,
                'status' => 'Pending Approval',
            ]);

            $new->save();

            return redirect()->route('instructor_invite_student', ['course_id' => $course_id])->with('success', 'Invitation sent successfully');
        }
    }

    public function intructor_to_do()
    {
        $user_data = User::find(auth()->user()->id);
        return view('intructor_to_do', [
            'user_data' => $user_data,
        ]);
    }

    public function instructor_todo_process(Request $request)
    {


        $new = new Instructor_planner([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'instructor_id' => auth()->user()->id,
            'todo' => $request->input('todo'),
        ]);

        $new->save();

        return redirect()->route('intructor_to_do')->with('success', 'Successfully added new plan');
    }

    public function instructor_to_do_list()
    {
        $user_data = User::find(auth()->user()->id);
        $todo = Instructor_planner::where('instructor_id', auth()->user()->id)->orderBy('date')->get();
        return view('instructor_to_do_list', [
            'user_data' => $user_data,
            'todo' => $todo,
        ]);
    }

    public function planner_prompt(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        return $planner = Instructor_planner::where('instructor_id', auth()->user()->id)
            ->where('date', $date)
            ->where('status', null)
            ->count();
    }

    public function planner_approved($planner_id)
    {
        Instructor_planner::where('id', $planner_id)
            ->update(['status' => 'approved']);

        return redirect()->route('instructor_to_do_list')->with('success', 'Planner Acknowledge');
    }
}
