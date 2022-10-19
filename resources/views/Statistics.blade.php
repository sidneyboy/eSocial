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
                    <h6 style="font-weight: bold;">Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <canvas id="enrolled_per_month" height="100"></canvas> --}}
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" value="2012-04-05">
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control" value="2012-04-19">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js">
    </script>
    <script>
        const month_label = {!! json_encode($month_label) !!};
        const monthly_total_enrolled = {!! json_encode($monthly_total_enrolled) !!};

        new Chart("enrolled_per_month", {
            type: "bar",
            data: {
                labels: month_label,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: monthly_total_enrolled
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });
    </script> --}}
@endsection
