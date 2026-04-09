@extends('layout.nav')
@section('content')
<div class="content">
<div class="wrap">
  <h2>Add Sales </h2>
<!-- Header Fields -->
  <div class="section">
    <div class="grid2">
      <div class="field">
        <label>Warehouse <span>*</span></label>
        <select>
          <option>System Warehouse</option>
          <option>Main Warehouse</option>
          <option>Secondary Warehouse</option>
        </select>
      </div>
      <div class="field">
        <label>Sales Code <span>*</span></label>
        <div class="inline2">
          <input value="SL/2021/02/" readonly style="flex:2">
          <input value="9" style="flex:0.6;text-align:center">
        </div>
      </div>
      <div class="field">
        <label>Customer Name <span>*</span></label>
        <select>
          <option>Walk-in customer</option>
          <option>Regular Customer</option>
          <option>VIP Customer</option>
        </select>
        <div class="due-badge">Previous Due: &#8377;50,000.00</div>
      </div>
      <div class="field">
        <label>Sales Date <span>*</span></label>
        <input type="date" value="2026-04-09">
      </div>
      <div class="field">
        <label>Reference No.</label>
        <input type="text" placeholder="Enter reference number">
      </div>
      <div class="field">
        <label>Due Date</label>
        <input type="date">
      </div>
    </div>
  </div>

  <!-- Item Search & Table -->
  <div class="section">
    <div class="search-row">
      <input type="text" id="item-search" placeholder="Item name / Barcode / Item code" onkeydown="if(event.key==='Enter')addItem()">
      <button class="add-btn" onclick="addItem()">+</button>
    </div>
    <table>
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
        <tr class="empty-row"><td colspan="8">No items added. Search and click + to add items.</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Bottom Section -->
  <div class="bottom">
    <div class="left-bottom">
      <div class="field">
        <label>Quantity</label>
        <div class="qty-badge" id="total-qty">0.00</div>
      </div>
      <div class="field">
        <label>Other Charges</label>
        <div class="inline2">
          <input type="number" id="other-charges" value="0" min="0" oninput="recalc()" placeholder="0.00">
          <select id="other-type" onchange="recalc()">
            <option>-Select-</option>
            <option>Add</option>
            <option>Subtract</option>
          </select>
        </div>
      </div>
      <div class="field">
        <label>Discount Coupon Code</label>
        <input type="text" id="coupon-code" placeholder="Enter coupon code">
        <div class="coupon-info">
          <span>Coupon Type: <strong id="coupon-type">-</strong></span>
          <span>Coupon Value: <strong id="coupon-value">0.00</strong></span>
        </div>
      </div>
      <div class="field">
        <label>Discount on All</label>
        <div class="inline2">
          <input type="number" id="disc-all" value="0.00" min="0" oninput="recalc()">
          <select id="disc-type" onchange="recalc()">
            <option>Per%</option>
            <option>Fixed</option>
          </select>
        </div>
      </div>
    </div>

    <div class="right-summary">
      <div class="summary-row">
        <span class="summary-label">Subtotal</span>
        <span class="summary-val" id="s-subtotal">0.00</span>
      </div>
      <div class="summary-row">
        <span class="summary-label">Other Charges</span>
        <span class="summary-val" id="s-other">0.00</span>
      </div>
      <div class="summary-row">
        <span class="summary-label">Coupon Discount</span>
        <span class="summary-val" id="s-coupon">0.00</span>
      </div>
      <div class="summary-row">
        <span class="summary-label">Discount on All</span>
        <span class="summary-val" id="s-disc">0.00</span>
      </div>
      <div class="summary-row">
        <span class="summary-label">Round Off &#9432;</span>
        <span class="summary-val" id="s-round">0.00</span>
      </div>
      <div class="summary-row">
        <span>Grand Total</span>
        <span class="summary-val grand" id="s-grand">0.00</span>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="action-row">
    <button class="btn btn-secondary" onclick="resetForm()">Reset</button>
    <button class="btn btn-primary" onclick="saveInvoice()">Save Invoice</button>
  </div>
</div>
</div>


@endsection