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
            @if (session('error'))
                <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card" style="width: 100%;">
                <div class="card-header" style="font-weight: bold;">Course Chapter</div>
                <form action="{{ route('instructor_add_course_phase_2_process') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Chapter #</label>
                            <input type="text" name="chapter_number" class="form-control" required>

                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>

                            <label>Topic</label>
                            <textarea name="content" class="form-control" required></textarea>
                            

                            <label>Thumbnail</label>
                            <input type="file" name="thumbnail" accept="image/*" class="form-control" required>

                            <input type="hidden" value="{{ $course_id }}" name="course_id">
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
