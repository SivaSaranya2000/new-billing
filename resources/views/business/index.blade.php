@extends('layout.nav')
@section('content')
<!-- Main Content -->
  <div class="content">
    <h3 class="text-center">Business Details</h3>
      <div class="col-md-12">
        <a href="{{ route('business-settings.create') }}" class="btn btn-success">Add</a>
      </div>
    <hr class="my-4">
 <h5>Business List</h5>
    <table class="table table-bordered table-striped mt-3" border="1" id="businesstable">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Business Number</th>
          <th>Address</th>
          <th>Email</th>
          <th>Tax Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    
  </div>

@endsection

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#businesstable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('data_all_business') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'number', name: 'number' },
            { data: 'address', name: 'address' },
            { data: 'email', name: 'email' },
            { data: 'gst_number', name: 'gst_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

     $(document).on('click', '.deletebusinessBtn', function () {
    let id = $(this).data('id');
    if (!confirm("Are you sure you want to delete this business?")) {
        return;
    }
    $.ajax({
        url: "/business-settings/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#businesstable').DataTable().ajax.reload();
            }
        }
    });

});

  });
</script>