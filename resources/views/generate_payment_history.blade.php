@if (count($payment) != 0)
    <div class="table table-responsive">
        <table id="example5" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Instrutor</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>30% Company Deducation</th>
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
                                $company_monitization = $data->amount * 0.3;
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
                    <th style="color:blue">
                        @if (isset($total_amount))
                            {{ number_format(array_sum($total_amount), 2, '.', ',') }}
                        @endif
                    </th>
                    <th style='color:green'>
                        @if (isset($total_monitization))
                            {{ number_format(array_sum($total_monitization), 2, '.', ',') }}
                        @endif
                    </th>
                    <th style="color:red">
                        @if (isset($total_instructor_amount))
                            {{ number_format(array_sum($total_instructor_amount), 2, '.', ',') }}
                        @endif
                    </th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
@endif


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example5').DataTable({
            "paging": false,
            "lengthChange": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
