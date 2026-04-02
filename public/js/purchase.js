$(document).ready(function () {
    $('#product_search').on('keyup', function() {
    let query = $(this).val();
    if (query.length > 1) {
        $.ajax({
            url: "/product-search",
            type: "GET",
            data: { search: query },
            success: function(data) {

                let html = '';

                data.forEach(function(product) {
                    html += `
                        <a href="#" class="list-group-item list-group-item-action select-product"
                           data-id="${product.id}"
                           data-name="${product.name}"
                            data-price="${product.sell_exc_price}"
                            data-mrp="${product.mrp}"
                            data-purchase_exc_tax="${product.purchase_exc_tax}"
                            data-purchase_inc_tax="${product.purchase_inc_tax}"
                            data-unit-price="${product.unit_price}"
                            data-tax_amount="${product.tax_amount}"
                            
                            ">
                            ${product.name} (${product.sku}) - ₹${product.sell_exc_price}
                        </a>
                    `;
                });
                $('#product_list').html(html).show ();
            }
        });
    } else {
        $('#product_list').hide();
    }
});

$(document).on('click', '.select-product', function(e) {
    e.preventDefault();

    let id = $(this).data('id');
    let name = $(this).data('name');
    let price = $(this).data('price');
    let mrp = $(this).data('mrp');
    let purchase_exc_tax = $(this).data('purchase_exc_tax');
    let purchase_inc_tax = $(this).data('purchase_inc_tax');
    let unit_price = $(this).data('unitPrice');
    let tax_amount = $(this).data('tax_amount');

   let row = `
<tr>
    <td>
        ${name}
        <input type="hidden" name="product_id[]" value="${id}">
    </td>
    <td>
        <input type="number" name="qty[]" value="1" class="form-control qty">
    </td>
    <td>
        <input type="number" name="mrp[]" value="${mrp}" class="form-control mrp">
    </td>
    <td>
        <input type="number" name="purchase_exc_tax[]" value="${purchase_exc_tax}" class="form-control purchase_exc_tax">
    </td>
    <td>
        <input type="number" name="purchase_inc_tax[]" value="${purchase_inc_tax}" class="form-control purchase_inc_tax">
    </td>
    <td>
        <input type="number" name="tax_amount[]" value="${tax_amount}" 
        class="form-control tax_amount" data-base-tax="${tax_amount}">
    </td>
    <td>
        <input type="number" name="unit_price[]" value="${unit_price}" class="form-control unit_price">
    </td>
    <td>
        <input type="number" name="price[]" value="${price}" 
        class="form-control price" data-base-price="${price}">
    </td>
    <td>
        <button type="button" class="btn btn-danger remove-row">X</button>
    </td>
</tr>
`;

    $('#product_table tbody').append(row);

    $('#product_list').hide();
    $('#product_search').val('');
    calculateGrandTotal(); 
});

$(document).on('click', '.remove-row', function() {
    $(this).closest('tr').remove();
});

// Qty change
$(document).on('keyup change', '.qty', function () {
    let row = $(this).closest('tr');

    let qty = parseFloat($(this).val()) || 1;

    let basePrice = parseFloat(row.find('.price').data('base-price')) || 0;
    let baseTax = parseFloat(row.find('.tax_amount').data('base-tax')) || 0;

    row.find('.price').val((qty * basePrice).toFixed(2));
    row.find('.tax_amount').val((qty * baseTax).toFixed(2));

    calculateGrandTotal(); // 
});

function calculateGrandTotal() {
    let subtotal = 0;
    let totalTax = 0;

    $('#product_table tbody tr').each(function () {
        subtotal += parseFloat($(this).find('.price').val()) || 0;
        totalTax += parseFloat($(this).find('.tax_amount').val()) || 0;
    });
    let shipping = parseFloat($("#shipping_charges").val()) || 0;
    let discount = parseFloat($("#discount").val()) || 0;
    let roundOff = parseFloat($("#round_off").val()) || 0;
    let paid = parseFloat($("#paid_amount").val()) || 0;

  
    let grandTotal = subtotal + totalTax + shipping - discount + roundOff;

    let balance = grandTotal - paid;

    // $("#grand_total").val(grandTotal.toFixed(2));
       $("#grand_total").text(grandTotal.toFixed(2));
       $("#subtotal").text(subtotal.toFixed(2));
       $("#shipping").text(shipping.toFixed(2));
       $("#discount").text(discount.toFixed(2));
    $("#balance_amount").val(balance.toFixed(2));
}

$("#shipping_charges, #discount, #round_off, #paid_amount")
.on("keyup change", function () {
    calculateGrandTotal();
});
$(document).on('click', '.remove-row', function () {
    $(this).closest('tr').remove();
    calculateGrandTotal(); 
});

});