@extends('layout.nav')
@section('content')
 <!-- Main Content -->
  <div class="content">
    <h3 class="mb-4">Unit Details</h3>

    <!-- Add Unit Form -->
    <form  action="{{ route('units.store')}}" method="POST" id="unitForm" class="row g-3 mb-4">
      @csrf
      <div class="col-md-4">
        <input type="text" class="form-control" name="unit" id="unitName" placeholder="Enter Unit Name (e.g., kg, pcs)" required />
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" name="description" id="unitDescription" placeholder="Enter Description" />
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Unit</button>
      </div>
    </form>

    <!-- Unit Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped"id="unitTable">
        <thead class="table-dark">
          <tr>
            
            <th>Unit Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="unitTableBody">
        </tbody>
      </table>
    </div>
  </div>
@include('units.edit')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

   $('#unitTable').DataTable({
        dom: "Blfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],

        ajax: "{{ route('data_all_units') }}",

        columns: [
            { data: "unit", name: "unit" },
            { data: "description", name: "description" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });
    $(document).on('click', '.editUnitBtn', function () {
   let id = $(this).data('id');
    $.ajax({
        url: "/units/" + id + "/edit",
        type: "GET",
        success: function (res) {
            $('#edit_id').val(res.id);
            $('#unit').val(res.unit);
            $('#description').val(res.description);
            $("#editUnitForm").attr("action", "/units/" + res.id);

            $('#editUnitModal').modal('show');
        }
    });
});
$('#editUnitForm').on('submit', function(e){
    e.preventDefault();
    let id = $('#edit_id').val();
    let formData = $(this).serialize();
    $.ajax({
        url: "/units/" + id,
        type: "POST",
        data: formData,
        success: function(res){
            if(res.status === 'success'){
                $('#editUnitModal').modal('hide');
                $('#unitTable').DataTable().ajax.reload();
            }
        }
    });
});
$(document).on('click', '.deleteUnitBtn', function () {
 let id = $(this).data('id');
 if (!confirm("Are you sure you want to delete this unit?")) {
        return;
    }
    $.ajax({
        url: "/units/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#unitTable').DataTable().ajax.reload();
            }
        }
    });

});
  });
</script>