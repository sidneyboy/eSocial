@extends('layouts.instructor')

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                @foreach ($course_chapter as $data)
                    <div class="col-md-6">
                        <div class="card" style="margin-bottom:20px;height:100%;">
                            <div class="card-header">Chapter {{ $data->chapter_number }} - {{ $data->title }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">{{ $data->content }}</div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-info btn-sm btn-block" style="margin-bottom: 10px;"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapseExampleattachments{{ $data->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExampleattachments{{ $data->id }}">
                                                    CHAPTER ATTACHMENTS
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-info btn-sm btn-block" style="margin-bottom: 10px;"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapseExampleexam{{ $data->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExampleexam{{ $data->id }}">
                                                    CHAPTER QUIZ/EXAM
                                                </button>
                                            </div>
                                            <div class="col-md-12" style="overflow: scroll;height:250px;">
                                                <br />
                                                <div class="collapse" id="collapseExampleattachments{{ $data->id }}">
                                                    <div class="card card-body">
                                                        <div class="table table-responsive">
                                                            <table class="table table-striped table-hover table-sm"
                                                                id="example">
                                                                <thead>
                                                                    <tr>
                                                                        <th>File Type</th>
                                                                        <th>Chapter File</th>
                                                                        <th>Created At</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->course_details as $details)
                                                                        <tr>
                                                                            @if ($details->file_type == 'image')
                                                                                <td>{{ $details->file_type }}</td>
                                                                                <td>
                                                                                    @if ($details->file_type == 'image')
                                                                                        <a href="{{ url('instructor_show_image', [
                                                                                            'course_details_id' => $details->id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-sm btn-primary btn-block">show</a>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('F j, Y h:i a', strtotime($details->created_at)) }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($details->status == 'disabled')
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-danger btn-block">{{ $details->status }}</a>
                                                                                    @else
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-success btn-block">{{ $details->status }}</a>
                                                                                    @endif
                                                                                </td>
                                                                            @elseif($details->file_type == 'video')
                                                                                <td>{{ $details->file_type }}</td>
                                                                                <td>
                                                                                    @if ($details->file_type == 'video')
                                                                                        <a href="{{ url('instructor_show_video', ['course_details_id' => $details->id]) }}"
                                                                                            class="btn btn-sm btn-primary btn-block">show</a>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('F j, Y h:i a', strtotime($details->created_at)) }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($details->status == 'disabled')
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-danger btn-block">{{ $details->status }}</a>
                                                                                    @else
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-success btn-block">{{ $details->status }}</a>
                                                                                    @endif
                                                                                </td>
                                                                            @elseif($details->file_type == 'application')
                                                                                <td>{{ $details->file_type }}</td>
                                                                                <td>
                                                                                    @if ($details->file_type == 'application')
                                                                                        <a href="{{ asset('/storage/' . $details->file) }}"
                                                                                            download
                                                                                            class="btn btn-block btn-primary btn-sm">{{ $details->file }}</a>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('F j, Y h:i a', strtotime($details->created_at)) }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($details->status == 'disabled')
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-danger btn-block">{{ $details->status }}</a>
                                                                                    @else
                                                                                        <a href="{{ url('course_details_status_update', [
                                                                                            'details_id' => $details->id,
                                                                                            'status' => $details->status,
                                                                                            'course_id' => $data->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-success btn-block">{{ $details->status }}</a>
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseExampleexam{{ $data->id }}">
                                                    <div class="card card-body">
                                                        <div class="table table-responsive">
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Created At</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->course_quiz as $quiz)
                                                                        <tr>
                                                                            <td>
                                                                                <button type="button"
                                                                                    class="btn btn-link btn-sm btn-block"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModal{{ $quiz->id }}">
                                                                                    {{ $quiz->quiz_title }}
                                                                                </button>

                                                                                <!-- Modal -->
                                                                                <div class="modal fade"
                                                                                    id="exampleModal{{ $quiz->id }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalLabel"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title"
                                                                                                    id="exampleModalLabel">
                                                                                                    {{ $quiz->quiz_title }}
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                @foreach ($quiz->quiz_question as $question)
                                                                                                    <div class="card"
                                                                                                        style="margin-bottom: 20px;">
                                                                                                        <div
                                                                                                            class="card-header">
                                                                                                            @if ($question->question_type != 'Matching Type')
                                                                                                                Question:
                                                                                                                {{ $question->question }}
                                                                                                            @else
                                                                                                                Matching
                                                                                                                Type
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-body">
                                                                                                            @if ($question->question_type == 'Enumeration')
                                                                                                                @php
                                                                                                                    $explode = explode('|', $question->answer);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answers
                                                                                                                    </li>
                                                                                                                    @foreach ($explode as $key => $value)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $value }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Multitple Choice')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>
                                                                                                                    @if ($question->answer == 'choice_a')
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            A.
                                                                                                                            {{ $question->quiz_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->quiz_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->quiz_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->quiz_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_b')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->quiz_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            B.
                                                                                                                            {{ $question->quiz_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->quiz_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->quiz_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_c')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->quiz_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->quiz_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            C.
                                                                                                                            {{ $question->quiz_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->quiz_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_d')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->quiz_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->quiz_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->quiz_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            D.
                                                                                                                            {{ $question->quiz_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @endif
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Identification')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        {{ $question->answer }}
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Matching Type')
                                                                                                                @php
                                                                                                                    $match_answer = explode('|', $question->answer);
                                                                                                                    $match_question = explode('|', $question->question);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answer
                                                                                                                    </li>

                                                                                                                    @for ($i = 0; $i < count($match_answer); $i++)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_question[$i] }}
                                                                                                                            -
                                                                                                                            {{ $match_answer[$i] }}
                                                                                                                        </li>
                                                                                                                    @endfor
                                                                                                                </ul>
                                                                                                                <br />
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>
                                                                                                                    @foreach ($question->quiz_matching as $match_choices)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_choices->choices }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-footer">
                                                                                                            <a href="{{ url('instructor_edit_quiz_question', ['question_id' => $question->id]) }}"
                                                                                                                class="btn btn-primary btn-sm float-right">Edit</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <a href="{{ url('instructor_add_item_to_quiz', ['quiz_id' => $quiz->id]) }}"
                                                                                                    class="btn btn-sm btn-primary">Quiz
                                                                                                    (+)
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ date('F j, Y h:i a', strtotime($quiz->created_at)) }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($quiz->status == 'disabled')
                                                                                    <a href="{{ url('course_quiz_status_update', [
                                                                                        'quiz_id' => $quiz->id,
                                                                                        'status' => $quiz->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-danger btn-block">{{ $quiz->status }}</a>
                                                                                @else
                                                                                    <a href="{{ url('course_quiz_status_update', [
                                                                                        'quiz_id' => $quiz->id,
                                                                                        'status' => $quiz->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-success btn-block">{{ $quiz->status }}</a>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    @foreach ($data->exam as $exam)
                                                                        <tr>
                                                                            <td>
                                                                                <!-- Button trigger modal -->
                                                                                <button type="button"
                                                                                    class="btn btn-link btn-sm btn-block"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModalexam{{ $exam->id }}">
                                                                                    {{ $exam->title }}
                                                                                </button>

                                                                                <!-- Modal -->
                                                                                <div class="modal fade"
                                                                                    id="exampleModalexam{{ $exam->id }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalLabel"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title"
                                                                                                    id="exampleModalLabel">
                                                                                                    {{ $exam->title }}
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                @foreach ($exam->exam_question as $question)
                                                                                                    <div class="card"
                                                                                                        style="margin-bottom: 20px;">
                                                                                                        <div
                                                                                                            class="card-header">
                                                                                                            @if ($question->question_type != 'Matching Type')
                                                                                                                Question:
                                                                                                                {{ $question->question }}
                                                                                                            @else
                                                                                                                Matching
                                                                                                                Type
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-body">
                                                                                                            @if ($question->question_type == 'Enumeration')
                                                                                                                @php
                                                                                                                    $explode = explode('|', $question->answer);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answers
                                                                                                                    </li>
                                                                                                                    @foreach ($explode as $key => $value)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $value }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Multitple Choice')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>

                                                                                                                    @if ($question->answer == 'choice_a')
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            A.
                                                                                                                            {{-- {{ $question->exam_details->choice_a }} --}}
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_b')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            B.
                                                                                                                            {{ $question->exam_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->exam_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->exam_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_c')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->exam_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            C.
                                                                                                                            {{ $question->exam_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->exam_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_d')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->exam_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->exam_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->exam_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            D.
                                                                                                                            {{ $question->exam_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @endif
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Identification')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        {{ $question->answer }}
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Matching Type')
                                                                                                                @php
                                                                                                                    $match_answer = explode('|', $question->answer);
                                                                                                                    $match_question = explode('|', $question->question);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answer
                                                                                                                    </li>

                                                                                                                    @for ($i = 0; $i < count($match_answer); $i++)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_question[$i] }}
                                                                                                                            -
                                                                                                                            {{ $match_answer[$i] }}
                                                                                                                        </li>
                                                                                                                    @endfor
                                                                                                                </ul>
                                                                                                                <br />
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>
                                                                                                                    @foreach ($question->exam_matching as $match_choices)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_choices->choices }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-footer">
                                                                                                            <a href="{{ url('instructor_edit_exam_question', ['question_id' => $question->id]) }}"
                                                                                                                class="btn btn-primary btn-sm float-right">Edit</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <a href="{{ url('instructor_add_item_to_exam', ['exam_id' => $exam->id]) }}"
                                                                                                    class="btn btn-sm btn-primary">Exam
                                                                                                    (+)
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ date('F j, Y h:i a', strtotime($exam->created_at)) }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($exam->status == 'disabled')
                                                                                    <a href="{{ url('course_exam_status_update', [
                                                                                        'exam_id' => $exam->id,
                                                                                        'status' => $exam->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-danger btn-block">{{ $exam->status }}</a>
                                                                                @else
                                                                                    <a href="{{ url('course_exam_status_update', [
                                                                                        'exam_id' => $exam->id,
                                                                                        'status' => $exam->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-success btn-block">{{ $exam->status }}</a>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    @foreach ($data->assignment as $assignment)
                                                                        <tr>
                                                                            <td>
                                                                                <!-- Button trigger modal -->
                                                                                <button type="button"
                                                                                    class="btn btn-link btn-sm btn-block"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModalexam{{ $assignment->id }}">
                                                                                    {{ $assignment->title }}
                                                                                </button>

                                                                                <!-- Modal -->
                                                                                <div class="modal fade"
                                                                                    id="exampleModalexam{{ $assignment->id }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalLabel"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title"
                                                                                                    id="exampleModalLabel">
                                                                                                    {{ $assignment->title }}
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                @foreach ($assignment->assignment_question as $question)
                                                                                                    <div class="card"
                                                                                                        style="margin-bottom: 20px;">
                                                                                                        <div
                                                                                                            class="card-header">
                                                                                                            @if ($question->question_type != 'Matching Type')
                                                                                                                Question:
                                                                                                                {{ $question->question }}
                                                                                                            @else
                                                                                                                Matching
                                                                                                                Type
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-body">
                                                                                                            @if ($question->question_type == 'Enumeration')
                                                                                                                @php
                                                                                                                    $explode = explode('|', $question->answer);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answers
                                                                                                                    </li>
                                                                                                                    @foreach ($explode as $key => $value)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $value }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Multitple Choice')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>

                                                                                                                    @if ($question->answer == 'choice_a')
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            A.
                                                                                                                            {{-- {{ $question->exam_details->choice_a }} --}}
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_b')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            B.
                                                                                                                            {{ $question->assignment_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->assignment_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->assignment_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_c')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->assignment_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            C.
                                                                                                                            {{ $question->assignment_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            D.
                                                                                                                            {{ $question->assignment_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @elseif($question->answer == 'choice_d')
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            A.
                                                                                                                            {{ $question->assignment_details->choice_a }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            B.
                                                                                                                            {{ $question->assignment_details->choice_b }}
                                                                                                                        </li>
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            C.
                                                                                                                            {{ $question->assignment_details->choice_c }}
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item"
                                                                                                                            style="background-color:greenyellow">
                                                                                                                            D.
                                                                                                                            {{ $question->assignment_details->choice_d }}
                                                                                                                        </li>
                                                                                                                    @endif
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Identification')
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        {{ $question->answer }}
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            @elseif($question->question_type == 'Matching Type')
                                                                                                                @php
                                                                                                                    $match_answer = explode('|', $question->answer);
                                                                                                                    $match_question = explode('|', $question->question);
                                                                                                                @endphp
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Answer
                                                                                                                    </li>

                                                                                                                    @for ($i = 0; $i < count($match_answer); $i++)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_question[$i] }}
                                                                                                                            -
                                                                                                                            {{ $match_answer[$i] }}
                                                                                                                        </li>
                                                                                                                    @endfor
                                                                                                                </ul>
                                                                                                                <br />
                                                                                                                <ul
                                                                                                                    class="list-group">
                                                                                                                    <li
                                                                                                                        class="list-group-item">
                                                                                                                        Choices
                                                                                                                    </li>
                                                                                                                    @foreach ($question->assignment_matching as $match_choices)
                                                                                                                        <li
                                                                                                                            class="list-group-item">
                                                                                                                            {{ $match_choices->choices }}
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="card-footer">
                                                                                                            <a href="{{ url('instructor_edit_assignment_question', ['question_id' => $question->id]) }}"
                                                                                                                class="btn btn-primary btn-sm float-right">Edit</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <a href="{{ url('instructor_add_item_to_assignment', ['assignment_id' => $assignment->id]) }}"
                                                                                                    class="btn btn-sm btn-primary">Assignment
                                                                                                    (+)
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ date('F j, Y h:i a', strtotime($assignment->created_at)) }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($assignment->status == 'disabled')
                                                                                    <a href="{{ url('instructor_course_assignment_status_update', [
                                                                                        'assignment_id' => $assignment->id,
                                                                                        'status' => $assignment->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-danger btn-block">{{ $assignment->status }}</a>
                                                                                @else
                                                                                    <a href="{{ url('instructor_course_assignment_status_update', [
                                                                                        'assignment_id' => $assignment->id,
                                                                                        'status' => $assignment->status,
                                                                                        'course_id' => $data->course_id,
                                                                                    ]) }}"
                                                                                        class="btn btn-sm btn-success btn-block">{{ $assignment->status }}</a>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModalcontent{{ $data->id }}">
                                            ADD CHAPTER CONTENT
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalcontent{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chapter Content</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_add_file_to_chapter') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label>File</label>
                                                            <input type="file" class="form-control" name="file"
                                                                required>

                                                            <input type="hidden" name="course_id"
                                                                value="{{ $data->course_id }}">
                                                            <input type="hidden" name="chapter_id"
                                                                value="{{ $data->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModaledit{{ $data->id }}">
                                            EDIT
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModaledit{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_edit_chapter') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label>Chapter</label>
                                                            <input type="text" name="chapter" class="form-control"
                                                                required value="{{ $data->chapter_number }}">

                                                            <label>Title</label>
                                                            <input type="text" name="title" class="form-control"
                                                                required value="{{ $data->title }}">

                                                            <label>Description</label>
                                                            <textarea name="content" class="form-control" col="30">{{ $data->content }}</textarea>

                                                            <input type="hidden" name="course_id"
                                                                value="{{ $data->course_id }}">
                                                            <input type="hidden" name="chapter_id"
                                                                value="{{ $data->id }}">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Comments</div>
        <div class="card-body">
            @foreach ($course->comments as $comments)
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-header">{{ $comments->user->last_name }} {{ $comments->user->name }}</div>
                    <div class="card-body">{{ $comments->comment }}</div>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <form action="{{ route('instructor_comment_process') }}" method="post">
                @csrf
                <label>Add Comment</label>
                <textarea name="comment" class="form-control" required></textarea>
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                <br />
                <button class="btn btn-primary btn-sm float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection
