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

    @foreach ($course as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;margin-bottom:50px;background-color:gainsboro">
                    <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">
                        <div class="row">
                            <div class="col-md-6">
                                {{ $data->course_type->course_type }} -
                                {{ $data->course_title }}
                            </div>
                            <div class="col-md-6">
                                Comments <span class="badge badge-primary">New {{ count($data->comments_count) }}</span>
                            </div>
                        </div>
                    </div>
                    <img class="card-img-top" style="border-radius: 0px;"
                        src="{{ asset('/storage/' . $data->image_template) }}" alt="Card image cap">
                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course_description }}</p>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary btn-sm btn-block" type="button" data-toggle="collapse"
                            data-target="#collapseExample{{ $data->id }}" aria-expanded="false"
                            aria-controls="collapseExample{{ $data->id }}">
                            Show
                        </button>
                        <div class="collapse" id="collapseExample{{ $data->id }}">
                            <div class="card card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal"
                                            data-target="#exampleModal_add_exam{{ $data->id }}">
                                            Exam (+)
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_add_exam{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Course Exam
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_add_exam') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label>Number of question</label>
                                                            <input type="number" min="1" value="1"  class="form-control" name="number_of_exams" required>
                                                            <input type="hidden" value="{{ $data->id }}"
                                                                name="course_id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Proceed</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal"
                                            data-target="#exampleModal_subject_data{{ $data->id }}">
                                            Update Title and Description
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_subject_data{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Course File
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_update_course') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Course Title</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $data->course_title }}"
                                                                    name="update_course_title">
                                                                <label>Course Description</label>
                                                                <textarea class="form-control" name="update_course_description" id="" cols="30" rows="5">{{ $data->course_description }}</textarea>
                                                                <input type="hidden" value="{{ $data->id }}"
                                                                    name="course_id">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm btn-block"
                                            data-toggle="modal"
                                            data-target="#exampleModal_add_subject_file{{ $data->id }}">
                                            File (+)
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_add_subject_file{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Course File
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_add_subject_file') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="file" accept="image/*,video/*,application/pdf"
                                                                class="form-control" required name="subject_file">
                                                            <input type="hidden" value="{{ $data->id }}"
                                                                name="course_id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ url('instructor_view_exam',['course_id'=>$data->id]) }}" class="btn btn-sm btn-block btn-primary">View Exam</a>
                                    </li>
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
                                                    <form action="{{ route('instructor_comment_process') }}"
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
                                                                                                <h6 class="alert-heading">
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
                                                                                                <h6 class="alert-heading">
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
                                        <a href="{{ url('instructor_show_pdf_file', ['course_id' => $data->id]) }}"
                                            class="btn btn-sm btn-primary btn-block">Open Files</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ url('instructor_show_image_file', ['course_id' => $data->id]) }}"
                                            class="btn btn-sm btn-primary btn-block">Open Images</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ url('instructor_show_video', ['course_id' => $data->id]) }}"
                                            class="btn btn-sm btn-primary btn-block">Open Videos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
