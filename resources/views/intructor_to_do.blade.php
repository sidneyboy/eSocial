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

    <br />
    <div class="card">
        <div class="card-header">Instructor Add To Do List <a href="{{ url('instructor_to_do_list') }}" class="btn btn-primary btn-sm float-right">List</a></div>
        <div class="card-body">
            <form action="{{ route('instructor_todo_process') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>

                    <label>Time</label>
                    <input type="time" name="time" class="form-control" required>

                    <label>To do</label>
                    <textarea name="todo" class="form-control" required></textarea>

                    <br />
                    <button class="btn btn-sm btn-success btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
