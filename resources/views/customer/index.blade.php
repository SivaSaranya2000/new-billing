@extends('layout.nav')

@section('content')

@if (session('successmessage'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('successmessage') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif


<!-- Main Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Customer List</h2>
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fas fa-user-plus"></i> Add Customer
        </button>
    </div>

    <table class="table table-bordered table-striped table-hover" id="totalcustomer-table">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@include('customer.create')
@include('customer.edit')
@endsection
@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#totalcustomer-table').DataTable({
        dom: 'Blfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('data_all_customer') }}",

        columns: [
            { data: 'id', name: 'id', visible: false },
            { data: 'name', name: 'name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

   $(document).on('click', '.editCustomerBtn', function () {
    let id = $(this).data('id');
    $.ajax({
        url: "/customers/" + id + "/edit",
        type: "GET",
        success: function (res) {
            $('#edit_id').val(res.id);
            $('#edit_name').val(res.name);
            $('#edit_mobile').val(res.mobile);
            $('#edit_email').val(res.email);
            $('#edit_address').val(res.address);
            $("#editCustomerForm").attr("action", "/customers/" + res.id);
            $('#editCustomerModal').modal('show');
        }
    });
});
$('#editCustomerForm').on('submit', function(e){
    e.preventDefault();

    let id = $('#edit_id').val();
    let formData = $(this).serialize();

    $.ajax({
        url: "/customers/" + id,
        type: "POST",
        data: formData,
        success: function(res){
            if(res.status === 'success'){
                $('#editCustomerModal').modal('hide');
                $('#totalcustomer-table').DataTable().ajax.reload();
            }
        }
    });
});

$(document).on('click', '.deleteCustomerBtn', function () {
    let id = $(this).data('id');
    if (!confirm("Are you sure you want to delete this customer?")) {
        return;
    }
    $.ajax({
        url: "/customers/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#totalcustomer-table').DataTable().ajax.reload();
            }
        }
    });
});
});
</script>

@endpush
