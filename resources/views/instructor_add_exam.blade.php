<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Instructor</title>
</head>

<body>
    <br />
    <div class="container">

        <div class="card" style="width: 100%;">
            <div class="card-header">
                <a href="{{ url('instructor_courses') }}">Back</a>
            </div>
            <form enctype="multipart/form-data" action="{{ route('instructor_add_exam_next_page') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>

                        <label>Question</label>
                        <textarea name="question" class="form-control" required></textarea>

                        <label>Question Image</label>
                        <input type="file" class="form-control" accept="image/*" name="exam_file">
                        
                        <label>Answer</label>
                        <select name="answer" class="form-control" required>
                            <option value="" default>Set Answer</option>
                            <option value="choice_a">Choice A</option>
                            <option value="choice_b">Choice B</option>
                            <option value="choice_c">Choice C</option>
                            <option value="choice_d">Choice D</option>
                        </select>
                        <hr>
                        <label>Choice A</label>
                        <input type="text" required name="choice_a" class="form-control">

                        <label>Choice B</label>
                        <input type="text" required name="choice_b" class="form-control">

                        <label>Choice C</label>
                        <input type="text" required name="choice_c" class="form-control">

                        <label>Choice D</label>
                        <input type="text" required name="choice_d" class="form-control">

                        <input type="hidden" value="{{ $course_id }}" name="course_id">
                        <input type="hidden" value="{{ $number_of_exams - 1 }}" name="number_of_exams">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <button type="submit" class="page-link" href="#" aria-label="Next">
                                        Next
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div
                </div>
            </form>
        </div>

    </div>
    <br />
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
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
