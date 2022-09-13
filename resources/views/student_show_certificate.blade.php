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
            <ul class="list-group">
                @foreach ($exam as $data)
                    <li class="list-group-item">
                        <a class="btn btn-sm btn-primary btn-block" href="{{ asset('/storage/' . $data->certificate) }}"
                            download>{{ $data->certificate }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
