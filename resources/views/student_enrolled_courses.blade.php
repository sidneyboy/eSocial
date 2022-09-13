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
    @if (isset($course))
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('student_enrolled_search_course') }}">
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
                            <button class="btn btn-primary btn-sm btn-block" style="border-radius: 0px;border:0px;"
                                type="button" data-toggle="collapse" data-target="#collapseExample{{ $data->id }}"
                                aria-expanded="false" aria-controls="collapseExample{{ $data->id }}">
                                Show
                            </button>
                            <div class="collapse" id="collapseExample{{ $data->id }}">
                                <div class="card card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-block btn-sm"
                                                style="text-decoration: none;" data-toggle="modal"
                                                data-target="#exampleModal_show_comment{{ $data->id }}">
                                                View Comment
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal_show_comment{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('student_comment_process') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div id="table-wrapper">
                                                                    <div id="table-scroll">
                                                                        <table>
                                                                            <tbody>
                                                                                @foreach ($data->comments as $comment_details)
                                                                                    <tr>
                                                                                        <td>
                                                                                            @if ($comment_details->user->user_type == 'Student')
                                                                                                <div class="alert alert-success"
                                                                                                    role="alert">
                                                                                                    <h6
                                                                                                        class="alert-heading">
                                                                                                        {{ $comment_details->user->name }}
                                                                                                        {{ $comment_details->user->last_name }}
                                                                                                        -
                                                                                                        {{ $comment_details->user->user_type }}
                                                                                                    </h6>
                                                                                                    <hr>
                                                                                                    <p>{{ $comment_details->comment }}
                                                                                                    </p>
                                                                                                    <hr>
                                                                                                    <p class="mb-0">
                                                                                                        {{ date('F j, Y H:i a', strtotime($comment_details->created_at)) }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="alert alert-warning"
                                                                                                    role="alert">
                                                                                                    <h6
                                                                                                        class="alert-heading">
                                                                                                        {{ $comment_details->user->name }}
                                                                                                        {{ $comment_details->user->last_name }}
                                                                                                        -
                                                                                                        {{ $comment_details->user->user_type }}
                                                                                                    </h6>
                                                                                                    <hr>
                                                                                                    <p>{{ $comment_details->comment }}
                                                                                                    </p>
                                                                                                    <hr>
                                                                                                    <p class="mb-0">
                                                                                                        {{ date('F j, Y H:i a', strtotime($comment_details->created_at)) }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            @endif
                                                                                            <input type="hidden"
                                                                                                name="comment_details[]"
                                                                                                value="{{ $comment_details->id }}">
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Write Comment</label>
                                                                <textarea name="comment" class="form-control"></textarea>
                                                                <input type="hidden" name="course_id"
                                                                    value="{{ $data->id }}">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ url('student_show_exam', ['course_id' => $data->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Exam</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ url('student_show_pdf_file', ['course_id' => $data->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Files</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ url('student_show_image_file', ['course_id' => $data->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Images</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ url('student_show_video', ['course_id' => $data->id]) }}"
                                                class="btn btn-sm btn-primary btn-block">Open Videos</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background-color:#141E30"">
                            <p style="color:white"> Instructor: {{ $data->user->name }} {{ $data->user->last_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
