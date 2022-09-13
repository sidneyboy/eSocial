<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Student</title>
</head>

<body>
    <br />
    <div class="container">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <a href="{{ url('instructor_courses') }}">Back</a>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($exam_data as $data)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom:10px;">
                                    <button type="button" class="btn btn-sm btn-success btn-block" data-toggle="modal"
                                        data-target="#exampleModal_exam">
                                        Title - {{ $data->title }}
                                    </button>

                                    <div class="modal fade" id="exampleModal_exam" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Title -
                                                        {{ $data->title }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @for ($i = 0; $i < count($data->exam_details); $i++)
                                                        <div class="card" style="margin-bottom: 20px;">
                                                            <div class="card-header">
                                                                {{ $i + 1 }}. Answer:
                                                                @if ($data->exam_details[$i]->answer == 'choice_a')
                                                                    Letter A
                                                                @elseif($data->exam_details[$i]->answer == 'choice_b')
                                                                    Letter B
                                                                @elseif($data->exam_details[$i]->answer == 'choice_c')
                                                                    Letter C
                                                                @elseif($data->exam_details[$i]->answer == 'choice_d')
                                                                    Letter D
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                <p> {{ $data->exam_details[$i]->question }}
                                                                </p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item">Choices</li>
                                                                    @if ($data->exam_details[$i]->answer == 'choice_a')
                                                                        <li class="list-group-item"
                                                                            style="background-color:greenyellow">
                                                                            A.
                                                                            {{ $data->exam_details[$i]->choice_a }}
                                                                        </li>
                                                                        <li class="list-group-item">B.
                                                                            {{ $data->exam_details[$i]->choice_b }}</li>
                                                                        <li class="list-group-item">C.
                                                                            {{ $data->exam_details[$i]->choice_c }}</li>
                                                                        <li class="list-group-item">
                                                                            D.
                                                                            {{ $data->exam_details[$i]->choice_d }}
                                                                        </li>
                                                                    @elseif($data->exam_details[$i]->answer == 'choice_b')
                                                                        <li class="list-group-item">A.
                                                                            {{ $data->exam_details[$i]->choice_a }}</li>
                                                                        <li class="list-group-item"
                                                                            style="background-color:greenyellow">B.
                                                                            {{ $data->exam_details[$i]->choice_b }}
                                                                        </li>
                                                                        <li class="list-group-item">C.
                                                                            {{ $data->exam_details[$i]->choice_c }}
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            D.
                                                                            {{ $data->exam_details[$i]->choice_d }}
                                                                        </li>
                                                                    @elseif($data->exam_details[$i]->answer == 'choice_c')
                                                                        <li class="list-group-item">A.
                                                                            {{ $data->exam_details[$i]->choice_a }}
                                                                        </li>
                                                                        <li class="list-group-item">B.
                                                                            {{ $data->exam_details[$i]->choice_b }}
                                                                        </li>
                                                                        <li class="list-group-item"
                                                                            style="background-color:greenyellow">C.
                                                                            {{ $data->exam_details[$i]->choice_c }}
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            D.
                                                                            {{ $data->exam_details[$i]->choice_d }}
                                                                        </li>
                                                                    @elseif($data->exam_details[$i]->answer == 'choice_d')
                                                                        <li class="list-group-item">A.
                                                                            {{ $data->exam_details[$i]->choice_a }}
                                                                        </li>
                                                                        <li class="list-group-item">B.
                                                                            {{ $data->exam_details[$i]->choice_b }}
                                                                        </li>
                                                                        <li class="list-group-item">C.
                                                                            {{ $data->exam_details[$i]->choice_c }}
                                                                        </li>
                                                                        <li class="list-group-item"
                                                                            style="background-color:greenyellow">D.
                                                                            {{ $data->exam_details[$i]->choice_d }}
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->certificate != null)
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <a class="btn btn-sm btn-primary btn-block"
                                            href="{{ asset('/storage/' . $data->certificate) }}"
                                            download>{{ $data->certificate }}</a>
                                    </div>
                                @else
                                    <div class="col-md-6" style="margin-bottom:10px;">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block"
                                            data-toggle="modal" data-target="#exampleModal">
                                            Add Certificate
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Title -
                                                            {{ $data->title }} Certificate</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('instructor_add_exam_certificate') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Add Certificate</label>
                                                                <input type="file" class="form-control"
                                                                    accept="application/pdf" required
                                                                    name="certificate">

                                                                <input type="hidden" name="exam_id"
                                                                    value="{{ $data->id }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
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
