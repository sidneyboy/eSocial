<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/login', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/tutorial', 'Esocial_controller@tutorial')->name('tutorial');
Route::post('/tutorial_process', 'Esocial_controller@tutorial_process')->name('tutorial_process');
Route::get('/course_type', 'Esocial_controller@course_type')->name('course_type');
Route::post('/course_process', 'Esocial_controller@course_process')->name('course_process');
Route::get('/approved_instructor', 'Esocial_controller@approved_instructor')->name('approved_instructor');
Route::get('/approved_instructor_process/{id}', 'Esocial_controller@approved_instructor_process')->name('approved_instructor_process');
Route::post('/profile_add_image', 'Esocial_controller@profile_add_image')->name('profile_add_image');
Route::post('/student_profile_add_image', 'Esocial_controller@student_profile_add_image')->name('student_profile_add_image');
Route::get('/approved_instructor_suspend/{user_id}', 'Esocial_controller@approved_instructor_suspend')->name('approved_instructor_suspend');
Route::get('/student_list', 'Esocial_controller@student_list')->name('student_list');
Route::get('/suspend_student/{user_id}/{status}', 'Esocial_controller@suspend_student')->name('suspend_student');
Route::get('/payment_history', 'Esocial_controller@payment_history')->name('payment_history');




Route::get('/student_landing', 'Student_controller@student_landing')->name('student_landing');
Route::get('/student_course', 'Student_controller@student_course')->name('student_course');
Route::get('/student_profile', 'Student_controller@student_profile')->name('student_profile');
Route::get('/student_search_course', 'Student_controller@student_search_course')->name('student_search_course');
Route::post('/student_comment_process', 'Student_controller@student_comment_process')->name('student_comment_process');
Route::get('/student_show_image_file/{course_id}', 'Student_controller@student_show_image_file')->name('student_show_image_file');
Route::get('/student_show_pdf_file/{course_id}', 'Student_controller@student_show_pdf_file')->name('student_show_pdf_file');
Route::get('/student_show_video/{course_id}', 'Student_controller@student_show_video')->name('student_show_video');
Route::post('/student_message_process', 'Student_controller@student_message_process')->name('student_message_process');
Route::get('/student_direct_message', 'Student_controller@student_direct_message')->name('student_direct_message');
Route::get('/student_show_exam/{course_id}', 'Student_controller@student_show_exam')->name('student_show_exam');
Route::post('/student_exam_process', 'Student_controller@student_exam_process')->name('student_exam_process');
Route::post('/student_enroll_course', 'Student_controller@student_enroll_course')->name('student_enroll_course');
Route::get('/student_enrolled_courses', 'Student_controller@student_enrolled_courses')->name('student_enrolled_courses');
Route::get('/student_enrolled_search_course', 'Student_controller@student_enrolled_search_course')->name('student_enrolled_search_course');
Route::get('/student_answer_exam/{exam_id}/{instructor_id}/{course_id}', 'Student_controller@student_answer_exam')->name('student_answer_exam');
Route::post('/student_answer_exam_process', 'Student_controller@student_answer_exam_process')->name('student_answer_exam_process');
Route::get('/student_answer_exam_proceed/{student_exam_id}', 'Student_controller@student_answer_exam_proceed')->name('student_answer_exam_proceed');
Route::get('/student_answer_exam_finalized/{student_exam_id}', 'Student_controller@student_answer_exam_finalized')->name('student_answer_exam_finalized');
Route::get('/student_show_certificate', 'Student_controller@student_show_certificate')->name('student_show_certificate');
Route::get('/student_instructor_invitation', 'Student_controller@student_instructor_invitation')->name('student_instructor_invitation');
Route::post('/student_answer_exam_process', 'Student_controller@student_answer_exam_process')->name('student_answer_exam_process');

Route::get('/student_to_do', 'Student_controller@student_to_do')->name('student_to_do');
Route::post('/student_todo_process', 'Student_controller@student_todo_process')->name('student_todo_process');
Route::get('/student_to_do_list', 'Student_controller@student_to_do_list')->name('student_to_do_list');
Route::get('/student_planner_approved/{planner_id}', 'Student_controller@student_planner_approved')->name('student_planner_approved');
Route::post('/student_planner_prompt', 'Student_controller@student_planner_prompt')->name('student_planner_prompt');










