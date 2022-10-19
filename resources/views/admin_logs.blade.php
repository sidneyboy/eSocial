@extends('layouts.admin')

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header">
                    <h6 style="font-weight: bold;">Logs</h6>
                </div>
                <div class="card-body">
                  <div class="table table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Admin</th>
                                <th>Description</th>
                                <th> Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_logs as $data)
                                <tr>
                                    <td>{{ $data->user->name }} {{ $data->user->last_name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
