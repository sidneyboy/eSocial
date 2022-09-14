@extends('layouts.student')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">Instructors</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($instructors as $data)
                    <li class="list-group-item">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                            data-target="#exampleModal_direct_message{{ $data->id }}">
                            Direct Message -
                            {{ $data->name }} {{ $data->last_name }} <span class="badge badge-light">
                                {{-- @if (count($count[$data->id]) != 0)
                                    New Message
                                @endif --}}
                                @if (empty($count_message[$data->id]))
                                    {{ $count_message[$data->id] }}
                                @else
                                    0
                                @endif
                            </span>
                        </button>
                        <div class="modal fade" id="exampleModal_direct_message{{ $data->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Direct Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('student_message_process') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div id="table-wrapper">
                                                <div id="table-scroll">
                                                    <table>
                                                        <tbody>
                                                            @foreach ($message as $dm)
                                                                <tr>
                                                                    <td>
                                                                        @if ($dm->instructor_id == $data->id)
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
                                                <input type="hidden" value="{{ $data->id }}" required name="instructor_id">

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
