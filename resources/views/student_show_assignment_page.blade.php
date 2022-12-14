<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Student</title>
</head>

<body>
    <br />
    <div class="container">
        @foreach ($assignment_question as $question)
            <div class="card">
                <div class="card-header">
                    @if ($question->question_type != 'Matching Type')
                        Question:<br />
                        {{ $question->question }}
                    @else
                        Matching Type
                    @endif
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @if ($question->status != 'answered')
                            @if ($question->question_type == 'Enumeration')
                                @php
                                    $explode = explode('|', $question->answer);
                                @endphp
                                <ul class="list-group">
                                    @foreach ($explode as $key => $value)
                                        <li class="list-group-item">
                                            <input type="text" name="answer[]" class="form-control">
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" id="question_type" value="{{ $question->question_type }}">
                            @elseif($question->question_type == 'Multitple Choice')
                                @if ($question->status != 'answered')
                                    <div class="radio">
                                        <label><input type="radio" name="student_answer" class="student_answer"
                                                value="choice_a">{{ $question->assignment_details->choice_a }}</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="student_answer" class="student_answer"
                                                value="choice_b">{{ $question->assignment_details->choice_b }}</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="student_answer" class="student_answer"
                                                value="choice_c">{{ $question->assignment_details->choice_c }}</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="student_answer" class="student_answer"
                                                value="choice_d">{{ $question->assignment_details->choice_d }}</label>
                                    </div>
                                    <input type="hidden" id="question_type" value="{{ $question->question_type }}">
                                @else
                                    <h3><span class="badge badge-success">Answer Submitted</span></h3>
                                @endif
                            @elseif($question->question_type == 'Identification')
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <input type="text" class="form-control" name="answer" required>
                                    </li>
                                </ul>
                                <input type="hidden" id="question_type" value="{{ $question->question_type }}">
                            @elseif($question->question_type == 'Matching Type')
                                @php
                                    $match_answer = explode('|', $question->answer);
                                    $match_question = explode('|', $question->question);
                                @endphp
                                <ul class="list-group">
                                    @for ($i = 0; $i < count($match_answer); $i++)
                                        {{ $i + 1 }}. <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{ $match_question[$i] }}
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="answer[]" required>
                                                </div>
                                            </div>
                                        </li>
                                    @endfor
                                </ul>
                                <br />
                                <input type="hidden" id="question_type" value="{{ $question->question_type }}">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Choices</li>
                                    @foreach ($question->assignment_matching as $match_choices)
                                        <li class="list-group-item">
                                            {{ $match_choices->choices }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            <h3><span class="badge badge-success">Answer Submitted</span></h3>
                        @endif
                        <br />

                        <input type="hidden" id="assignment_question_id" value="{{ $question->id }}">
                        {{-- <input type="hidden" id="answer" value="{{ $question->question_answer }}"> --}}
                        <button id="submit" class="btn btn-sm btn-success btn-block">Submit Answer</button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $assignment_question->links() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br />
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#submit").click(function() {
           
            if ($('#question_type').val() == 'Enumeration') {
                var student_answer = $("input[name='answer[]']").map(function(){return $(this).val();}).get();
                var assignment_question_id = $('#assignment_question_id').val();
                var question_type = $('#question_type').val();
                $.ajax({
                    type: "POST",
                    url: "/student_answer_exam_process",
                    data: 'assignment_question_id=' + assignment_question_id + '&student_answer=' +
                        student_answer + '&question_type=' +
                        question_type,
                    success: function(data) {
                        Swal.fire(
                            'Good job!',
                            'Answer Submitted',
                            'success',
                        )
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if ($('#question_type').val() == 'Multiple Choice') {
                var assignment_question_id = $('#assignment_question_id').val();
                var student_answer = $(".student_answer:checked").val();
                var question_type = $('#question_type').val();
                $.ajax({
                    type: "POST",
                    url: "/student_answer_exam_process",
                    data: 'assignment_question_id=' + assignment_question_id + '&student_answer=' +
                        student_answer + '&question_type=' +
                        question_type,
                    success: function(data) {
                        Swal.fire(
                            'Good job!',
                            'Answer Submitted',
                            'success',
                        )
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if ($('#question_type').val() == 'Identification') {

            } else if ($('#question_type').val() == 'Matching Type') {

            }
        });
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
        $(window).on('load', function() {
            setTimeout(removeLoader, 500); //wait for page load PLUS two seconds.
        });

        function removeLoader() {
            $("#loadingDiv").fadeOut(500, function() {
                // fadeOut complete. Remove the loading div
                $("#loadingDiv").remove(); //makes page more lightweight 
            });
        }
    </script> --}}

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
