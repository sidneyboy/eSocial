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
                <div class="card-header" style="font-weight: bold;">Add Course</div>
                <form action="{{ route('instructor_add_course_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Course:</label>
                            <select name="course_type" class="form-control" required>
                                <option value="" default>Select</option>
                                @foreach ($course_type as $data)
                                    <option value="{{ $data->id }}">{{ $data->course_type }}</option>
                                @endforeach
                            </select>

                            <label>Course Title:</label>
                            <input type="text" class="form-control" name="course_title" required>

                            <label>Course Description:</label>
                            <textarea name="course_description" class="form-control required" cols="30" rows="5"></textarea>

                            <label>Monitization:</label>
                            <select name="course_monitization" id="course_monitization" class="form-control" required>
                                <option value="" default>Select</option>
                                <option value="Free">Free</option>
                                <option value="Monitize">Monitize</option>
                            </select>

                            <label>Course Image Template</label>
                            <input type="file" class="form-control" accept="image/*" required name="course_image_template">


                            <span id="course_amount" style="display: none">
                                <label>Amount:</label>
                                <input type="text" class="form-control" name="course_amount">
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary float-right">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
