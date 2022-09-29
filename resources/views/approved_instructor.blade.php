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
                    <h6 style="font-weight: bold;">Approved Instructor</h6>
                </div>
                <div class="card-body">

                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-sm" id="example">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>User</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructor as $data)
                                    <tr>
                                        <td>{{ $data->last_name }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->user_type }}</td>
                                        <td>{{ date('F j, Y', strtotime($data->created_at)) }}</td>
                                        <td>
                                            @if ($data->status == '')
                                                <a href="{{ url('approved_instructor_process', $data->id) }}"
                                                    class="btn btn-sm btn-warning btn-block">Pending Approved</a>
                                            @else
                                                Approved
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
