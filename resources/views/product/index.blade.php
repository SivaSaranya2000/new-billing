@extends('layout.nav')
@section('content')
  <div class="content">
    <h3 class="text-center">Product Details</h3>
      <div class="col-md-12">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
      </div>
   <hr class="my-4">

    <h5>Product List</h5>
    <table id="productTable" class="table table-bordered table-striped mt-3" border="1">
    <thead>
        <tr>
            <th>#</th> 
            <th>Name</th>
            <th>SKU</th>
            <th>Product Type</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
</div>

@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $('#productTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('data_all_product') }}",
    columns: [
        
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
        { data: 'name', name: 'name' },
        { data: 'sku', name: 'sku' },
        { data: 'product_type', name: 'product_type' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
});
</script>



