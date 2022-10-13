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
    <div class="row">
        @foreach ($course as $data)
            <div class="col-md-4">
                <div class="card" style="width: 100%;height:100%;margin-bottom:50px;background-color:gainsboro">
                    <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">
                        <div class="row">
                            <div class="col-md-12">
                                {{ $data->course_type->course_type }} -
                                {{ $data->course_title }}
                            </div>
                            {{-- <div class="col-md-6">
                                Comments <span class="badge badge-primary">New {{ count($data->comments_count) }}</span>
                            </div> --}}
                        </div>
                    </div>
                    <a href="{{ url('instructor_show_chapter', ['course_id' => $data->id]) }}">
                        <img class="card-img-top" style="border-radius: 0px;"
                            src="{{ asset('/storage/' . $data->image_template) }}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <p style="text-align: justify">{{ $data->course_description }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <a href="{{ url('instructor_add_course_phase_2', [$data->id]) }}"
                                    class="btn btn-sm btn-block btn-info">ADD CHAPTER</a>
                            </div>
                            <div class="col-md-12">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                    data-target="#exampleModal{{ $data->id }}">
                                    ADD EXAM/QUIZ/ASSIGNMENT
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ADD CHAPTER ACTIVITY</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('instructor_chapter_add_quiz_or_exam') }}" method="get"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <label>Add</label>
                                                    <select name="type" id="type" class="form-control" required>
                                                        <option value="" default>Select</option>
                                                        <option value="Chapter Exam">Chapter Exam</option>
                                                        <option value="Chapter Quiz">Chapter Quiz</option>
                                                        <option value="Chapter Assignment">Chapter Assignment</option>
                                                    </select>

                                                    <label>Chapter</label>
                                                    <select name="chapter_id" class="form-control" required>
                                                        <option value="" default>Select</option>
                                                        @foreach ($data->course_chapter as $chapter)
                                                            <option value="{{ $chapter->id }}">
                                                                {{ $chapter->chapter_number }} - {{ $chapter->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="course_id" value="{{ $data->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Proceed</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
