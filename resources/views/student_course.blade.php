@extends('layouts.student')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('student_search_course') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Subject" aria-label="Search Subject"
                        name="search_box" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        {{-- <span class="input-group-text" id="basic-addon2"></span> --}}
                        <button class="input-group-text"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($course as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;margin-bottom:50px;background-color:gainsboro">
                    <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">
                        {{ $data->course_type->course_type }} -
                        {{ $data->course_title }}</div>
                    <img class="card-img-top" style="border-radius: 0px;"
                        src="{{ asset('/storage/' . $data->image_template) }}" alt="Card image cap">

                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course_description }}</p>
                    </div>
                    <div class="card-body">
                        @if ($data->course_monitization == 'Free')
                            <form action="{{ route('student_enroll_course') }}" method="post">
                                @csrf

                                <input type="hidden" value="{{ $data->id }}" name="course_id">
                                <input type="hidden" value="{{ $data->user_id }}" name="instructor_id">
                                <input type="hidden" value="{{ $data->course_amount }}" name="amount">

                                <button class="btn btn-primary btn-block btn-sm" type="submit">Enroll</button>
                            </form>
                        @else
                            <form action="{{ route('student_subscribed_course') }}" method="post">
                                @csrf

                                <input type="hidden" value="{{ $data->id }}" name="course_id">
                                <input type="hidden" value="{{ $data->user_id }}" name="instructor_id">
                                <input type="hidden" value="{{ $data->course_amount }}" name="amount">

                                <button class="btn btn-primary btn-block btn-sm" type="submit">Subscribed</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-footer" style="background-color:#141E30"">
                        <p style="color:white"> Instructor: {{ $data->user->name }} {{ $data->user->last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
