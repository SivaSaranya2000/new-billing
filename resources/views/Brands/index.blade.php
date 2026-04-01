@extends('layout.nav')
@section('content')
<div class="content">
    <h3 class="mb-4">Brand Details</h3>

<!-- Add Brand Form -->
    <form  action="{{ route('brands.store')}}" method="POST" id="brandForm" class="row g-3 mb-4">
      @csrf
      <div class="col-md-3">
        <label for="BrandName">Brand Name :<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="brand" id="BrandName" placeholder="Enter Brand Name" required />
      </div>
      <div class="col-md-3">
        <label for="brandCode">Brand Code :</label>
        <input type="text" class="form-control" name="brand_code" id="brandCode" placeholder="Enter Brand Code" />
      </div>
      <div class="col-md-3">
        <label for="brandDescription">Description :</label>
        <input type="text" class="form-control" name="description" id="brandDescription" placeholder="Enter Description" />
      </div>
      <div class="col-md-3">
        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Brand</button>
      </div>
    </form>

<!-- Unit Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped"id="brandtable">
        <thead class="table-dark">
          <tr>
            
            <th>Brand Name</th>
            <th>Brand Code</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="brandTableBody">
        </tbody>
      </table>
    </div>
  </div>
@include('brands.edit')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

   $('#brandtable').DataTable({
        dom: "Blfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],

        ajax: "{{ route('data_all_brands') }}",

        columns: [
            { data: "brand", name: "brand" },
            { data: "brand_code", name: "brand_code" },
            { data: "description", name: "description" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });
    $(document).on('click', '.editBrandBtn', function () {
   let id = $(this).data('id');
    $.ajax({
        url: "/brands/" + id + "/edit",
        type: "GET",
        success: function (res) {
            $('#edit_id').val(res.id);
            $('#brand').val(res.brand);
            $('#brand_code').val(res.brand_code);
            $('#description').val(res.description);
            $("#editBrandForm").attr("action", "/brands/" + res.id);

            $('#editBrandModal').modal('show');
        }
    });
});
$('#editBrandForm').on('submit', function(e){
    e.preventDefault();
    let id = $('#edit_id').val();
    let formData = $(this).serialize();
    $.ajax({
        url: "/brands/" + id,
        type: "POST",
        data: formData,
        success: function(res){
            if(res.status === 'success'){
                $('#editBrandModal').modal('hide');
                $('#brandtable').DataTable().ajax.reload();
            }
        }
    });
});
$(document).on('click', '.deleteBrandBtn', function () {
 let id = $(this).data('id');
 if (!confirm("Are you sure you want to delete this brand?")) {
        return;
    }
    $.ajax({
        url: "/brands/" + id,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}"
        },
        success: function (res) {
            if (res.status === 'success') {
                $('#brandtable').DataTable().ajax.reload();
            }
        }
    });

});
});
</script>
