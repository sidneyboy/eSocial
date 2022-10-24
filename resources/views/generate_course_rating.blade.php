<div class="table table-responsive">
          <table id="example4" class="display nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th>Student</th>
                      <th>Instructor</th>
                      <th>Course</th>
                      <th>Rating</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($enrolled_students as $data)
                      <tr>
                          <td>{{ $data->student->last_name }} {{ $data->student->name }} </td>
                          <td>{{ $data->instructor->last_name }} {{ $data->instructor->name }} </td>
                          <td>{{ $data->course->course_title }}</td>
                          <td>{{ $data->rating }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      
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
              $('#example4').DataTable({
                  "paging": false,
                  "lengthChange": false,
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ]
              });
          });
      </script>
      