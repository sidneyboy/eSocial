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
        <div class="card-header">Student Messages</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($enrolled_student as $data)
                    <li class="list-group-item">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                            data-target="#exampleModal{{ $data->id }}">
                            {{ $data->student->name }} {{ $data->student->last_name }} <span class="badge badge-light">{{ count($count[$data->student_id]) }} New Message</span>
                        </button>


                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Direct Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('instructor_message_process') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div id="table-wrapper">
                                                <div id="table-scroll">
                                                    <table>
                                                        <tbody>
                                                            @foreach ($direct_message as $dm)
                                                                <tr>
                                                                    <td>
                                                                        @if ($dm->user_id == $data->student_id)
                                                                            @if ($dm->status != 'replied')
                                                                                <input type="hidden"
                                                                                    value="{{ $dm->id }}"
                                                                                    name="dm_id[]">
                                                                            @endif
                                                                            @if ($dm->user_typer == 'Student')
                                                                                <div class="alert alert-success"
                                                                                    role="alert">
                                                                                    <h6 class="alert-heading">
                                                                                        {{ $dm->student->name }}
                                                                                        {{ $dm->student->last_name }}

                                                                                    </h6>
                                                                                    <hr>
                                                                                    <p>{{ $dm->comment }}
                                                                                    </p>
                                                                                    @if ($dm->file != null)
                                                                                        <img src="{{ asset('/storage/' . $dm->file) }}"
                                                                                            class="img img-thumbnail"
                                                                                            alt="">
                                                                                    @endif
                                                                                    <hr>
                                                                                    <p class="mb-0">
                                                                                        {{ date('F j, Y H:i a', strtotime($dm->created_at)) }}
                                                                                    </p>
                                                                                </div>
                                                                            @else
                                                                                <div class="alert alert-warning"
                                                                                    role="alert">
                                                                                    <h6 class="alert-heading">
                                                                                        {{ $dm->instructor->name }}
                                                                                        {{ $dm->instructor->last_name }}

                                                                                    </h6>
                                                                                    <hr>
                                                                                    <p>{{ $dm->comment }}
                                                                                    </p>
                                                                                    @if ($dm->file != null)
                                                                                        <img src="{{ asset('/storage/' . $dm->file) }}"
                                                                                            class="img img-thumbnail"
                                                                                            alt="">
                                                                                    @endif
                                                                                    <hr>
                                                                                    <p class="mb-0">
                                                                                        {{ date('F j, Y H:i a', strtotime($dm->created_at)) }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Write Message</label>
                                                <textarea name="comment" class="form-control"></textarea>
                                                <input type="hidden" value="{{ $data->student_id }}" name="student_id">

                                                <label>Attachment</label>
                                                <input type="file" class="form-control" accept="image/*,video/*"
                                                    name="message_file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
