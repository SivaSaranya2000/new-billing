@extends('layout.nav')
@section('content')
<!-- Main Content -->
  <div class="content">
    <h3 class="text-center">Add Supplier</h3>
    <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST" class="row g-3 mt-3">
      @csrf
      <div class="col-md-4">
        <label class="form-label">Supplier Name:*</label>
        <input type="text" class="form-control" name="name" id="name" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Phone:*</label>
        <input type="text" class="form-control" name="phone" id="phone" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" id="email" >
      </div>
      <div class="col-md-4">
        <label class="form-label">Supplier Code:</label> <br><small class="text-warning">Auto-generate the supplier code if it is blank.</small>
        <input type="text" class="form-control" name="supplier_code" id="supplier_code" >
      </div>
       <div class="col-md-4">
        <label class="form-label">City:</label>
        <input type="text" class="form-control" name="city" id="city" >
      </div>
       <div class="col-md-4">
        <label class="form-label">State:</label>
        <input type="text" class="form-control" name="state" id="state" >
      </div>
       <div class="col-md-4">
        <label class="form-label">GST Number:</label>
        <input type="text" class="form-control" name="gst_number" id="gst_number" >
      </div>
      <div class="col-md-12">
        <label class="form-label">Address:</label>
        <input type="text" class="form-control" name="address"   id="address" required>
      </div>
      <div class="col-md-12">
        <button type="submit" class="btn btn-success">Add Supplier</button>
      </div>
    </form>
  </div>

@endsection
