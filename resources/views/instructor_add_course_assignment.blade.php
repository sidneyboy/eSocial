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
                <div class="card-header" style="font-weight: bold;">Chapter Assignment</div>
                <form action="{{ route('instructor_add_course_assignment_process') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Assignment Title</label>
                            <input type="text" name="title" required class="form-control">

                            <label>Number of questions</label>
                            <input type="number" min="0" name="number_of_questions" class="form-control" required>

                            <label>Question Type</label>
                            <select class="form-control" id="question_type" name="question_type" required name="question_type">
                                <option value="" default>Select</option>
                                <option value="Enumeration">Enumeration</option>
                                <option value="Multitple Choice">Multitple Choice</option>
                                <option value="Identification">Identification</option>
                                <option value="Matching Type">Matching Type</option>
                            </select>

                            <label>Deadline Date</label>
                            <input type="date" name="deadline" class="form-control" required>

                            <input type="hidden" value="{{ $course_id }}" name="course_id">
                            <input type="hidden" value="{{ $course_chapter_id }}" name="course_chapter_id">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
