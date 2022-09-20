<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $user_type = User::find(auth()->user()->id);
        $user_data = User::find(auth()->user()->id);

        if ($user_type->user_type == "Admin") {
            $widget = [
                'users' => $users,
            ];
            return redirect('payment_history')->with('user_data', $user_data);
        } elseif($user_type->user_type == "Student") {
            return redirect('student_landing');
        }else{
            return redirect('instructor_landing');
        }
    }
}
