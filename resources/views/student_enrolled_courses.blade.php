@extends('layouts.student')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-left-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <h6 style="font-weight: bold;">ENROLLED COURSES</h6>
    @if (isset($course))
        <div class="row">
            @foreach ($course as $data)
                <div class="col-md-4">
                    <div class="card" style="width: 100%;height:100%;margin-bottom:50px;background-color:gainsboro">
                        <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">
                            {{ $data->course_type->course_type }} -
                            {{ $data->course_title }}</div>
                        <a href="{{ url('student_show_course_chapter', ['course_id' => $data->id]) }}">
                            <img class="card-img-top" style="border-radius: 0px;"
                                src="{{ asset('/storage/' . $data->image_template) }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <p style="text-align: justify">{{ $data->course_description }}</p>
                        </div>
                        <div class="card-footer" style="background-color:#141E30"">

                            <p style="color:white"> Instructor: {{ $data->user->name }} {{ $data->user->last_name }}
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


@endsection
