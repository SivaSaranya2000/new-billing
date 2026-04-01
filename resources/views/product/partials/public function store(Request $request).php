public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'product_type' => 'required'
    ]);

    DB::beginTransaction();

    try {

        // 1️⃣ Create Product (common)
        $product = Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'hsn_code' => $request->hsn_code,
            'barcode_type' => $request->barcode_type,
            'unit' => $request->unit,
            'brand' => $request->brand,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'business_location' => $request->business_location,
            'alert_quantity' => $request->alert_quantity,
            'manage_stock' => $request->manage_stock ?? 0,
            'product_type' => $request->product_type,
            'tax_type' => $request->tax_type,
        ]);

        // 2️⃣ SINGLE PRODUCT
        if ($request->product_type === 'single') {

            ProductPrice::create([
                'product_id' => $product->id,
                'mrp' => $request->mrp,
                'purchase_exc_tax' => $request->purchase_exc_tax,
                'purchase_inc_tax' => $request->purchase_inc_tax,
                'margin' => $request->margin,
                'sell_exc_price' => $request->sell_exc_price,
                'sell_inc_price' => $request->sell_inc_price,
                'tax_percentage' => $request->tax_percentage,
            ]);

        }

        // 3️⃣ VARIATION PRODUCT
        if ($request->product_type === 'variation') {
            $this->storeVariations($request, $product->id);
        }

        DB::commit();
        return redirect()->back()->with('success', 'Product created successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
}






/// store variation
private function storeVariations(Request $request, $productId)
{
    foreach ($request->variations as $variation) {

        // 1️⃣ Store variation
        $var = ProductVariation::create([
            'product_id' => $productId,
            'variation_name' => $variation['name'],
            'variation_value' => $variation['value'],
            'sku' => $variation['sku'],
        ]);

        // 2️⃣ Store price for each variation
        ProductPrice::create([
            'product_id' => $productId,
            'variation_id' => $var->id,
            'mrp' => $variation['mrp'],
            'purchase_exc_tax' => $variation['purchase_exc_tax'],
            'purchase_inc_tax' => $variation['purchase_inc_tax'],
            'margin' => $variation['margin'],
            'sell_exc_price' => $variation['sell_exc_price'],
            'sell_inc_price' => $variation['sell_inc_price'],
            'tax_percentage' => $variation['tax_percentage'],
        ]);
    }
}
