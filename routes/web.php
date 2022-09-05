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

Route::get('/student_landing', 'Student_controller@student_landing')->name('student_landing');
Route::get('/student_course', 'Student_controller@student_course')->name('student_course');


Route::get('/instructor_landing', 'Instructor_controller@instructor_landing')->name('instructor_landing');









Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
