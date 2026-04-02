$(document).ready(function () {

    function calculatePurchase() {
        let unit = parseFloat($("#unit_price").val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;
        let type = $("#tax").val();

        let taxVal = tax / 100;

        let exc = 0, inc = 0;

        if (type === "inclusive") {
            // 🔥 Your logic
            inc = unit;
            exc = unit * (1 + taxVal);
        } else {
            exc = unit;
            inc = unit * (1 + taxVal);
        }

        $("#purchase_exc_tax").val(exc.toFixed(2));
        $("#purchase_inc_tax").val(inc.toFixed(2));
    }

    function calculateSelling() {
        let unit = parseFloat($("#unit_price").val()) || 0;
        let margin = parseFloat($("#margin").val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        let taxVal = tax / 100;

        let sellExc = unit * (1 + margin / 100);
        let sellInc = sellExc * (1 + taxVal);

        $("#sell_exc_price").val(sellExc.toFixed(2));
        $("#sell_inc_price").val(sellInc.toFixed(2)); 
    }

    function reverseFromSelling() {
        let sellExc = parseFloat($("#sell_exc_price").val()) || 0;
        let unit = parseFloat($("#unit_price").val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        let taxVal = tax / 100;

        let sellInc = sellExc * (1 + taxVal);
        $("#sell_inc_price").val(sellInc.toFixed(2));

        if (unit > 0) {
            let margin = ((sellExc - unit) / unit) * 100;
            $("#margin").val(margin.toFixed(2));
        }
    }

   function calculateTaxAmounts() {
    let sellExc = parseFloat($("#sell_exc_price").val()) || 0;
    let tax = parseFloat($("#tax_percentage").val()) || 0;

    let taxVal = tax / 100;

    let sellingTax = sellExc * taxVal;

    $("#tax_amount").val(sellingTax.toFixed(2));
}

    function validateMRP() {
        let mrp = parseFloat($("#mrp").val()) || 0;
        let sellInc = parseFloat($("#sell_inc_price").val()) || 0;

        if (mrp > 0 && sellInc > mrp) {
            $("#priceAlert")
                .removeClass("d-none")
                .text("Selling price cannot be greater than MRP!");

            $("#sell_exc_price").addClass("is-invalid");
            return false;
        } else {
            $("#priceAlert").addClass("d-none").text("");
            $("#sell_exc_price").removeClass("is-invalid");
            return true;
        }
    }

    function fullCalculation() {
        calculatePurchase();
        calculateSelling();
        calculateTaxAmounts(); 
        validateMRP();
    }

    $("#unit_price, #tax_percentage, #margin").on("keyup change", function () {
        fullCalculation();
    });

    $("#tax").on("change", function () {
        fullCalculation();
    });

    $("#sell_exc_price").on("keyup change", function () {
        reverseFromSelling();
        calculateTaxAmounts();
        validateMRP();
    });

    $("#purchase_exc_tax").on("keyup change", function () {
        let exc = parseFloat($(this).val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        let inc = exc * (1 + tax / 100);
        $("#purchase_inc_tax").val(inc.toFixed(2));

        calculateSelling();
        calculateTaxAmounts();
    });

    $("#purchase_inc_tax").on("keyup change", function () {
        let inc = parseFloat($(this).val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        let exc = inc * (1 + tax / 100); 
        $("#purchase_exc_tax").val(exc.toFixed(2));

        calculateSelling();
        calculateTaxAmounts();
    });

    fullCalculation();

});