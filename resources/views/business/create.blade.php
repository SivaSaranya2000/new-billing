@extends('layout.nav')
@section('content')
<div class="content">
    <h3 class="text-center">Add Business Details</h3>
    <form id="businessForm" action="{{ route('business-settings.store') }}" method="POST" class="row g-3 mt-3">
      @csrf
      <div class="row">
      <div class="col-md-4">
        <label class="form-label">Business Name:*</label>
        <input type="text" class="form-control" name="name" id="name" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Business Number:*</label>
        <input type="text" class="form-control" name="number" id="number" >
      </div>
        <div class="col-md-4">
            <label class="form-label">Phone Number:*</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" >
        </div>  
        <div class="col-md-4">
            <label class="form-label">Website:</label>
            <input type="text" class="form-control" name="website" id="website" >
        </div>
      
</div>
  <hr/>
<div class="row">
    <h4>Address:</h4>
         <div class="col-md-4">
            <label class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" id="address" >
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
                <label class="form-label">Country:</label>
                <input type="text" class="form-control" name="country" id="country" >
       </div>
        <div class="col-md-4">
                <label class="form-label">Zip Code:</label>
                <input type="text" class="form-control" name="zip_code" id="zip_code" > 
        </div>
        <div class="col-md-4">
                <label class="form-label">GST Number:</label>
                <input type="text" class="form-control" name="gst_number" id="gst_number" > 
        </div>
        <div class="col-md-4">
                <label class="form-label">PAN Number:</label>
                <input type="text" class="form-control" name="pan_number" id="pan_number" > 
        </div>
     
      </div>
       <hr>
       <div class="row">
        <h4>Billing Settings</h4>
        <div class="col-md-4">
            <label class="form-label">Invoice Prefix:</label>
            <input type="text" class="form-control" name="invoice_prefix" id="invoice_prefix" >
      </div>
        <div class="col-md-4">
            <label class="form-label">Starting Invoice Number:</label>
            <input type="number" class="form-control" name="starting_invoice_number" id="starting_invoice_number" > 
       </div>
       </div>
       <hr>
       <div class="row">
        <h4>Additional Information</h4>
        <div class="col-md-4">
            <label class="form-label">Currency:</label>
            <input type="text" class="form-control" name="currency" id="currency" >     
        </div>
        <div class="col-md-4">
            <label class="form-label">Date Format:</label>
            <input type="text" class="form-control" name="date_format" id="date_format" >   
        </div>
        <div class="col-md-4">
            <label class="form-label">SMS & Email Settings:</label>
        </div>
</div>
        <div class="col-md-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Add Business</button>
        </div>
        

       </div>
    </form>
</div>
@endsection