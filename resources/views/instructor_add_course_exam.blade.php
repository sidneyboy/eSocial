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
                <div class="card-header" style="font-weight: bold;">Chapter Exam</div>
                <form action="{{ route('instructor_add_course_exam_process') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Exam Title</label>
                            <input type="text" name="title" required class="form-control">

                            <label>Number of questions</label>
                            <input type="number" min="0" name="number_of_questions" class="form-control" required>

                            <label>Certificate</label>
                            <input type="file" name="certificate" class="form-control" required
                                accept="application/*">

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