Route::post('/student_subscribed_course/', 'Student_subscribed_controller@student_subscribed_course')->name('student_subscribed_course');
Route::get('/success/', 'Student_subscribed_controller@success');
Route::get('/error/', 'Student_subscribed_controller@error');




Route::get('/instructor_landing', 'Instructor_controller@instructor_landing')->name('instructor_landing');
Route::get('/instructor_profile', 'Instructor_controller@instructor_profile')->name('instructor_profile');
Route::get('/instructor_add_course', 'Instructor_controller@instructor_add_course')->name('instructor_add_course');
Route::post('/instructor_add_course_process', 'Instructor_controller@instructor_add_course_process')->name('instructor_add_course_process');
Route::get('/instructor_add_course_phase_2/{course_id}', 'Instructor_controller@instructor_add_course_phase_2')->name('instructor_add_course_phase_2');
Route::post('/instructor_add_course_phase_2_process', 'Instructor_controller@instructor_add_course_phase_2_process')->name('instructor_add_course_phase_2_process');
Route::get('/instructor_courses', 'Instructor_controller@instructor_courses')->name('instructor_courses');
Route::post('/instructor_add_subject_file', 'Instructor_controller@instructor_add_subject_file')->name('instructor_add_subject_file');
Route::post('/instructor_profile_add_image', 'Instructor_controller@instructor_profile_add_image')->name('instructor_profile_add_image');
Route::post('/instructor_update_course', 'Instructor_controller@instructor_update_course')->name('instructor_update_course');
Route::get('/instructor_show_pdf_file/{course_id}', 'Instructor_controller@instructor_show_pdf_file')->name('instructor_show_pdf_file');
Route::get('/instructor_show_video/{course_id}', 'Instructor_controller@instructor_show_video')->name('instructor_show_video');
Route::get('/instructor_show_image/{course_id}', 'Instructor_controller@instructor_show_image')->name('instructor_show_image');
Route::post('/instructor_comment_process/', 'Instructor_controller@instructor_comment_process')->name('instructor_comment_process');
Route::post('/instructor_add_exam/', 'Instructor_controller@instructor_add_exam')->name('instructor_add_exam');
Route::post('/instructor_add_exam_next_page/', 'Instructor_controller@instructor_add_exam_next_page')->name('instructor_add_exam_next_page');
Route::post('/instructor_add_exam_next_page_process/', 'Instructor_controller@instructor_add_exam_next_page_process')->name('instructor_add_exam_next_page_process');
Route::get('/instructor_view_exam/{course_id}', 'Instructor_controller@instructor_view_exam')->name('instructor_view_exam');
Route::post('/instructor_add_exam_certificate/', 'Instructor_controller@instructor_add_exam_certificate')->name('instructor_add_exam_certificate');
Route::get('/instructor_students/', 'Instructor_controller@instructor_students')->name('instructor_students');
Route::get('/instructor_direct_message/', 'Instructor_controller@instructor_direct_message')->name('instructor_direct_message');
Route::post('/instructor_message_process/', 'Instructor_controller@instructor_message_process')->name('instructor_message_process');
Route::get('/instructor_invite_student/{course_id}', 'Instructor_controller@instructor_invite_student')->name('instructor_invite_student');
Route::get('/instructor_invite_student_process/{course_id}/{student_id}', 'Instructor_controller@instructor_invite_student_process')->name('instructor_invite_student_process');
Route::get('/intructor_to_do/', 'Instructor_controller@intructor_to_do')->name('intructor_to_do');
Route::get('/instructor_show_image/{course_id}', 'Instructor_controller@instructor_show_image')->name('instructor_show_image');
Route::post('/instructor_todo_process/', 'Instructor_controller@instructor_todo_process')->name('instructor_todo_process');
Route::get('/instructor_to_do_list/', 'Instructor_controller@instructor_to_do_list')->name('instructor_to_do_list');
Route::post('/planner_prompt/', 'Instructor_controller@planner_prompt')->name('planner_prompt');

Route::get('/planner_approved/{planner_id}', 'Instructor_controller@planner_approved')->name('planner_approved');












// Route::get('/instructor_add_course_file_process/{course_id}', 'Instructor_controller@instructor_add_course_file_process')->name('instructor_add_course_file_process');











Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
