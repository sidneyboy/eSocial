@extends('layouts.student')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="width: 100%;">
        <div class="card-header">
            Certificates
        </div>
        <div class="card-body">
            No Exam Certificates Yet
        </div>
    </div>
@endsection
