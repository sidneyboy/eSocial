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
                <div class="card" style="width: 100%;margin-bottom:30px;">
                    <div class="card-header" style="font-weight: bold;">{{ $data->course_type->course_type }} -
                        {{ $data->course_title }}</div>
                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course_description }}</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal"
                                    data-target="#exampleModal_subject_data{{ $data->id }}">
                                    Update Title and Description
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_subject_data{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Course File</h5>
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
                                                        <input type="text" class="form-control" value="{{ $data->course_title }}"
                                                            name="update_course_title">
                                                        <label>Course Description</label>
                                                        <input type="text" class="form-control" value="{{ $data->course_description }}"
                                                            name="update_course_description">
                                                        <input type="hidden" value="{{ $data->id }}" name="course_id">
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
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal"
                                    data-target="#exampleModal_add_subject_file{{ $data->id }}">
                                    File (+)
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_add_subject_file{{ $data->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Course File</h5>
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
                                                    <input type="hidden" value="{{ $data->id }}" name="course_id">
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
                            @foreach ($data->course_details as $details)
                                @php
                                    $explode = explode('/', $details->file_type);
                                    $file_type = $explode[0];
                                @endphp
                                @if ($file_type == 'application')
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModal_pdf{{ $details->id }}">
                                            {{ $details->file }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" style="height:100%;"
                                            id="exampleModal_pdf{{ $details->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe src="{{ asset('/storage/' . $details->file) }}"
                                                            frameborder="0" height="1000" width="100%"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($file_type == 'image')
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModal_image{{ $details->id }}">
                                            {{ $details->file }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" style="height:100%;"
                                            id="exampleModal_image{{ $details->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">


                                                        <img src="{{ asset('/storage/' . $details->file) }}"
                                                            class="img img-thumbnail" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($file_type == 'video')
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModal_video{{ $details->id }}">
                                            {{ $details->file }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" style="height:100%;"
                                            id="exampleModal_video{{ $details->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ asset('/storage/' . $details->file) }}"
                                                                type="{{ $details->file_type }}">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
