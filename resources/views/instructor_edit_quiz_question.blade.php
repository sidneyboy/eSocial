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

    <form action="{{ route('instructor_edit_quiz_question_process') }}" method="post">
        @csrf
        <a href="{{ url('instructor_show_chapter',$question->course_id) }}" class="btn btn-sm btn-primary">Back</a>
      
        <br /><br />
        <div class="card">
            <div class="card-header">
                @if ($question->question_type != 'Matching Type')
                    Question:
                    <textarea name="question" class="form-control" required>{{ $question->question }}</textarea>
                @else
                    Matching Type
                @endif
            </div>
            <div class="card-body">
                @if ($question->question_type == 'Enumeration')
                    @php
                        $explode = explode('|', $question->answer);
                    @endphp
                    <ul class="list-group">
                        <li class="list-group-item">
                            Answers
                        </li>
                        @foreach ($explode as $key => $value)
                            <li class="list-group-item">
                                <input type="text" class="form-control" name="answer[]" required
                                    value="{{ $value }}">
                            </li>
                        @endforeach
                    </ul>
                @elseif($question->question_type == 'Multitple Choice')
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>Answer</label>
                            <select name="answer" class="form-control" required>
                                <option value="" default>Set Answer</option>
                                <option value="choice_a">Choice A</option>
                                <option value="choice_b">Choice B</option>
                                <option value="choice_c">Choice C</option>
                                <option value="choice_d">Choice D</option>
                                <option value="{{ $question->answer }}" selected>{{ str_replace('_',' ',$question->answer) }}</option>
                            </select>
                        </li>
                        <li class="list-group-item">
                            Choices</li>
                    
                        <li class="list-group-item">
                            A.
                            <input type="text" name="choice_a" value="{{ $question->quiz_details->choice_a }}" required
                                class="form-control">
                        </li>
                        <li class="list-group-item">
                            B.
                            <input type="text" name="choice_b" value="{{ $question->quiz_details->choice_b }}" required
                                class="form-control">
                        </li>
                        <li class="list-group-item">
                            C.
                            <input type="text" name="choice_c" value="{{ $question->quiz_details->choice_c }}" required
                                class="form-control">
                        </li>
                        <li class="list-group-item">
                            D.
                            <input type="text" name="choice_d" value="{{ $question->quiz_details->choice_d }}" required
                                class="form-control">
                        </li>
                    </ul>
                    <input type="hidden" name="quiz_details_id" value="{{ $question->quiz_details->id }}">
                @elseif($question->question_type == 'Identification')
                    <ul class="list-group">
                        <li class="list-group-item">
                            <input type="text" class="form-control" name="answer" required value="{{ $question->answer }}">
                        </li>
                    </ul>
                @elseif($question->question_type == 'Matching Type')
                    @php
                        $match_answer = explode('|', $question->answer);
                        $match_question = explode('|', $question->question);
                    @endphp
                    <ul class="list-group">
                        <li class="list-group-item">
                            Answer</li>

                        @for ($i = 0; $i < count($match_answer); $i++)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" value="{{ $match_question[$i] }}" name="question[]"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" value="{{ $match_answer[$i] }}" name="answer[]"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    </ul>
                    <br />
                    <ul class="list-group">
                        <li class="list-group-item">Choices</li>
                        @foreach ($question->quiz_matching as $match_choices)
                            <li class="list-group-item">
                                <input type="text" value="{{ $match_choices->choices }}" name="choices[{{ $match_choices->id }}]" required
                                    class="form-control">
                                <input type="hidden" name="matching_id[]" value="{{ $match_choices->id }}">
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="card-footer">
                <input type="hidden" value="{{ $question->course_id }}" name="course_id">
                <input type="hidden" value="{{ $question->id }}" name="quiz_question_id">
                <input type="hidden" value="{{ $question->course_chapter_id }}" name="course_chapter_id">
                <input type="hidden" value="{{ $question->question_type }}" name="question_type">
                <button class="float-right btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
