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
                                <td>{{ $data->student->last_name }} {{ $data->student->name }}</td>
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
    </div>
@endsection
