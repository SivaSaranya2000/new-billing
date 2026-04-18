$(document).ready(function () {

    let lastEdited = "";
    //  Purchase EXC change
    $("#purchase_exc_tax").on("keyup change", function () {

        lastEdited = "exc";

        let purchaseExc = parseFloat($(this).val()) || 0;
        let margin = parseFloat($("#margin").val()) || 0;

        let sellExc = purchaseExc + margin;

        $("#sell_exc_price").val(sellExc.toFixed(2));
    });

    // Purchase INC change
    $("#purchase_inc_tax").on("keyup change", function () {

        lastEdited = "inc";

        let purchaseInc = parseFloat($(this).val()) || 0;
        let margin = parseFloat($("#margin").val()) || 0;

        let sellInc = purchaseInc + margin;

        $("#sell_inc_price").val(sellInc.toFixed(2));
    });

    // COMMON TAX CALCULATION FUNCTION
    function taxcalculation() {

        let purchaseExc = parseFloat($("#purchase_exc_tax").val()) || 0;
        let purchaseInc = parseFloat($("#purchase_inc_tax").val()) || 0;
        let margin = parseFloat($("#margin").val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        let taxVal = tax / 100;

        // Selling EXC
        let sellExc = purchaseExc + margin;

        // Tax
        let taxAmount = purchaseInc * taxVal;

        // Selling INC
        let sellInc = purchaseInc + margin + taxAmount;

        $("#sell_exc_price").val(sellExc.toFixed(2));
        $("#sell_inc_price").val(sellInc.toFixed(2));
        $("#tax_amount").val(taxAmount.toFixed(2));
    }

    // Margin change → update BOTH
    $("#margin").on("keyup change", function () {
        taxcalculation();
    });

    // Tax change → update BOTH
    $("#tax_percentage").on("keyup change", function () {
        taxcalculation();
    });

    // Purchase change → also trigger tax calc
    $("#purchase_exc_tax, #purchase_inc_tax").on("keyup change", function () {
        validatePurchase();
        taxcalculation();
    });

    $("#sell_exc_price").on("keyup change", function () {

        let sellExc = parseFloat($(this).val()) || 0;
        let purchaseExc = parseFloat($("#purchase_exc_tax").val()) || 0;

        let margin = sellExc - purchaseExc;

        $("#margin").val(margin.toFixed(2));
    });

    function validatePurchase() {

        let purchaseInc = parseFloat($("#purchase_inc_tax").val()) || 0;
        let purchaseExc = parseFloat($("#purchase_exc_tax").val()) || 0;

        if (purchaseExc > purchaseInc) {
            $("#priceAlert")
                .removeClass("d-none")
                .text("Purchase EXC should not be greater than Purchase INC!");
        } else {
            $("#priceAlert").addClass("d-none").text("");
        }
    }

});



