@extends('layouts.admin')

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
        <div class="card-header">Instructor Posted Courses</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-striped table-hover table-sm" id="example">
                    <thead>
                        <tr>
                            <th>Course Type</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Monitization Free</th>
                            <th>Instructor</th>
                            <th>Created at</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $data)
                            <tr>
                                <td>{{ $data->course_type->course_type }}</td>
                                <td>{{ $data->course_title }}</td>
                                <td>{{ $data->course_description }}</td>
                                <td>{{ $data->course_description }}</td>
                                <td>{{ $data->user->last_name }} {{ $data->user->name }}</td>
                                <td>{{ date('F j, Y ', strtotime($data->created_at)) }}</td>
                                <td>
                                    @if ($data->status == 'Pending Approval')
                                        <a href="{{ url('course_update', ['course_id' => $data->id, 'status' => $data->status]) }}"
                                            class="btn btn-sm btn-warning btn-block">{{ $data->status }}</a>
                                    @else
                                        <a href="{{ url('course_update', ['course_id' => $data->id, 'status' => $data->status]) }}"
                                            class="btn btn-sm btn-success btn-block">{{ $data->status }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
