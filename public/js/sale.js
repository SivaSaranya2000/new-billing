$(document).ready(function () {

    /* ===============================
       PRODUCT SEARCH
    =============================== */
    $("#item-search").on("keyup", function () {

        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: "/product-search",
                type: "GET",
                data: { search: query },

                success: function (data) {

                    let html = "";

                    data.forEach(function (product) {
                        html += `
                        <a href="#" class="list-group-item list-group-item-action select-product"
                            data-id="${product.id}"
                            data-name="${product.name}"
                            data-price="${product.sell_inc_price}"
                            data-tax="${product.tax_percentage}">
                            
                            ${product.name} (${product.sku}) - ₹${product.sell_inc_price}
                        </a>`;
                    });

                    $("#product_list").html(html).show();
                }
            });
        } else {
            $("#product_list").hide();
        }
    });

    /* ===============================
       ENTER KEY SELECT
    =============================== */
    $("#item-search").on("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            let first = $("#product_list .select-product").first();
            if (first.length) addProduct(first);
        }
    });

    /* ===============================
       CLICK SELECT PRODUCT
    =============================== */
    $(document).on("click", ".select-product", function (e) {
        e.preventDefault();
        addProduct($(this));
    });

    /* ===============================
       LIVE EVENTS
    =============================== */
    $(document).on("keyup change", ".qty, .price, .discount, .tax", function () {
        recalc();
    });

    $(document).on("click", ".remove", function () {
        $(this).closest("tr").remove();
        recalc();
    });

    $("#other-charges, #disc-all, #disc-type").on("keyup change", function () {
        recalc();
    });

});


/* =========================================
   ADD PRODUCT ROW
========================================= */
function addProduct(el) {

    let id = el.data("id");
    let name = el.data("name");
    let price = parseFloat(el.data("price")) || 0;
    let tax = parseFloat(el.data("tax")) || 0;

    $(".empty-row").remove();

    let row = `
    <tr>
        <td>
            ${name}
            <input type="hidden" name="product_id[]" value="${id}">
        </td>

        <td>
            <input type="number" name="qty[]" class="form-control qty" value="1">
        </td>

        <td>
            <input type="number" name="price[]" class="form-control price" value="${price}">
        </td>

        <td>
            <input type="number" name="discount[]" class="form-control discount" value="0">
        </td>

        <td>
            <input type="number" name="tax_amount[]" class="form-control tax_amount" readonly>
        </td>

        <td>
            <select class="form-control tax" name="tax[]">
                <option value="0">0%</option>
                <option value="5" ${tax==5?'selected':''}>5%</option>
                <option value="12" ${tax==12?'selected':''}>12%</option>
                <option value="18" ${tax==18?'selected':''}>18%</option>
                <option value="28" ${tax==28?'selected':''}>28%</option>
            </select>
        </td>

        <td class="total">0.00</td>

        <td>
            <button type="button" class="btn btn-danger remove">X</button>
        </td>
    </tr>
    `;

    $("#item-body").append(row);

    $("#product_list").hide();
    $("#item-search").val("");

    recalc();
}


/* =========================================
   MAIN CALCULATION
========================================= */
function recalc() {

    let subtotal = 0;
    let totalQty = 0;

    $("#item-body tr").each(function () {

        let qty = parseFloat($(this).find(".qty").val()) || 0;
        let price = parseFloat($(this).find(".price").val()) || 0;
        let discount = parseFloat($(this).find(".discount").val()) || 0;
        let tax = parseFloat($(this).find(".tax").val()) || 0;

        let base = qty * price;
        let taxAmount = (base * tax) / 100;
        let total = base + taxAmount - discount;

        $(this).find(".tax_amount").val(taxAmount.toFixed(2));
        $(this).find(".total").text(total.toFixed(2));

        subtotal += total;
        totalQty += qty;
    });

    $("#total-qty").text(totalQty.toFixed(2));

    /* ==== DISPLAY ==== */
    $("#s-subtotal-display").text(subtotal.toFixed(2));

    /* ==== STORE ==== */
    $("#s-subtotal").val(subtotal.toFixed(2));

    calculateGrand(subtotal);
}


/* =========================================
   GRAND TOTAL
========================================= */
function calculateGrand(subtotal) {

    let other = parseFloat($("#other-charges").val()) || 0;
    let discountInput = parseFloat($("#disc-all").val()) || 0;
    let type = $("#disc-type").val();

    let discount = (type === "Per%")
        ? (subtotal * discountInput / 100)
        : discountInput;

    let grand = subtotal + other - discount;

    /* ==== DISPLAY ==== */
    $("#s-other-display").text(other.toFixed(2));
    $("#s-disc-display").text(discount.toFixed(2));
    $("#s-grand-display").text(grand.toFixed(2));

    /* ==== STORE ==== */
    $("#s-other").val(other.toFixed(2));
    $("#s-disc").val(discount.toFixed(2));
    $("#s-grand").val(grand.toFixed(2));
}