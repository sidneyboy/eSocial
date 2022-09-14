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

    <div class="card">
        <div class="card-header">Instructor To Do List</div>
        <div class="card-body">
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>

                <label>Time</label>
                <input type="time" name="time" class="form-control" required>

                <label>To do</label>
                <textarea name="to_do" class="form-control" required></textarea>

                <br />
                <button class="btn btn-sm btn-success btn-block">Submit</button>
            </div>
        </div>
    </div>
@endsection
