$(document).ready(function () {
    function calculateSellingPrice() {
        let purchaseExcTax = parseFloat($("#purchase_exc_tax").val()) || 0;
        let margin = parseFloat($("#margin").val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        // Selling Price (Excluding Tax)
        let sellExcPrice = purchaseExcTax + (purchaseExcTax * margin) / 100;

        // Selling Price (Including Tax)
        let sellIncPrice = sellExcPrice + (sellExcPrice * tax) / 100;

        $("#sell_exc_price").val(sellExcPrice.toFixed(2));
        $("#sell_inc_price").val(sellIncPrice.toFixed(2));
    }

    // Trigger calculation on input
    $("#purchase_exc_tax, #margin, #tax_percentage").on(
        "keyup change",
        function () {
            calculateSellingPrice();
        }
    );

    // Reverse margin from Selling EXC tax
    $("#sell_exc_price").on("keyup change", function () {
        let purchaseExc = parseFloat($("#purchase_exc_tax").val()) || 0;
        let sellExc = parseFloat($(this).val()) || 0;

        if (purchaseExc > 0) {
            let margin = ((sellExc - purchaseExc) / purchaseExc) * 100;
            $("#margin").val(margin.toFixed(2));
        }
    });

    // Reverse margin from Selling INC tax
    $("#sell_inc_price").on("keyup change", function () {
        let purchaseExc = parseFloat($("#purchase_exc_tax").val()) || 0;
        let sellInc = parseFloat($(this).val()) || 0;
        let tax = parseFloat($("#tax_percentage").val()) || 0;

        if (purchaseExc > 0 && tax > 0) {
            // Convert INC → EXC
            let sellExc = sellInc / (1 + tax / 100);

            let margin = ((sellExc - purchaseExc) / purchaseExc) * 100;

            $("#sell_exc_price").val(sellExc.toFixed(2));
            $("#margin").val(margin.toFixed(2));
        }
    });

    
   

});
