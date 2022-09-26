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
        <div class="card-header">Student Scores</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-striped table-hover table-sm" id="example" >
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Chapter</th>
                            <th>Student Score</th>
                            <th>Total Score</th>
                            <th>Percentage</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taken as $data)
                            <tr>
                                <td>{{ $data->student->last_name }} {{ $data->student->name }}</td>
                                <td>{{ $data->course->course_title }}</td>
                                <td>{{ $data->course_chapter->title }}</td>
                                <td>{{ $data->score }}</td>
                                <td>{{ $data->total_points }}</td>
                                <td>
                                    @php
                                        $percentage = ($data->score / $data->total_points) * 100;
                                        echo round($percentage, 2);
                                    @endphp
                                </td>
                                <td>
                                    @if ($percentage >= 80)
                                        <span style="color:green">Passed</span>
                                    @else
                                        <span style="color:red">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br />
            <button class="btn btn-block btn-primary btn-sm" onclick="exportTableToExcel('example', 'members-data')">Export Table Data To Excel File</button>
        </div>
    </div>
    <script>
        function exportTableToExcel(example, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(example);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
@endsection
