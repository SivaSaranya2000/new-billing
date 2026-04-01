@extends('layout.nav')
@section('content')
 <div class="content">

<div class="card p-4 mt-1">
    <h3 class="text-center ">Add Product</h3>
<form id="productForm" action="{{ route('products.store') }}" method="POST" class="row g-3 mt-3">
      @csrf

      <div class="col-md-4">
        <label class="form-label">Product Name:*</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">SKU:</label><br><small class="text-warning">Auto-generate the SKU code if it is blank.</small>
        <input type="text" class="form-control" name="sku" id="sku" placeholder="Enter SKU code">
      </div>
      <div class="col-md-4">
        <label class="form-label">Hsn Code:</label>
        <input type="text" class="form-control" name="hsn_code" id="hsn_code" placeholder="Enter HSN code">
      </div>
      <div class="col-md-4">
        <label class="form-label">Barcode Type:</label>
        <select class="form-select" name="barcode_type" id="barcode_type">
          <option value="">Please Select</option>
          <option value="C128">Code 128 (C128)</option>
          <option value="C39">Code 39 (C39)</option>
        </select>                 
        </div>
        <div class="col-md-4">
        <label class="form-label">Unit:</label>
        <select class="form-select" name="unit" id="unit">
          <option value="">Please Select</option>
          @foreach($units as $unit)
          <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
          @endforeach
        </select>                 
        </div>
        <div class="col-md-4">
        <label class="form-label">Brand:</label>
        <select class="form-select" name="brand" id="brand">
         <option value="">Please Select</option>
          @foreach($brands as $brand)
          <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
          @endforeach
        
        </select>                 
        </div>
        <div class="col-md-4">
        <label class="form-label">Category:</label>
        <select class="form-select" name="category" id="category">
          <option value="">Please Select</option>
        </select>                 
        </div>
        <div class="col-md-4">
        <label class="form-label">Sub Category:</label>
        <select class="form-select" name="sub_category" id="sub_category">
          <option value="">Please Select</option>
        </select>                 
        </div>
        
         <div class="col-md-4">
        <label class="form-label">Business Location:</label>
        <select class="form-select" name="business_location" id="business_location">
          <option value="">Please Select</option>
          @foreach($business as $biz)
          <option value="{{$biz->id}}">{{$biz->name}}</option>  
          @endforeach
        </select>                 
        </div>
        <div class="col-md-4">
        <input type="checkbox" class="form-check-input" name="manage_stock" id="manage_stock" value="1">
         <label class="form-label">Manage Stock:<i class="fa fa-info-circle text-primary infoTip" data-bs-toggle="tooltip" data-bs-placement="top" title="Margin = Profit % added on unit price"></i>
         </label>
         <p class="product_p">Enable stock management of this product level</p>
       </div>
      <div class="col-md-4">
        <label class="form-label">Alert Quantity:</label>
        <input type="text" class="form-control" name="alert_quantity" id="alert_quantity" placeholder="Enter alert quantity">
      </div>
      <div class="col-md-4">
        <label class="form-label">Opening Stock:</label>
        <input type="text" class="form-control" name="opening_stock" id="opening_stock" placeholder="Enter opening stock">
    </div>
        <div class="col-md-4">
        <label class="form-label">Product Type:</label>
        <select class="form-select" name="product_type" id="product_type">
          <option value="single">Single Product</option>
          <option value="variation">Variation Product</option>
        </select>                 
        </div>
         <div class="col-md-4">
       <label class="form-label">Applicable Tax:</label>
        <select class="form-select" name="tax_percentage" id="tax_percentage">
          <option value="">none</option>
          <option value="5">5%</option>
          <option value="12">12%</option>
          <option value="18">18%</option>
          <option value="28">28%</option>
        </select>  
     </div>
      <div class="col-md-4">
       <label class="form-label">Selling price Tax Type:</label>
        <select class="form-select" name="tax_type" id="tax">
          <option value="inclusive">Inclusive</option>
          <option value="exclusive">Exclusive</option>
        </select>  
     </div>
    
     
    <hr/>
    @include('product.partials.single')
    @include('product.partials.variation')
   <div class="row mt-3">
    <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-success" id="addProductBtn">Add Product</button>
    </div>
</div>


</form>
    
</div>
</div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
        new bootstrap.Tooltip(el);
    });
});
</script>
<script>
$(document).ready(function() {
  $('#single_section').show();
  $('#variation_section').hide();
    $('#product_type').change(function() {
        var type = $(this).val();
        
        if (type === 'single') {
            $('#single_section').show();
            $('#variation_section').hide();
        } else if (type === 'variation') {
            $('#single_section').hide();
            $('#variation_section').show();
        }
    });

$("#variation_name").on("change", function () {
  $("#variation_table_body").empty();
    let id = $(this).val();

    $.ajax({
        url: "/variation-values/" + id,
        type: "GET",

        success: function (res) {

            let html = "";

            res.values.forEach(function (item) {
                html += `
                    <tr>
                        <td>${item.value}</td>

                        <td><input type="text" class="form-control" name="mrp[]" placeholder="Enter MRP"></td>
                        <td><input type="text" class="form-control" name="unit_price[]" placeholder="Enter Unit Price"></td>
                        <td><input type="text" class="form-control" name="margin[]" placeholder="Enter Margin"></td>
                        <td><input type="text" class="form-control" name="sale_price[]" placeholder="Enter Sale Price"></td>

                        <td><button type="button" class="btn btn-danger removeRow">-</button></td>
                    </tr>
                `;
            });

            $("#variation_table_body").html(html);
        },

    });
});


// row remove button
$(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove();
});

});
</script>
