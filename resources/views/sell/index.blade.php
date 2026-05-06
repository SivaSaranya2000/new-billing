@extends('layout.nav')
@section('content')
  <div class="content">
    <h3 class="text-center">Sales Details</h3>
      <div class="col-md-12">
        <a href="{{ route('sell.create') }}" class="btn btn-success">Create Sale</a>
      </div>
    <hr class="my-4">
     <h5>Product List</h5>
    <table id="sellTable" class="table table-bordered table-striped mt-3" border="1">
    <thead>
        <tr>
            <th>#</th> 
            <th>Customer Name</th>
            <th>Sales Code</th>
            <th>Sales Date</th>
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
  $('#sellTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('data_all_sell') }}",
    columns: [
        
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
        { data: 'customer_id', name: 'customer_id' },
        { data: 'sales_code', name: 'sales_code' },
        { data: 'sales_date', name: 'sales_date' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
});
</script>