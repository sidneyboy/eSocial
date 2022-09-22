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
            <div class="card" style="width: 100%;">
                <div class="card-header" style="font-weight: bold;">
                    {{-- @php
                       echo $total_left = $number_of_questions - 1;

                       echo "<br />";
                       echo $quiz_number = $number_of_questions - $total_left;
                    @endphp
                    Question # {{ $quiz_number }} --}}
                </div>
                <form action="{{ route('instructor_add_course_chapter_quiz_next_question') }}" method="get"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control" id="question_type" required name="question_type">
                                <option value="" default>Select</option>
                                <option value="Enumeration">Enumeration</option>
                                <option value="Multitple Choice">Multitple Choice</option>
                                <option value="Identification">Identification</option>
                                <option value="Matching Type">Matching Type</option>
                            </select>

                          

                            <input type="hidden" value="{{ $course_id }}" name="course_id">
                            <input type="hidden" value="{{ $quiz_id }}" name="quiz_id">
                            <input type="hidden" value="{{ $course_chapter_id }}" name="course_chapter_id">
                            <input type="hidden" value="{{ $number_of_questions - 1 }}" name="number_of_questions">
                        </div>
                        <div id="show"></div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary float-right" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $("#question_type").change(function() {
            if ($(this).val() == 'Enumeration') {
                let loop_number = prompt("Please enter number to be enumarate", "0");
                if (loop_number != null) {
                    var question_type = $(this).val();
                    $.post({
                        type: "POST",
                        url: "/instructor_add_course_chapter_quiz_question_type",
                        data: 'question_type=' + question_type + '&loop_number=' + loop_number,
                        success: function(data) {
                            $('#show').html(data);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            } else if ($(this).val() == 'Multitple Choice') {
                //let loop_number = prompt("Please enter number of choices", "0");
                // if (loop_number != null) {
                var question_type = $(this).val();
                $.post({
                    type: "POST",
                    url: "/instructor_add_course_chapter_quiz_question_type",
                    data: 'question_type=' + question_type,
                    success: function(data) {
                        $('#show').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // }
            } else if ($(this).val() == 'Identification') {
                // let loop_number = prompt("Please enter number to be Identify", "0");
                // if (loop_number != null) {
                // document.getElementById("demo").innerHTML =
                //     "Hello " + person + "! How are you today?";
                var question_type = $(this).val();
                $.post({
                    type: "POST",
                    url: "/instructor_add_course_chapter_quiz_question_type",
                    data: 'question_type=' + question_type,
                    success: function(data) {
                        $('#show').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // }
            }else if ($(this).val() == 'Matching Type') {
                let loop_number = prompt("Please enter number of matching type");
                if (loop_number != null) {
                    // document.getElementById("demo").innerHTML =
                    //     "Hello " + person + "! How are you today?";
                    var question_type = $(this).val();
                    $.post({
                        type: "POST",
                        url: "/instructor_add_course_chapter_quiz_question_type",
                        data: 'question_type=' + question_type + '&loop_number=' + loop_number,
                        success: function(data) {
                            $('#show').html(data);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        });
    </script>
@endsection
