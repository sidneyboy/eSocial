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
                    <h6 style="font-weight: bold;">Student List</h6>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-sm" id="example">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Date Sign Up</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ date('F j, Y', strtotime($data->created_at)) }}</td>
                                        <td>
                                            @if ($data->status == null)
                                                <a href="{{ url('suspend_student', [
                                                    'user_id' => $data->id,
                                                    'status' => 'Activated',
                                                ]) }}"
                                                    class="btn btn-sm btn-block btn-success">Activated</a>
                                            @else
                                                <a href="{{ url('suspend_student', [
                                                    'user_id' => $data->id,
                                                    'status' => 'Suspended',
                                                ]) }}"
                                                    class="btn btn-sm btn-block btn-warning">Suspended</a>
                                            @endif
                                        </td>
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
