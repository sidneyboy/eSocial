@extends('layouts.instructor')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Student Enrolled On Your Courses</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover table-sm" id="example">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Course Type</th>
                            <th>Enrolled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrolled as $data)
                            <tr>
                                <td>
                                    <a href="{{ url('instructor_student_logs', [
                                        'student_id' => $data->student_id,
                                        'course_id' => $data->course_id,
                                    ]) }}"
                                        target="_blank">{{ $data->student->last_name }} {{ $data->student->name }}
                                    </a>
                                </td>
                                <td>{{ $data->student->email }}</td>
                                <td>{{ $data->course->course_title }}</td>
                                <td>{{ $data->course->course_type->course_type }}</td>
                                <td>{{ date('F j, Y', strtotime($data->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ url('instructor_view_assignment_score',['type' => 'assignment']) }}" class="btn btn-block btn-primary btn-sm">View All Student Assignment Score</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('instructor_view_assignment_score',['type' => 'quiz']) }}" class="btn btn-block btn-primary btn-sm">View All Student Quiz Score</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('instructor_view_assignment_score',['type' => 'exam']) }}" class="btn btn-block btn-primary btn-sm">View All Student Exam Score</a>
                </div>
            </div>
        </div>
    </div>
@endsection
