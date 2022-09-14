@extends('layouts.student')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @foreach ($invitation as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;margin-bottom:50px;background-color:gainsboro">
                    <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">
                        {{ $data->course->course_type->course_type }} -
                        {{ $data->course->course_title }}</div>
                    <img class="card-img-top" style="border-radius: 0px;"
                        src="{{ asset('/storage/' . $data->course->image_template) }}" alt="Card image cap">
                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course->course_description }}</p>
                    </div>
                    <div class="card-body">
                        @if ($data->course->course_monitization == 'Free')
                            <form action="{{ route('student_enroll_course') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $data->course->id }}" name="course_id">
                                <input type="hidden" value="{{ $data->course->user_id }}" name="instructor_id">
                                <input type="hidden" value="{{ $data->course->course_amount }}" name="amount">
                                <input type="hidden" value="{{ $data->id }}" name="invitation_id">

                                <button class="btn btn-primary btn-block btn-sm" type="submit">Enroll</button>
                            </form>
                        @else
                            <form action="{{ route('student_subscribed_course') }}" method="post">
                                @csrf

                                <input type="hidden" value="{{ $data->course->id }}" name="course_id">
                                <input type="hidden" value="{{ $data->course->user_id }}" name="instructor_id">
                                <input type="hidden" value="{{ $data->course->course_amount }}" name="amount">
                                <input type="hidden" value="{{ $data->id }}" name="invitation_id">

                                <button class="btn btn-primary btn-block btn-sm" type="submit">Subscribed</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-footer" style="background-color:#141E30"">
                        <p style="color:white"> You are invited by Instructor: {{ $data->course->user->name }} {{ $data->course->user->last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
