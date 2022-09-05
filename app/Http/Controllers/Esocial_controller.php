<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\Course_type;
use Illuminate\Http\Request;

class Esocial_controller extends Controller
{
    public function tutorial()
    {
        $tutorial = Tutorial::get();
        return view('tutorial', [
            'tutorial' => $tutorial
        ]);
    }

    public function tutorial_process(Request $request)
    {
        $tutorial_image = $request->file('tutorial_image');
        $tutorial_image_name = 'tutorial_image-' . time() . '.' . $tutorial_image->getClientOriginalExtension();
        $path_tutorial_image = $tutorial_image->storeAs('public', $tutorial_image_name);

        $new = new Tutorial([
            'tutorial_image' => $tutorial_image_name,
            'tutorial_note' => $request->input('tutorial_note'),
        ]);

        $new->save();

        return redirect('tutorial')->with('success', 'Successfully added new tutorial');
    }

    public function course_type()
    {
        $course_type = Course_type::get();
        return view('course_type',[
            'course_type' => $course_type,
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
}
