@extends('layouts.student')

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('student_search_course') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Subject" aria-label="Search Subject"
                        name="search_box" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @foreach ($course as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;margin-bottom:50px;background-color:antiquewhite">
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
                            <ul class="list-group">
                                @foreach ($data->course_details as $details)
                                    @php
                                        $explode = explode('/', $details->file_type);
                                        $file_type = $explode[0];
                                    @endphp
                                    <li class="list-group-item">
                                        @if ($file_type == 'application')
                                            <a target="_blank"
                                                href="{{ url('instructor_show_pdf_file', ['details_id' => $details->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open PDF File</a>
                                        @elseif($file_type == 'video')
                                            <a target="_blank"
                                                href="{{ url('instructor_show_video', ['details_id' => $details->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Video File</a>
                                        @elseif($file_type == 'image')
                                            <a target="_blank"
                                                href="{{ url('instructor_show_image', ['details_id' => $details->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Video File</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer" style="background-color:#141E30"">
                        <p style="color:white">Instructor: {{ $data->user->name }} {{ $data->user->last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
