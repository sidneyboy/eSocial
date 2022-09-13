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
        @foreach ($exam_details as $data)
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    <a class="float-right btn btn-sm btn-primary" href="{{ url('student_answer_exam_finalized',['
                    student_exam_id' => $data->student_exam_id]) }}">Submit Exam</a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @if ($data->status != 'answered')
                            <p>{{ $data->question }}</p>
                            <div class="radio">
                                <label><input type="radio" name="student_answer" class="student_answer"
                                        value="choice_a">{{ $data->choice_a }}</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="student_answer" class="student_answer"
                                        value="choice_b">{{ $data->choice_b }}</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="student_answer" class="student_answer"
                                        value="choice_c">{{ $data->choice_c }}</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="student_answer" class="student_answer"
                                        value="choice_d">{{ $data->choice_d }}</label>
                            </div>


                            <input type="hidden" id="student_exam_details_id" value="{{ $data->id }}">
                            <input type="hidden" id="answer" value="{{ $data->question_answer }}">
                            <button id="submit" class="btn btn-sm btn-success float-right">Submit Answer</button>
                        @else
                            <h3><span class="badge badge-success">Answer Submitted</span></h3>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $exam_details->links() }}
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
            var student_exam_details_id = $('#student_exam_details_id').val();
            var answer = $('#answer').val();
            var student_answer = $(".student_answer:checked").val();
            $.ajax({
                type: "POST",
                url: "/student_answer_exam_process",
                data: 'student_exam_details_id=' + student_exam_details_id + '&student_answer=' +
                    student_answer + '&answer=' + answer,
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
