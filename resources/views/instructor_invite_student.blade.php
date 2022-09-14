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
        <div class="card-header">List of Students that are not enrolled on this course</div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $data)
                        <tr>
                            <td>{{ $data->name }}{{ $data->last_name }}</td>
                            <td><a href="{{ url('instructor_invite_student_process',[
                                'course_id' => $course_id,
                                'student_id' => $data->id,
                                ]) }}" class="btn btn-block btn-sm btn-success">Invite</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
