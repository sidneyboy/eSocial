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
                    <h6 style="font-weight: bold;">Payment History</h6>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Instrutor</th>
                                    <th>Student</th>
                                    <th>Amount</th>
                                    <th>5% Company Deducation</th>
                                    <th>Total Amount to be received by instructor</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment as $data)
                                    <tr>
                                        <td>{{ $data->course->course_title }}</td>
                                        <td>{{ $data->instructor->name }} {{ $data->instructor->last_name }}</td>
                                        <td>{{ $data->student->name }} {{ $data->student->last_name }}</td>
                                        <td>
                                            {{ number_format($data->amount, 2, '.', ',') }}
                                            @php
                                                $total_amount[] = $data->amount;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $company_monitization = $data->amount * 0.05;
                                                $total_monitization[] = $company_monitization;
                                                echo number_format($company_monitization, 2, '.', ',');
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $total_amount_to_be_received_by_instructor = $data->amount - $company_monitization;
                                                $total_instructor_amount[] = $total_amount_to_be_received_by_instructor;
                                                echo number_format($total_amount_to_be_received_by_instructor, 2, '.', ',');
                                            @endphp
                                        </td>
                                        <td>{{ date('F j, Y', strtotime($data->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>{{ number_format(array_sum($total_amount), 2, '.', ','); }}</th>
                                    <th>{{ number_format(array_sum($total_monitization), 2, '.', ','); }}</th>
                                    <th>{{ number_format(array_sum($total_instructor_amount), 2, '.', ','); }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
