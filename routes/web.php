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

Auth::routes();

Route::get('/tutorial', 'Esocial_controller@tutorial')->name('tutorial');
Route::post('/tutorial_process', 'Esocial_controller@tutorial_process')->name('tutorial_process');
Route::get('/course_type', 'Esocial_controller@course_type')->name('course_type');
Route::post('/course_process', 'Esocial_controller@course_process')->name('course_process');
Route::get('/approved_instructor', 'Esocial_controller@approved_instructor')->name('approved_instructor');
Route::get('/approved_instructor_process/{id}', 'Esocial_controller@approved_instructor_process')->name('approved_instructor_process');
Route::post('/profile_add_image', 'Esocial_controller@profile_add_image')->name('profile_add_image');



Route::get('/student_landing', 'Student_controller@student_landing')->name('student_landing');
Route::get('/student_course', 'Student_controller@student_course')->name('student_course');
Route::get('/student_profile', 'Student_controller@student_profile')->name('student_profile');

Route::post('/student_profile_add_image', 'Esocial_controller@student_profile_add_image')->name('student_profile_add_image');






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




// Route::get('/instructor_add_course_file_process/{course_id}', 'Instructor_controller@instructor_add_course_file_process')->name('instructor_add_course_file_process');











Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
