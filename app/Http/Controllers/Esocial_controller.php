<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Course_type;
use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\Http\Request;

class Esocial_controller extends Controller
{
    public function tutorial()
    {
        $tutorial = Tutorial::get();
        $user_data = User::find(auth()->user()->id);
        return view('tutorial', [
            'tutorial' => $tutorial,
            'user_data' => $user_data
        ]);
    }

    public function tutorial_remove($tutorial_id)
    {
        $tutorial = Tutorial::find($tutorial_id);
        $tutorial->delete();

        return redirect('tutorial')->with('success', 'Removed Selected Tutorial');
    }

    public function tutorial_process(Request $request)
    {
        $tutorial_image = $request->file('tutorial_image');
        $tutorial_image_name = 'tutorial_image-' . time() . '.' . $tutorial_image->getClientOriginalExtension();
        $path_tutorial_image = $tutorial_image->storeAs('public', $tutorial_image_name);

        $new = new Tutorial([
            'title' => $request->input('title'),
            'tutorial_image' => $tutorial_image_name,
            'tutorial_note' => $request->input('tutorial_note'),
        ]);

        $new->save();

        return redirect('tutorial')->with('success', 'Successfully added new tutorial');
    }

    public function course_type()
    {
        $course_type = Course_type::get();
        $user_data = User::find(auth()->user()->id);
        return view('course_type', [
            'course_type' => $course_type,
            'user_data' => $user_data,
        ]);
    }

    public function course_process(Request $request)
    {
        $new = new Course_type([
            'course_type' => $request->input('course_type'),
        ]);

        $new->save();

        return redirect('course_type')->with('success', 'Successfully added new course');
    }

    public function approved_instructor()
    {
        $instructor = User::where('user_type', 'Instructor')->get();
        $user_data = User::find(auth()->user()->id);
        return view('approved_instructor', [
            'instructor' => $instructor,
            'user_data' => $user_data,
        ]);
    }

    public function approved_instructor_process($id)
    {
        User::where('id', $id)
            ->update([
                'status' => 'Approved',
            ]);

        return redirect('approved_instructor')->with('success', 'Successfully approved selected instructor');
    }

    public function profile_add_image(Request $request)
    {

        $user_image = $request->file('user_image');
        $user_image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $user_image_name);

        User::where('id', $request->input('user_id'))
            ->update([
                'user_image' => $user_image_name,
            ]);

        return redirect('profile')->with('success', 'Successfully approved selected admin');
    }

    public function approved_instructor_suspend($user_id)
    {
        User::where('id', $user_id)
            ->update([
                'status' => 'Suspended',
            ]);

        return redirect('approved_instructor')->with('success', 'Successfully suspended selected instructor');
    }

    public function courses()
    {
        $courses = Course::orderBy('id', 'desc')->get();
        $user_data = User::find(auth()->user()->id);
        return view('courses', [
            'courses' => $courses,
            'user_data' => $user_data,
        ]);
    }

    public function course_update($course_id, $status)
    {
        if ($status == 'Pending Approval') {
            Course::where('id', $course_id)
                ->update([
                    'status' => 'Approved',
                ]);

            return redirect('courses')->with('success', 'Successfully Change Status To Approved');
        } else {
            Course::where('id', $course_id)
                ->update([
                    'status' => 'Pending Approval',
                ]);

            return redirect('courses')->with('success', 'Successfully Change Status To Pending Approval');
        }
    }



    public function student_list()
    {
        $user_data = User::find(auth()->user()->id);
        $students = User::where('user_type', 'Student')->get();
        return view('student_list', [
            'user_data' => $user_data,
            'students' => $students,
        ]);
    }

    public function suspend_student($user_id, $status)
    {
        if ($status == 'Activated') {
            User::where('id', $user_id)
                ->update([
                    'status' => 'Suspended',
                ]);

            return redirect('student_list')->with('success', 'Successfully suspended selected student');
        } else {
            User::where('id', $user_id)
                ->update([
                    'status' => null,
                ]);

            return redirect('student_list')->with('success', 'Successfully activated selected instructor');
        }
    }

    public function payment_history()
    {
        $user_data = User::find(auth()->user()->id);
        $payment = Payment::orderBy('id','desc')->where('status','paid')->get();
        return view('payment_history', [
            'user_data' => $user_data,
            'payment' => $payment,
        ]);
    }

    public function course_type_edit_process(Request $request)
    {
        Course_type::where('id', $request->input('course_type_id'))
            ->update(['course_type' => $request->input('course_type')]);

        return redirect('course_type')->with('success', 'Successfully edited selected course type');
    }

    public function statistics()
    {
        $user_data = User::find(auth()->user()->id);
        return view('statistics',[
            'user_data' => $user_data,
        ]);
    }
}
