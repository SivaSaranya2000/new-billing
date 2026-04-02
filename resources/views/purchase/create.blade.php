@extends('layout.nav')
@section('content')
 <div class="content">

<div class="card p-4 mt-1">
    <h3 class="text-center ">Add Purchase</h3>
<form id="purchaseForm" action="{{ route('purchases.store') }}" method="POST" class="row g-3 mt-3">
      @csrf
<div class="col-md-4">
        <label class="form-label">Supplier Name:*</label>
       <select class="form-select" name="supplier_id" id="supplier_id" required>
        <option value="" disabled selected>Select Supplier</option>
        @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
      </select>
      </div>
        <div class="col-md-4">
    <label class="form-label">Purchase Date:*</label>
    <input type="text" class="form-control" name="purchase_date" id="purchase_date" required>
</div>
 <div class="col-md-4">
    <label class="form-label">Purchase Invoice No:*</label>
    <input type="text" class="form-control" name="purchase_invoice_no" id="purchase_invoice_no" required>
</div>
<div class="col-md-2"></div>
 <div class="col-md-8">
    <label class="form-label">Search Product:</label>
    <input type="text" id="product_search" class="form-control" placeholder="Search product by name or SKU">
    
    <div id="product_list" class="list-group" style="position:absolute; z-index:999; width:100%; display:none;">
    </div>
</div>
<div class="col-md-2"></div>
<!-- <table border="1px solid black" class="table table-bordered mt-4 product_table">
    <tr>
        <th>
            Product Name
        </th>
        <th>
            HSN Code
        </th>
        <th>Qty</th>
        <th>unit</th>
        <th>purchase price</th>
        <th>MRP</th>
        <th>Tax</th>
        <th>Total Amount</th>
    </tr>
</table> -->
<table class="table" id="product_table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
             <th>MRP</th>
             <th>purchase Exc Price</th>
             <th>purchase Inc Price</th>
             <th>Tax Amount</th>
             <th>Unit Price</th>
            <th>Selling Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
 <div class="col-md-4">
    <label class="form-label">Shipping Charges:*</label>
    <input type="text" class="form-control" name="shipping_charges" id="shipping_charges" required>
</div>
 <div class="col-md-4">
    <label class="form-label">Paid Amount:*</label>
    <input type="text" class="form-control" name="paid_amount" id="paid_amount" required>
</div>
 <div class="col-md-4">
    <label class="form-label">Balance Amount:*</label>
    <input type="text" class="form-control" name="balance_amount" id="balance_amount" required>
</div>
 <div class="col-md-4">
    <label class="form-label">Payment Mode:*</label>
    <select class="form-select" name="payment_mode" id="payment_mode" required>
        <option value="cash">Cash</option>
        <option value="credit_card">Credit Card</option>
        <option value="debit_card">Debit Card</option>
        <option value="net_banking">Net Banking</option>
        <option value="upi">UPI</option>
</select>
</div>
<div class="col-md-4">
    <label class="form-label">Round Off:</label>
    <input type="text" class="form-control" name="round_off" id="round_off" >
</div>
<div class="col-md-4">
    <label class="form-label">Discount:</label>
    <input type="text" class="form-control" name="discount" id="discount" >
</div>
<div class="row mt-3">
    <div class="col-12 d-flex justify-content-end">
        <h5>Sub Total: <span id="subtotal">0.00</span></h5><br>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <h5>shipping Charge: <span id="shipping">0.00</span></h5><br>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <h5>Discount: <span id="discount">0.00</span></h5><br>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <h4>Total Purchase Amount: <span id="grand_total">0.00</span></h4>
    </div>
    </div>
   <div class="row mt-3">
    <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Add Purchase</button>
    </div>
</div>
</form>
</div>
</div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/purchase.js') }}"></script>
<script>
$(document).ready(function() {

$(function () {
    $("#purchase_date").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0
    }).datepicker("setDate", new Date()); 
});

});
</script>