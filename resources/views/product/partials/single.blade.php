<div class="row"  id="single_section">
  <table class="table table-bordered">
    <tr>
      <th>MRP</th>
      <th>Default Purchase Price</th>
      <th>X margin(%)</th>
      <th>Default Selling Price</th>
    </tr>
    <tr>
    <td>
      <div class="col-md-12">
        &nbsp;
        <input type="text" class="form-control mt-2" name="mrp" id="mrp" placeholder="Enter MRP">
      </div>
    </td>
    <td>
      <div class="row">
      <div class="col-md-6">
        <label class="form-label">Exc Tax:*</label>
        <input type="text" class="form-control" name="purchase_exc_tax" id="purchase_exc_tax" placeholder="Enter Exc Tax">
      </div>
      <div class="col-md-6">
        <label class="form-label">Inc Tax:*</label>
        <input type="text" class="form-control" name="purchase_inc_tax" id="purchase_inc_tax" placeholder="Enter Inc Tax">
      </div>
      </div>
    </td>
    <td>
      <div class="col-md-12">
        &nbsp;
         <input type="text" class="form-control mt-2" name="margin" value= "5" id="margin" placeholder="Enter Margin">
  </div>
    </td>
   <td>
    <div class="col-md-12">
      <label class="form-label">Exc Tax:</label>
      <input type="text" class="form-control" name="sell_exc_price" id="sell_exc_price" placeholder="Enter Sale Price">
      <input type="hidden" class="form-control" name="sell_inc_price" id="sell_inc_price" value="" placeholder="Enter Sale Price">

    </div>
    </td>
    </tr>
  </table>
  

</div>
<div id="priceAlert" class="alert alert-danger d-none"></div>
