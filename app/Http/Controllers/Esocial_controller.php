<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Course_type;
use App\Models\User;
use App\Models\Payment;
use App\Models\Course;
use App\Models\User_logs;
use App\Models\Enrolled_course;

use Carbon\Carbon;
use DB;
use DateTime;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Esocial_controller extends Controller
{
    public function super_admin_login_process(Request $request)
    {
      
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            //return auth()->user()->id;
            $user = User::find(auth()->user()->id);
            if ($user->user_type == 'Super admin') {
                return redirect('admin_logs');
            } else {
                return redirect('super_admin_login')->with('error', 'Wrong Credentials');
            }
        } else {
            return redirect('super_admin_login')->with('error', 'Wrong Credentials');
        }
    }

    public function generate_statistics(Request $request)
    {
        //return $request->input();
   
        $startDate = date('Y-m-d',  strtotime($request->input('date_from')));
        $endDate = date('Y-m-d', strtotime($request->input('date_to')));
       
       // $posts = Post::whereBetween('created_at', [$startDate, $endDate])->get()
       $enrolled_students = Enrolled_course::whereBetween('created_at',[$startDate,$endDate])
                            ->where('status','paid')
                            ->get();

        return view('generate_statistics',[
            'enrolled_students' => $enrolled_students,
        ]);
    }

    public function admin_login(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            //return auth()->user()->id;
            $user = User::find(auth()->user()->id);
            if ($user->user_type == 'Admin') {
                return redirect('payment_history');
            } else {
                return redirect('admin_login');
            }
        } else {
            return redirect('admin_login')->with('error', 'Wrong Credentials');
        }
    }

    public function admin_logs()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $user_data = User::find(auth()->user()->id);
        $user_logs = User_logs::get();
        return view('admin_logs', [
            'user_data' => $user_data,
            'user_logs' => $user_logs,
        ]);
    }

    public function tutorial()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $tutorial = Tutorial::get();
        $user_data = User::find(auth()->user()->id);




        return view('tutorial', [
            'tutorial' => $tutorial,
            'user_data' => $user_data
        ]);
    }

    public function tutorial_remove($tutorial_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $tutorial = Tutorial::find($tutorial_id);
        $tutorial->delete();

        return redirect('tutorial')->with('success', 'Removed Selected Tutorial');
    }

    public function tutorial_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
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
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $course_type = Course_type::get();
        $user_data = User::find(auth()->user()->id);


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Course Type',
            'created_at' => $date,
        ]);

        $new_logs->save();
        return view('course_type', [
            'course_type' => $course_type,
            'user_data' => $user_data,
        ]);
    }

    public function course_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $new = new Course_type([
            'course_type' => $request->input('course_type'),
        ]);

        $new->save();


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'Added new course type',
            'created_at' => $date,
        ]);

        $new_logs->save();

        return redirect('course_type')->with('success', 'Successfully added new course');
    }

    public function approved_instructor()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $instructor = User::where('user_type', 'Instructor')->get();
        $user_data = User::find(auth()->user()->id);


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Approved Instructor',
            'created_at' => $date,
        ]);

        $new_logs->save();


        return view('approved_instructor', [
            'instructor' => $instructor,
            'user_data' => $user_data,
        ]);
    }

    public function approved_instructor_process($id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        User::where('id', $id)
            ->update([
                'status' => 'Approved',
            ]);

        $user_data = User::find(auth()->user()->id);
        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'Approved Instructor ' . $user_data->name . " " . $user_data->last_name,
            'created_at' => $date,
        ]);

        $new_logs->save();

        return redirect('approved_instructor')->with('success', 'Successfully approved selected instructor');
    }

    public function profile_add_image(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $user_image = $request->file('user_image');
        $user_image_name = 'user_image-' . time() . '.' . $user_image->getClientOriginalExtension();
        $path_user_image = $user_image->storeAs('public', $user_image_name);

        $user_data = User::find(auth()->user()->id);
        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => $user_data->name . " " . $user_data->last_name . ' Updated his/her Profile Image ',
            'created_at' => $date,
        ]);

        $new_logs->save();

        User::where('id', $request->input('user_id'))
            ->update([
                'user_image' => $user_image_name,
            ]);

        return redirect('profile')->with('success', 'Successfully approved selected admin');
    }

    public function approved_instructor_suspend($user_id)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        User::where('id', $user_id)
            ->update([
                'status' => 'Suspended',
            ]);

        $user_data = User::find(auth()->user()->id);

        $user = User::find($user_id);
        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => $user_data->name . " " . $user_data->last_name . ' Suspended Instructor ' . $user->name . " " . $user->last_name,
            'created_at' => $date,
        ]);

        $new_logs->save();

        return redirect('approved_instructor')->with('success', 'Successfully suspended selected instructor');
    }

    public function courses()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $courses = Course::orderBy('id', 'desc')->get();
        $user_data = User::find(auth()->user()->id);


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Courses',
            'created_at' => $date,
        ]);

        $new_logs->save();

        return view('courses', [
            'courses' => $courses,
            'user_data' => $user_data,
        ]);
    }

    public function course_update($course_id, $status)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $course_data = Course::find($course_id);

        if ($status == 'Pending Approval') {
            Course::where('id', $course_id)
                ->update([
                    'status' => 'Approved',
                ]);

            $user_data = User::find(auth()->user()->id);

            $new_logs = new User_logs([
                'user_id' => auth()->user()->id,
                'description' =>  $user_data->name . " " . $user_data->last_name . 'Updated Course ' . $course_data->course_title . ' to approve
                d',
                'created_at' => $date,
            ]);

            $new_logs->save();


            return redirect('courses')->with('success', 'Successfully Change Status To Approved');
        } else {
            Course::where('id', $course_id)
                ->update([
                    'status' => 'Pending Approval',
                ]);

            $user_data = User::find(auth()->user()->id);

            $new_logs = new User_logs([
                'user_id' => auth()->user()->id,
                'description' =>  $user_data->name . " " . $user_data->last_name . 'Updated Course ' . $course_data->course_title . ' to    Pending Approval',
                'created_at' => $date,
            ]);

            $new_logs->save();

            return redirect('courses')->with('success', 'Successfully Change Status To Pending Approval');
        }
    }



    public function student_list()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $user_data = User::find(auth()->user()->id);
        $students = User::where('user_type', 'Student')->get();


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Student List',
            'created_at' => $date,
        ]);

        $new_logs->save();

        return view('student_list', [
            'user_data' => $user_data,
            'students' => $students,
        ]);
    }

    public function suspend_student($user_id, $status)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        if ($status == 'Activated') {
            User::where('id', $user_id)
                ->update([
                    'status' => 'Suspended',
                ]);

            $user_data = User::find(auth()->user()->id);

            $user = User::find($user_id);
            $new_logs = new User_logs([
                'user_id' => auth()->user()->id,
                'description' => $user_data->name . " " . $user_data->last_name . ' Suspended Student ' . $user->name . " " . $user->last_name,
                'created_at' => $date,
            ]);

            $new_logs->save();

            return redirect('student_list')->with('success', 'Successfully suspended selected student');
        } else {
            User::where('id', $user_id)
                ->update([
                    'status' => null,
                ]);

            $user_data = User::find(auth()->user()->id);

            $user = User::find($user_id);
            $new_logs = new User_logs([
                'user_id' => auth()->user()->id,
                'description' => $user_data->name . " " . $user_data->last_name . ' Un-Suspend Student ' . $user->name . " " . $user->last_name,
                'created_at' => $date,
            ]);

            $new_logs->save();

            return redirect('student_list')->with('success', 'Successfully activated selected instructor');
        }
    }

    public function payment_history()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $user_data = User::find(auth()->user()->id);
        $payment = Payment::orderBy('id', 'desc')->where('status', 'paid')->get();

        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Payment History',
            'created_at' => $date,
        ]);

        $new_logs->save();


        return view('payment_history', [
            'user_data' => $user_data,
            'payment' => $payment,
        ]);
    }

    public function course_type_edit_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        Course_type::where('id', $request->input('course_type_id'))
            ->update(['course_type' => $request->input('course_type')]);

        return redirect('course_type')->with('success', 'Successfully edited selected course type');
    }

    public function statistics()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');


        $new_logs = new User_logs([
            'user_id' => auth()->user()->id,
            'description' => 'View Statistics',
            'created_at' => $date,
        ]);

        $new_logs->save();


        $user_data = User::find(auth()->user()->id);


        date_default_timezone_set('Asia/Manila');
        $year = date('Y');
        $month = date('m');
        $month_label_for_agent_performance = date('F');
        $daysCount = Carbon::createFromDate($year, $month, 1)->daysInMonth;

        $monthly_sales = Enrolled_course::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('student_id as total_sales'),
        )->where(DB::raw('date(created_at)'), '>=', $year . "-01-01")
            ->groupBy('year')
            ->groupBy('month')
            ->get()
            ->toArray();

        if (count($monthly_sales) != 0) {
            foreach ($monthly_sales as $monthly_sales_result) {
                $dateObj   = DateTime::createFromFormat('!m', $monthly_sales_result['month']);
                $monthName = $dateObj->format('F'); // March
                $month_label[] = $monthName;
                $monthly_total_enrolled[] = round($monthly_sales_result['total_sales'], 2);
            }
        } else {
            $month_label[] = 0;
            $monthly_total_enrolled[] =  0;
        }

        return view('statistics', [
            'user_data' => $user_data,
            'month_label' => $month_label,
            'monthly_total_enrolled' => $monthly_total_enrolled,

        ]);
    }
}
