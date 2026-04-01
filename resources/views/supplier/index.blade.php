@extends('layout.nav')
@section('content')
<!-- Main Content -->
  <div class="content">
    <h3 class="text-center">Supplier Details</h3>
      <div class="col-md-12">
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">Add Supplier</a>
      </div>
    <hr class="my-4">

    <h5>Supplier List</h5>
    <table class="table table-bordered table-striped mt-3" border="1" id="supplierTable">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Supplier Code</th>
          <th>GST Number</th>
          <th>Email</th>
          <th>State</th>
          <th>Address</th>
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
    $('#supplierTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('data_all_supplier') }}",

        columns: [
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'supplier_code', name: 'supplier_code' },
            { data: 'gst_number', name: 'gst_number' },
            { data: 'email', name: 'email' },
            { data: 'state', name: 'state' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $(document).on('click', '.deleteSupplierBtn', function () {
    let id = $(this).data('id');
    if (!confirm("Are you sure you want to delete this supplier?")) {
        return;
    }
    $.ajax({
        url: "/suppliers/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#supplierTable').DataTable().ajax.reload();
            }
        }
    });

});

  });
</script>