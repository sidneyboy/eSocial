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

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="{{ $course_id }}" id="course_id">
            @if ($enrolled_data->rating == '5')
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            @elseif ($enrolled_data->rating == '4')
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
            @elseif ($enrolled_data->rating == '3')
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @elseif ($enrolled_data->rating == '2')
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @elseif ($enrolled_data->rating == '1')
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            @else
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
            @endif

        </div>
    </div>

    <div class="row">
        @if (isset($course_chapter_next_chapter))
            @foreach ($course_chapter_next_chapter as $data)
                <div class="col-md-4">
                    <div class="card" style="width: 100%;margin-bottom:50px;background-color:gainsboro">
                        <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">Chapter
                            {{ $data->chapter_number }}</div>
                        {{-- <a href="{{ url('student_show_course_chapter_details', ['chapter_id' => $data->id]) }}"> --}}
                        <img class="card-img-top" style="border-radius: 0px;"
                            src="{{ asset('/storage/' . $data->thumbnail) }}" alt="Card image cap">
                        {{-- </a> --}}
                        <div class="card-body">
                            {{ $data->content }}
                        </div>
                        <div class="card-footer" style="font-weight: bold;background-color:#141E30;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm btn-info btn-block" data-toggle="modal"
                                data-target="#exampleModal{{ $data->id }}">
                                Material
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Chapter Conten</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseOne" aria-expanded="true"
                                                                aria-controls="collapseOne">
                                                                Materials
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <table class="table ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>File Type</th>
                                                                        <th>Chapter File</th>
                                                                        {{-- <th>Posted</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->course_details as $details)
                                                                        <tr>
                                                                            @if ($details->file_type == 'image')
                                                                                @if ($details->status != 'disabled')
                                                                                    <td>{{ $details->file_type }}</td>
                                                                                    <td>
                                                                                        @if ($details->file_type == 'image')
                                                                                            <a href="{{ url('student_show_image_file', [
                                                                                                'course_details_id' => $details->id,
                                                                                                'course_id' => $details->course_id,
                                                                                                'course_chapter_id' => $details->course_chapter_id,
                                                                                            ]) }}"
                                                                                                class="btn btn-sm btn-sm btn-primary btn-block">show</a>
                                                                                        @endif
                                                                                    </td>
                                                                                @endif
                                                                            @elseif($details->file_type == 'video')
                                                                                @if ($details->status != 'disabled')
                                                                                    <td>{{ $details->file_type }}</td>
                                                                                    <td>
                                                                                        @if ($details->file_type == 'video')
                                                                                            <a href="{{ url('student_show_video', [
                                                                                                'course_details_id' => $details->id,
                                                                                                'course_id' => $details->course_id,
                                                                                                'course_chapter_id' => $details->course_chapter_id,
                                                                                            ]) }}"
                                                                                                class="btn btn-sm btn-primary btn-block">show</a>
                                                                                        @endif
                                                                                    </td>
                                                                                @endif
                                                                            @elseif($details->file_type == 'application')
                                                                                @if ($details->status != 'disabled')
                                                                                    <td>{{ $details->file_type }}</td>
                                                                                    <td>
                                                                                        @if ($details->file_type == 'application')
                                                                                            {{-- <a href="{{ url('student_show_pdf_file', [
                                                                                                'course_details_id' => $details->id,
                                                                                                'course_id' => $details->course_id,
                                                                                            ]) }}"
                                                                                                class="btn btn-sm btn-primary btn-block" >show</a> --}}

                                                                                            <a href="{{ asset('/storage/' . $details->id) }}"
                                                                                                class="btn btn-sm btn-primary btn-block">show</a>
                                                                                        @endif
                                                                                    </td>
                                                                                @endif
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseTwo" aria-expanded="false"
                                                                aria-controls="collapseTwo">
                                                                Assignment
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Score</th>
                                                                        <th>Percentage</th>
                                                                        <th>Deadline</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->assignment as $assignment)
                                                                        @if ($assignment->status != 'disabled')
                                                                            <tr>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('student_show_taken', [
                                                                                            'id' => $assignment->id,
                                                                                            'type' => 'assignment',
                                                                                        ]) }}">{{ $assignment->title }}</a>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($assignment->student_assignment_score)
                                                                                        {{ $assignment->student_assignment_score->score }}/{{ $assignment->student_assignment_score->total_points }}
                                                                                        @php
                                                                                            $percentage = ($assignment->student_assignment_score->score / $assignment->student_assignment_score->total_points) * 100;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $percentage = 0;
                                                                                        @endphp
                                                                                        Not Taken
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ round($percentage, 2) }}%
                                                                                </td>
                                                                                <td>{{ date('F j, Y', strtotime($assignment->deadline)) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">
                                                                Quizes
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseThree" class="collapse"
                                                        aria-labelledby="headingThree" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Quiz</th>
                                                                        <th>Score</th>
                                                                        <th>Percentage</th>
                                                                        <th>Posted</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->course_quiz as $quiz)
                                                                        @if ($quiz->status != 'disabled')
                                                                            <tr>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('student_show_taken', [
                                                                                            'id' => $quiz->id,
                                                                                            'type' => 'quiz',
                                                                                        ]) }}">{{ $quiz->quiz_title }}</a>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($quiz->student_quiz_score)
                                                                                        {{ $quiz->student_quiz_score->score }}/{{ $quiz->student_quiz_score->total_points }}
                                                                                        @php
                                                                                            $percentage = ($quiz->student_quiz_score->score / $quiz->student_quiz_score->total_points) * 100;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $percentage = 0;
                                                                                        @endphp
                                                                                        Not Taken
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('F j, Y', strtotime($quiz->created_at)) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingFour">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-block text-left collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#collapseFour" aria-expanded="false"
                                                                aria-controls="collapseFour">
                                                                Exam
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Exam</th>
                                                                        <th>Score</th>
                                                                        <th>Percentage</th>
                                                                        <th>Certificate</th>
                                                                        <th>Posted</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->exam as $exam)
                                                                        @if ($exam->status != 'disabled')
                                                                            <tr>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('student_show_taken', [
                                                                                            'id' => $exam->id,
                                                                                            'type' => 'exam',
                                                                                        ]) }}">{{ $exam->title }}</a>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($exam->student_exam_score)
                                                                                        {{ $exam->student_exam_score->score }}/{{ $exam->student_exam_score->total_points }}
                                                                                        @php
                                                                                            $percentage = ($exam->student_exam_score->score / $exam->student_exam_score->total_points) * 100;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $percentage = 0;
                                                                                        @endphp
                                                                                        Not Taken
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ round($percentage, 2) }}%
                                                                                </td>
                                                                                <td>
                                                                                    @if ($percentage >= 80)
                                                                                        <a href="{{ asset('/storage/' . $exam->certificate) }}"
                                                                                            download>{{ $exam->certificate }}</a>
                                                                                    @else
                                                                                        None
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('F j, Y', strtotime($exam->created_at)) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @foreach ($course_chapter as $data)
            <div class="col-md-4">
                <div class="card" style="width: 100%;margin-bottom:50px;background-color:gainsboro">
                    <div class="card-header" style="font-weight: bold;background-color:#141E30;color:white">Chapter
                        {{ $data->chapter_number }}</div>
                    {{-- <a href="{{ url('student_show_course_chapter_details', ['chapter_id' => $data->id]) }}"> --}}
                    <img class="card-img-top" style="border-radius: 0px;"
                        src="{{ asset('/storage/' . $data->thumbnail) }}" alt="Card image cap">
                    {{-- </a> --}}
                    <div class="card-body">
                        {{ $data->content }}
                    </div>
                    <div class="card-footer" style="font-weight: bold;background-color:#141E30;">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm btn-info btn-block" data-toggle="modal"
                            data-target="#exampleModal{{ $data->id }}">
                            Material
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chapter Content</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left" type="button"
                                                            data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Materials
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <table class="table ">
                                                            <thead>
                                                                <tr>
                                                                    <th>File Type</th>
                                                                    <th>Chapter File</th>
                                                                    {{-- <th>Posted</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data->course_details as $details)
                                                                    <tr>
                                                                        @if ($details->file_type == 'image')
                                                                            <td>{{ $details->file_type }}</td>
                                                                            <td>
                                                                                @if ($details->status != 'disabled')
                                                                                    @if ($details->file_type == 'image')
                                                                                        <a href="{{ url('student_show_image_file', [
                                                                                            'course_details_id' => $details->id,
                                                                                            'course_id' => $details->course_id,
                                                                                            'course_chapter_id' => $details->course_chapter_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-sm btn-primary btn-block">show</a>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        @elseif($details->file_type == 'video')
                                                                            <td>{{ $details->file_type }}</td>
                                                                            <td>
                                                                                @if ($details->status != 'disabled')
                                                                                    @if ($details->file_type == 'video')
                                                                                        <a href="{{ url('student_show_video', [
                                                                                            'course_details_id' => $details->id,
                                                                                            'course_id' => $details->course_id,
                                                                                            'course_chapter_id' => $details->course_chapter_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-primary btn-block">show</a>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        @elseif($details->file_type == 'application')
                                                                            <td>{{ $details->file_type }}</td>
                                                                            <td>
                                                                                @if ($details->status != 'disabled')
                                                                                    @if ($details->file_type == 'application')
                                                                                        <a href="{{ url('student_show_pdf_file', [
                                                                                            'course_details_id' => $details->id,
                                                                                            'course_id' => $details->course_id,
                                                                                        ]) }}"
                                                                                            class="btn btn-sm btn-primary btn-block">show</a>
                                                                                    @endif
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
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            Assignment
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    <th>Score</th>
                                                                    <th>Percentage</th>
                                                                    <th>Deadline</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data->assignment as $assignment)
                                                                    @if ($assignment->status != 'disabled')
                                                                        <tr>
                                                                            <td>
                                                                                <a
                                                                                    href="{{ url('student_show_taken', [
                                                                                        'id' => $assignment->id,
                                                                                        'type' => 'assignment',
                                                                                    ]) }}">{{ $assignment->title }}</a>
                                                                            </td>
                                                                            <td>
                                                                                @if ($assignment->student_assignment_score)
                                                                                    {{ $assignment->student_assignment_score->score }}/{{ $assignment->student_assignment_score->total_points }}
                                                                                    @php
                                                                                        $percentage = ($assignment->student_assignment_score->score / $assignment->student_assignment_score->total_points) * 100;
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $percentage = 0;
                                                                                    @endphp
                                                                                    Not Taken
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ round($percentage, 2) }}%
                                                                            </td>
                                                                            <td>{{ date('F j, Y', strtotime($assignment->deadline)) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">
                                                            Quizes
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="table table-responsive">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Quiz</th>
                                                                        <th>Score</th>
                                                                        <th>Percentage</th>
                                                                        <th>Posted</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($data->course_quiz as $quiz)
                                                                        @if ($quiz->status != 'disabled')
                                                                            <tr>
                                                                                <td>
                                                                                    <a
                                                                                        href="{{ url('student_show_taken', [
                                                                                            'id' => $quiz->id,
                                                                                            'type' => 'quiz',
                                                                                        ]) }}">{{ $quiz->quiz_title }}</a>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($quiz->student_quiz_score)
                                                                                        {{ $quiz->student_quiz_score->score }}/{{ $quiz->student_quiz_score->total_points }}
                                                                                        @php
                                                                                            $percentage = ($quiz->student_quiz_score->score / $quiz->student_quiz_score->total_points) * 100;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $percentage = 0;
                                                                                        @endphp
                                                                                        Not Taken
                                                                                    @endif
                                                                                </td>

                                                                                <td>
                                                                                    {{ round($percentage, 2) }}%
                                                                                </td>
                                                                                <td>{{ date('F j, Y', strtotime($quiz->created_at)) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingFour">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link btn-block text-left collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseFour" aria-expanded="false"
                                                            aria-controls="collapseFour">
                                                            Exam
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <table class="table table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th>Exam</th>
                                                                    <th>Score</th>
                                                                    <th>Percentage</th>
                                                                    <th>Certificate</th>
                                                                    <th>Posted</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data->exam as $exam)
                                                                    @if ($exam->status != 'disabled')
                                                                        <tr>
                                                                            <td>
                                                                                <a
                                                                                    href="{{ url('student_show_taken', [
                                                                                        'id' => $exam->id,
                                                                                        'type' => 'exam',
                                                                                    ]) }}">{{ $exam->title }}</a>
                                                                            </td>
                                                                            <td>
                                                                                @if ($exam->student_exam_score)
                                                                                    {{ $exam->student_exam_score->score }}/{{ $exam->student_exam_score->total_points }}
                                                                                    @php
                                                                                        $percentage = ($exam->student_exam_score->score / $exam->student_exam_score->total_points) * 100;
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $percentage = 0;
                                                                                    @endphp
                                                                                    Not Taken
                                                                                @endif
                                                                            </td>

                                                                            <td>
                                                                                {{ round($percentage, 2) }}%
                                                                            </td>
                                                                            <td>
                                                                                @if ($percentage >= 80)
                                                                                    <a href="{{ asset('/storage/' . $exam->certificate) }}"
                                                                                        download>{{ $exam->certificate }}</a>
                                                                                @else
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ date('F j, Y', strtotime($exam->created_at)) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br /><br /><br />
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
            <form action="{{ route('student_comment_process') }}" method="post">
                @csrf
                <label>Add Comment</label>
                <textarea name="comment" class="form-control" required></textarea>
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                <br />
                <button class="btn btn-primary btn-sm float-right">Submit</button>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $('#myTab button').on('click', function(event) {
            event.preventDefault()
            $(this).tab('show')
        })

        $("#star5").click(function() {
            var rating = $('#star5').val();
            var course_id = $('#course_id').val();
            $.post({
                type: "POST",
                url: "/enrolled_course_rating",
                data: 'rating=' + rating + '&course_id=' + course_id,
                success: function(data) {
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $("#star4").click(function() {
            var rating = $('#star4').val();
            var course_id = $('#course_id').val();
            $.post({
                type: "POST",
                url: "/enrolled_course_rating",
                data: 'rating=' + rating + '&course_id=' + course_id,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $("#star3").click(function() {
            var rating = $('#star3').val();
            var course_id = $('#course_id').val();
            $.post({
                type: "POST",
                url: "/enrolled_course_rating",
                data: 'rating=' + rating + '&course_id=' + course_id,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $("#star2").click(function() {
            var rating = $('#star2').val();
            var course_id = $('#course_id').val();
            $.post({
                type: "POST",
                url: "/enrolled_course_rating",
                data: 'rating=' + rating + '&course_id=' + course_id,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $("#star1").click(function() {
            var rating = $('#star1').val();
            var course_id = $('#course_id').val();
            $.post({
                type: "POST",
                url: "/enrolled_course_rating",
                data: 'rating=' + rating + '&course_id=' + course_id,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@endsection
