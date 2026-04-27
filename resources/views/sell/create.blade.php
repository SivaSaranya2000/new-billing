@extends('layout.nav')
@section('content')
<div class="content">
<div class="wrap-sells">
  <h2 class="saleh2">Add Sales </h2>
<!-- Header Fields -->
 <form id="productForm" action="{{route('sell.store')}}" method="POST" class="row g-3 mt-3">
      @csrf
  <div class="section-sale">
    <div class="grid2-sale">
      <div class="field-sale">
        <label class="sale-label">Warehouse <span>*</span></label>
        <select name="location" class="sales_types">
          <option value="sysytem_warehouse">System Warehouse</option>
          <option value="main_warehouse">Main Warehouse</option>
          <option value="secondary_warehouse">Secondary Warehouse</option>
        </select>
      </div>
      <div class="field">
        <label class="sale-label">Sales Code <span>*</span></label>
        <div class="inline2">
          <input value="SL/2021/02/" class="sales_types" readonly style="flex:2">
          <input name="sales_code"class="sales_types"  value="" style="flex:0.6;text-align:center">
        </div>
      </div>
      <div class="field">
        <label class="sale-label">Customer Name <span>*</span></label>
        <select name="customer_id" class="sales_types">
          <option value="1">Walk-in customer</option>
          <option value="2">Regular Customer</option>
          <option value="3">VIP Customer</option>
        </select>
        <div class="due-badges">Previous Due: &#8377;00.00</div>
      </div>
      <div class="field">
        <label class="sale-label">Sales Date <span>*</span></label>
        <input type="date" name="sales_date" class="sales_types" value="2026-04-09">
      </div>
      <div class="field">
        <label class="sale-label">Reference No.</label>
        <input type="text" name="reference_no" class="sales_types"  placeholder="Enter reference number">
      </div>
      <div class="field">
        <label class="sale-label">Due Date</label>
        <input type="date" class="sales_types">
      </div>
    </div>
  </div>

  <!-- Item Search & Table -->
  <div class="-sale">
    <div class="search-rows"> 
      <input type="text" id="item-search" class="sales_types" placeholder="Item name / Barcode / Item code" onkeydown="if(event.key==='Enter')addItem()">
      <button class="add-btns" onclick="addItem()">+</button>
    </div>
    <div id="product_list" class="list-group" 
     style="position:absolute; z-index:999; width:100%; display:none;">
</div>
    <table class="sale_table">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Discount (&#8377;)</th>
          <th>Tax Amount</th>
          <th>Tax</th>
          <th>Total Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="item-body">
        <tr class="empty-rows"><td colspan="8">No items added. Search and click + to add items.</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Bottom Section -->
  <div class="bottoms">
    <div class="left-bottoms">
      <div class="field">
        <label class="sale-label">Quantity</label>
        <div class="qty-badge" id="total-qty">0.00</div>
      </div>
      <div class="field">
        <label class="sale-label">Other Charges</label>
        <div class="inline2">
          <input type="number" class="sales_types" id="other-charges" value="0" min="0" oninput="recalc()" placeholder="0.00">
          <select id="other-type" onchange="recalc()" class="sales_types">
            <option>-Select-</option>
            <option>Add</option>
            <option>Subtract</option>
          </select>
        </div>
      </div>
      <div class="field">
        <label class="sale-label">Discount Coupon Code</label>
        <input type="text" id="coupon-code" placeholder="Enter coupon code" class="sales_types">
        <div class="coupon-info">
          <span>Coupon Type: <strong id="coupon-type">-</strong></span>
          <span>Coupon Value: <strong id="coupon-value">0.00</strong></span>
        </div>
      </div>
      <div class="field">
        <label class="sale-label">Discount on All</label>
        <div class="inline2">
          <input type="number" id="disc-all" value="0.00" min="0" oninput="recalc()" class="sales_types">
          <select id="disc-type" onchange="recalc()" class="sales_types">
            <option>Per%</option>
            <option>Fixed</option>
          </select>
        </div>
      </div>
    </div>

    <div class="right-summary">
      <div class="summary-rows">
        <span class="summary-label">Subtotal</span>
        <span class="summary-val" id="s-subtotal-display">0.00</span>
        <input type="hidden"  name="subtotal" readonly id="s-subtotal" class="sales_types">
      </div>
      <div class="summary-rows">
        <span class="summary-label">Other Charges</span>
        <span class="summary-val" id="s-other-display">0.00</span>
        <input type="hidden"  name="other_charges" readonly id="s-other" class="sales_types">
        
      </div>
      <div class="summary-rows">
        <span class="summary-label">Coupon Discount</span>
        <span class="summary-val" id="s-coupon">0.00</span>
      </div>
      <div class="summary-rows">
        <span class="summary-label">Discount on All</span>
        <span class="summary-val" id="s-disc-display">0.00</span>
        <input type="hidden"  name="discount" readonly id="s-disc" class="sales_types">
      </div>
      <div class="summary-rows">
        <span class="summary-label">Round Off &#9432;</span>
        <span class="summary-val" id="s-round">0.00</span>
      </div>
      <div class="summary-rows">
        <span>Grand Total</span>
        <span class="summary-val grand" id="s-grand-display">0.00</span>
        <input type="hidden"  name="grand_total" readonly id="s-grand" class="sales_types">
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="action-row">
    <button class="btn btn-secondary" onclick="resetForm()">Reset</button>
    <button class="btn btn-primary" onclick="saveInvoice()">Save Invoice</button>
  </div>
</form>
</div>
</div>


@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/sale.js') }}"></script>