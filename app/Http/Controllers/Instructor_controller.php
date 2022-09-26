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
use App\Models\Course_chapter;
use App\Models\Instructor_planner;
use App\Models\Course_quiz;
use App\Models\Quiz_questions;
use App\Models\Quiz_details;
use App\Models\Exam_questions;
use App\Models\Exam_matching;
use App\Models\Assignment;
use App\Models\Assignment_questions;
use App\Models\Assignment_details;
use App\Models\Assignment_matching;
use App\Models\Quiz_matching;



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
        return redirect()->route('instructor_courses')->with('success', 'Successfully added new course.');
        // return redirect()->route('instructor_add_course_phase_2', ['course_id' => $new->id])->with('success', 'Successfully added new course. Please add course chapter');
    }

    public function instructor_courses_show_content()
    {
        return view('instructor_courses_show_content');
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
        //return $request->input();
        //dd($request->all());
        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = $thumbnail->getClientOriginalName();
        $thumbnail_type = $thumbnail->getClientMimeType();
        $path_thumbnail = $thumbnail->storeAs('public', $thumbnail_name);

        if (str_contains($thumbnail_type, 'image')) {
            $new = new Course_chapter([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'course_id' => $request->input('course_id'),
                'chapter_number' => $request->input('chapter_number'),
                'thumbnail' => $thumbnail_name,
            ]);

            $new->save();

            return redirect()->route('instructor_courses')->with('success', 'Successfully added new chapter.');
        } else {
            return redirect()->route('instructor_add_course_phase_2', ['course_id' => $request->input('course_id')])->with('error', 'Thumbnail is not an image');
        }



        // return redirect()->route('instructor_add_course_phase_3', [
        //     'course_id' => $request->input('course_id'),
        //     'course_chapter_id' => $new->id
        // ])->with('success', 'Successfully added course chapter');
    }

    public function instructor_show_chapter($course_id)
    {
        $course_chapter = Course_chapter::where('course_id', $course_id)->get();


        // foreach ($course_chapter as $key => $data) {
        //     foreach ($data->course_chapter as $key => $value) {
        //         # code...
        //     }
        // }



        $user_data = User::find(auth()->user()->id);
        return view('instructor_show_chapter', [
            'course_chapter' => $course_chapter,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_course_phase_3($course_id, $course_chapter_id)
    {
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_course_phase_3', [
            'course_id' => $course_id,
            'user_data' => $user_data,
            'course_chapter_id' => $course_chapter_id,
        ]);
    }

    public function instructor_add_course_phase_3_process(Request $request)
    {
        $course_file = $request->file('course_file');
        $course_file_name = $course_file->getClientOriginalName();
        $course_file_type = $course_file->getClientMimeType();
        $path_course_file = $course_file->storeAs('public', $course_file_name);

        $new_course_details = new Course_details([
            'file' => $course_file_name,
            'course_id' => $request->input('course_id'),
            'file_type' => $course_file_type,
            'course_chapter_id' => $request->input('course_chapter_id'),
        ]);

        $new_course_details->save();


        return redirect()->route('instructor_add_course_phase_4', [
            'course_id' => $request->input('course_id'),
            'course_chapter_id' => $request->input('course_chapter_id'),
        ])->with('success', 'Successfully added chapter file');

        // return redirect()->route('instructor_add_course')->with('success', 'Successfully added chapter file');
    }

    public function instructor_add_course_phase_4($course_id, $course_chapter_id)
    {
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_course_phase_4', [
            'course_id' => $course_id,
            'user_data' => $user_data,
            'course_chapter_id' => $course_chapter_id,
        ]);
    }

    public function instructor_add_course_phase_4_process(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $check = Course_quiz::where('quiz_title', $request->input('quiz_title'))->first();

        if ($check) {
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_quiz', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'quiz_id' => $check->id,
                'number_of_questions' => $request->input('number_of_questions'),
            ]);
        } else {
            $new = new Course_quiz([
                'course_id' => $request->input('course_id'),
                'course_chapter_id' => $request->input('course_chapter_id'),
                'quiz_title' => $request->input('quiz_title'),
                'number_of_questions' => $request->input('number_of_questions'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);

            $new->save();

            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_quiz', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'quiz_id' => $new->id,
                'number_of_questions' => $request->input('number_of_questions'),
            ]);
        }
    }

    public function instructor_add_course_chapter_quiz_question_type(Request $request)
    {
        return view('instructor_add_course_chapter_quiz_question_type')
            ->with('question_type', $request->input('question_type'))
            ->with('loop_number', $request->input('loop_number'));
    }


    public function instructor_edit_quiz_question_process(Request $request)
    {
        // return $request->input();
        if ($request->input('question_type') == 'Enumeration') {
            $implode = implode('|', $request->input('answer'));
            foreach ($request->input('answer') as $key => $data) {
                Quiz_questions::where('id', $request->input('quiz_question_id'))
                    ->update([
                        'question' => $request->input('question'),
                        'answer' => strtolower($implode),
                    ]);
            }

            return redirect()->route('instructor_edit_quiz_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Multitple Choice') {
            Quiz_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            Quiz_details::where('id', $request->input('quiz_details_id'))
                ->update([
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

            return redirect()->route('instructor_edit_quiz_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Identification') {
            Quiz_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            return redirect()->route('instructor_edit_quiz_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Matching Type') {
            //return $request->input();
            $answer = implode('|', $request->input('answer'));
            $question = implode('|', $request->input('question'));

            Quiz_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $question,
                    'answer' => strtolower($answer),
                ]);

            foreach ($request->input('matching_id') as $key => $matching_id) {
                Quiz_matching::where('id', $matching_id)
                    ->update([
                        'choices' => $request->input('choices')[$matching_id],
                    ]);
            }

            return redirect()->route('instructor_edit_quiz_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        }
    }

    public function instructor_add_course_chapter_quiz_next_question(Request $request)
    {
        //return $request->input();
        if ($request->input('number_of_questions') == 0) {
            if ($request->input('question_type') == 'Enumeration') {
                //return $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Quiz_details([
                    'quiz_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Identification') {
                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Quiz_matching([
                        'quiz_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            }
        } else {
            if ($request->input('question_type') == 'Enumeration') {
                //return $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_quiz_next_question', [
                        'course_id' => $request->input('course_id'),
                        'quiz_id' => $request->input('quiz_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Quiz_details([
                    'quiz_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_quiz_next_question', [
                        'course_id' => $request->input('course_id'),
                        'quiz_id' => $request->input('quiz_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Identification') {
                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_quiz_next_question', [
                        'course_id' => $request->input('course_id'),
                        'quiz_id' => $request->input('quiz_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Quiz_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_quiz_id' => $request->input('quiz_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Quiz_matching([
                        'quiz_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_quiz_next_question', [
                        'course_id' => $request->input('course_id'),
                        'quiz_id' => $request->input('quiz_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            }
        }
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

    public function instructor_add_file_to_chapter(Request $request)
    {
        // dd($request->all());

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $file = $request->file('file');
        $file_name = 'file-' . time() . '.' . $file->getClientOriginalExtension();
        $mime_type = $file->getClientMimeType();
        $path_file = $file->storeAs('public', $file_name);

        //$explode = explode('/', $mime_type);

        if (str_contains($mime_type, 'image')) {
            $new = new Course_details([
                'file' => $file_name,
                'course_id' => $request->input('course_id'),
                'file_type' => 'image',
                'course_chapter_id' => $request->input('chapter_id'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);
            $new->save();
        } else if (str_contains($mime_type, 'video')) {
            $new = new Course_details([
                'file' => $file_name,
                'course_id' => $request->input('course_id'),
                'file_type' => 'video',
                'course_chapter_id' => $request->input('chapter_id'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);
            $new->save();
        } else if (str_contains($mime_type, 'application')) {
            $new = new Course_details([
                'file' => $file_name,
                'course_id' => $request->input('course_id'),
                'file_type' => 'application',
                'course_chapter_id' => $request->input('chapter_id'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);
            $new->save();
        }

        //return $request->input();

        // $new_course_details = new Course_details([
        //     'file' => $file_name,
        //     'course_id' => $request->input('course_id'),
        //     'file_type' => $subject_file_type,
        // ]);

        // $new_course_details->save();

        return redirect()->route('instructor_show_chapter', ['course_id' => $request->input('course_id')])->with('success', 'Successfully added new chapter file');
    }

    public function instructor_chapter_add_quiz_or_exam(Request $request)
    {
       // return $request->input();


        if ($request->input('type') == 'Chapter Quiz') {
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_phase_4', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('chapter_id'),
            ]);
        } elseif ($request->input('type') == 'Chapter Exam') {
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_exam', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('chapter_id'),
            ]);
        } elseif ($request->input('type') == 'Chapter Assignment') {
            
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_assignment', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('chapter_id'),
            ]);
        }
    }

    public function instructor_add_course_assignment_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $check = Exam::where('title', $request->input('title'))->first();

        if ($check) {
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_assignment_proceed', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'exam_id' => $check->id,
                'number_of_questions' => $request->input('number_of_``questions'),
            ]);
        } else {
            // return 'asdasd';
            $new = new Assignment([
                'course_id' => $request->input('course_id'),
                'course_chapter_id' => $request->input('course_chapter_id'),
                'title' => $request->input('title'),
                'number_of_questions' => $request->input('number_of_questions'),
                'deadline' => $request->input('deadline'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);

            $new->save();

            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_assignment_proceed', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'exam_id' => $new->id,
                'number_of_questions' => $request->input('number_of_questions'),
            ]);
        }
    }

    public function instructor_add_course_chapter_assignment_next_question(Request $request)
    {
        // return $request->input();
        if ($request->input('number_of_questions') == 0) {
            if ($request->input('question_type') == 'Enumeration') {
                //return $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Assignment_details([
                    'assignment_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Identification') {
                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Assignment_matching([
                        'assignment_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            }
        } else {
            if ($request->input('question_type') == 'Enumeration') {
                //return $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_assignment_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('assignment_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Assignment_details([
                    'assignment_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_assignment_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('assignment_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Identification') {
                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_assignment_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('assignment_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Assignment_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_assignment_id' => $request->input('assignment_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Assignment_matching([
                        'assignment_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_assignment_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('assignment_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            }
        }
    }

    public function instructor_add_course_exam_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $check = Exam::where('title', $request->input('title'))->first();

        if ($check) {
            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_exam_proceed', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'exam_id' => $check->id,
                'number_of_questions' => $request->input('number_of_questions'),
            ]);
        } else {
            // return 'asdasd';
            $new = new Exam([
                'course_id' => $request->input('course_id'),
                'course_chapter_id' => $request->input('course_chapter_id'),
                'title' => $request->input('title'),
                'number_of_questions' => $request->input('number_of_questions'),
                'created_at' => $date,
                'status' => 'disabled',
            ]);

            $new->save();

            $user_data = User::find(auth()->user()->id);
            return view('instructor_add_course_chapter_exam_proceed', [
                'course_id' => $request->input('course_id'),
                'user_data' => $user_data,
                'course_chapter_id' => $request->input('course_chapter_id'),
                'exam_id' => $new->id,
                'number_of_questions' => $request->input('number_of_questions'),
            ]);
        }
    }

    public function instructor_add_course_chapter_exam_next_question(Request $request)
    {
        //return $request->input();
        if ($request->input('number_of_questions') == 0) {

            if ($request->input('question_type') == 'Enumeration') {
                //return $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Exam_details([
                    'exam_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Identification') {
                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Exam_matching([
                        'exam_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    return redirect('instructor_courses');
                }
            }
        } else {
            if ($request->input('question_type') == 'Enumeration') {
                //eturn $request->input();
                $implode = implode('|', $request->input('answer'));

                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($implode),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_exam_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('exam_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Multitple Choice') {
                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                $new_question_details = new Exam_details([
                    'exam_question_id' => $new_question->id,
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

                $new_question_details->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_exam_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('exam_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Identification') {
                // return $request->input();
                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_exam_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('exam_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            } elseif ($request->input('question_type') == 'Matching Type') {
                $answer = implode('|', $request->input('answer'));
                $question = implode('|', $request->input('question'));

                $new_question = new Exam_questions([
                    'course_id' => $request->input('course_id'),
                    'course_chapter_id' => $request->input('course_chapter_id'),
                    'course_exam_id' => $request->input('exam_id'),
                    'question' => $question,
                    'answer' => strtolower($answer),
                    'question_type' => $request->input('question_type'),
                    'score' => $request->input('score'),
                ]);

                $new_question->save();

                foreach ($request->input('choices') as $key => $choices) {
                    $new_question_details = new Exam_matching([
                        'exam_question_id' => $new_question->id,
                        'choices' => $choices,
                    ]);

                    $new_question_details->save();
                }


                $add_one = $request->input('add_one');
                if (isset($add_one)) {
                    return redirect('instructor_courses');
                } else {
                    $user_data = User::find(auth()->user()->id);
                    return view('instructor_add_course_chapter_exam_next_question', [
                        'course_id' => $request->input('course_id'),
                        'exam_id' => $request->input('exam_id'),
                        'user_data' => $user_data,
                        'course_chapter_id' => $request->input('course_chapter_id'),
                        'number_of_questions' => $request->input('number_of_questions'),
                    ]);
                }
            }
        }
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

    public function instructor_show_video($course_details_id)
    {
        //$search = 'video';
        //$course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);
        $course_data = Course_details::find($course_details_id);
        return view('instructor_show_video', [
            'course_data' => $course_data,
        ]);
    }

    public function instructor_show_image($course_details_id)
    {
        // $search = 'image';
        //$course_data = Course_details::where('course_id', $course_id)->where('file_type', 'like', '%' . $search . '%')->paginate(1);
        $course_data = Course_details::find($course_details_id);
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

        $check_enrollment = Enrolled_course::get();
        // return auth()->user()->id;
        if (count($check_enrollment) != 0) {

            $enrolled_student = Enrolled_course::where('instructor_id', auth()->user()->id)->groupBy('student_id')->get();
            if (count($enrolled_student) != 0) {
                foreach ($enrolled_student as $key => $data) {
                    $count[$data->student_id] = Direct_message::where('user_id', $data->student_id)->where('user_typer', 'Student')
                        ->where('instructor_id', auth()->user()->id)
                        ->where('status', null)->get();
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
            } else {
                $user_data = User::find(auth()->user()->id);
                return view('no404', [
                    'user_data' => $user_data,
                ]);
            }
        } else {
            //return 'wala';
            $user_data = User::find(auth()->user()->id);
            return view('no404', [
                'user_data' => $user_data,
            ])->with('error', 'No Data Yet');
        }
    }

    // public function no404()
    // {

    // } 

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
        $todo = Instructor_planner::where('instructor_id', auth()->user()->id)->orderBy('date')->where('status', null)->get();
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

    public function course_details_status_update($details_id, $status, $course_id)
    {
        if ($status == 'disabled') {
            Course_details::where('id', $details_id)
                ->update(['status' => 'enabled']);
        } else {
            Course_details::where('id', $details_id)
                ->update(['status' => 'disabled']);
        }

        return redirect()->route('instructor_show_chapter', ['course_id' => $course_id])->with('success', 'Updated');
    }

    public function course_quiz_status_update($quiz_id, $status, $course_id)
    {
        //return 'asdasd';
        if ($status == 'disabled') {
            Course_quiz::where('id', $quiz_id)
                ->update(['status' => 'enabled']);
        } else {
            Course_quiz::where('id', $quiz_id)
                ->update(['status' => 'disabled']);
        }

        return redirect()->route('instructor_show_chapter', ['course_id' => $course_id])->with('success', 'Updated');
    }

    public function instructor_edit_quiz_question($question_id)
    {
        $question = Quiz_questions::find($question_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_edit_quiz_question', [
            'question' => $question,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_add_item_to_quiz($quiz_id)
    {
        $quiz = Course_quiz::find($quiz_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_item_to_quiz', [
            'quiz' => $quiz,
            'user_data' => $user_data,
        ]);
    }


    public function course_exam_status_update($quiz_id, $status, $course_id)
    {
        //return 'asdasd';
        if ($status == 'disabled') {
            Exam::where('id', $quiz_id)
                ->update(['status' => 'enabled']);
        } else {
            Exam::where('id', $quiz_id)
                ->update(['status' => 'disabled']);
        }

        return redirect()->route('instructor_show_chapter', ['course_id' => $course_id])->with('success', 'Updated');
    }

    public function instructor_edit_exam_question($question_id)
    {
        $question = Exam_questions::find($question_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_edit_exam_question', [
            'question' => $question,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_edit_exam_question_process(Request $request)
    {
        if ($request->input('question_type') == 'Enumeration') {
            $implode = implode('|', $request->input('answer'));
            foreach ($request->input('answer') as $key => $data) {
                Exam_questions::where('id', $request->input('quiz_question_id'))
                    ->update([
                        'question' => $request->input('question'),
                        'answer' => strtolower($implode),
                    ]);
            }

            return redirect()->route('instructor_edit_exam_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Multitple Choice') {
            Exam_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            Exam_details::where('id', $request->input('quiz_details_id'))
                ->update([
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

            return redirect()->route('instructor_edit_exam_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Identification') {
            Exam_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            return redirect()->route('instructor_edit_exam_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Matching Type') {

            $answer = implode('|', $request->input('answer'));
            $question = implode('|', $request->input('question'));

            Exam_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $question,
                    'answer' => strtolower($answer),
                ]);

            foreach ($request->input('matching_id') as $key => $matching_id) {
                Exam_matching::where('id', $matching_id)
                    ->update([
                        'choices' => $request->input('choices')[$matching_id],
                    ]);
            }

            return redirect()->route('instructor_edit_exam_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        }
    }

    public function instructor_list_of_students()
    {
        $enrolled = Enrolled_course::where('instructor_id', auth()->user()->id)->get();
        $user_data = User::find(auth()->user()->id);
        return view('instructor_list_of_students', [
            'enrolled' => $enrolled,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_edit_chapter(Request $request)
    {
        //return $request->input();

        Course_chapter::where('id', $request->input('chapter_id'))
            ->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'chapter_number' => $request->input('chapter'),
            ]);

        return redirect()->route('instructor_show_chapter', ['course_id' => $request->input('course_id')])->with('success', 'Updated');
    }

    public function instructor_add_item_to_exam($exam_id)
    {
        $exam = Exam::find($exam_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_item_to_exam', [
            'exam' => $exam,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_edit_assignment_question($question_id)
    {
        $question = Assignment_questions::find($question_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_edit_assignment_question', [
            'question' => $question,
            'user_data' => $user_data,
        ]);
    }

    public function instructor_edit_assignment_question_process(Request $request)
    {
        if ($request->input('question_type') == 'Enumeration') {
            $implode = implode('|', $request->input('answer'));
            foreach ($request->input('answer') as $key => $data) {
                Assignment_questions::where('id', $request->input('quiz_question_id'))
                    ->update([
                        'question' => $request->input('question'),
                        'answer' => strtolower($implode),
                    ]);
            }

            return redirect()->route('instructor_edit_assignment_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Multitple Choice') {
            Assignment_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            Assignment_details::where('id', $request->input('quiz_details_id'))
                ->update([
                    'choice_a' => $request->input('choice_a'),
                    'choice_b' => $request->input('choice_b'),
                    'choice_c' => $request->input('choice_c'),
                    'choice_d' => $request->input('choice_d'),
                ]);

            return redirect()->route('instructor_edit_assignment_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Identification') {
            Assignment_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $request->input('question'),
                    'answer' => strtolower($request->input('answer')),
                ]);

            return redirect()->route('instructor_edit_assignment_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        } elseif ($request->input('question_type') == 'Matching Type') {

            $answer = implode('|', $request->input('answer'));
            $question = implode('|', $request->input('question'));

            Assignment_questions::where('id', $request->input('quiz_question_id'))
                ->update([
                    'question' => $question,
                    'answer' => strtolower($answer),
                ]);

            foreach ($request->input('matching_id') as $key => $matching_id) {
                Assignment_matching::where('id', $matching_id)
                    ->update([
                        'choices' => $request->input('choices')[$matching_id],
                    ]);
            }

            return redirect()->route('instructor_edit_assignment_question', ['question_id' => $request->input('quiz_question_id')])->with('success', 'Updated');
        }
    }

    public function instructor_add_item_to_assignment($assignment_id)
    {
        $assignment = Assignment::find($assignment_id);
        $user_data = User::find(auth()->user()->id);
        return view('instructor_add_item_to_assignment', [
            'assignment' => $assignment,
            'user_data' => $user_data,
        ]);
    }
}
