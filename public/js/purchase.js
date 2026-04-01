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
                            data-price="${product.sell_inc_price}"
                            data-mrp="${product.mrp}"
                            data-purchase_exc_tax="${product.purchase_exc_tax}"
                            data-purchase_inc_tax="${product.purchase_inc_tax}"
                            ">
                            ${product.name} (${product.sku}) - ₹${product.sell_inc_price}
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
                <input type="number" name="price[]" value="${price}" class="form-control price">
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row">X</button>
            </td>
        </tr>
    `;

    $('#product_table tbody').append(row);

    $('#product_list').hide();
    $('#product_search').val('');
});

$(document).on('click', '.remove-row', function() {
    $(this).closest('tr').remove();
});
});