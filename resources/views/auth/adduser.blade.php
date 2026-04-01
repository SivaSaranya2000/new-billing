@extends('layout.nav')

@section('content')

<!-- Main Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User List</h2>
        <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fas fa-user-plus"></i> Add Register
        </button>
    </div>

    <table class="table table-bordered table-hover" id="totaluser-table">
        <thead>
            <tr>
                <th>ID</th> 
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Adding User -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.add') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passinput" name="password" required>
                            <span class="input-group-text" onclick="togglePassword(event)" style="cursor:pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Is Active:</label><br>
                        <label class="me-3"><input type="radio" name="is_active" value="1"> Active</label>
                        <label><input type="radio" name="is_active" value="0"> Deactive</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save User</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection


@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
/* PASSWORD SHOW/HIDE */
function togglePassword(event) {
    const input = document.getElementById("passinput");
    const icon = event.currentTarget.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}


/* DATATABLE INITIALIZATION */
$(document).ready(function () {
    $('#totaluser-table').DataTable({
        dom: 'Blfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('data_all_user') }}",

        columns: [
            { data: 'id', name: 'id', visible: false }, // hidden
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>

@endpush
