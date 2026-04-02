<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Variation;
use App\Models\Unit;
use App\Models\Business;
use App\Models\Brand;
use App\models\productprice;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variations = Variation::all();
        $units = Unit::all();
        $brands = Brand::all();
        $business = Business::all();
        return view('product.create', compact('variations', 'units', 'brands', 'business'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name'     => 'required',
       ]);

        DB::beginTransaction();

    try {
        
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

        ProductPrice::create([
            'product_id' => $product->id,
            'mrp' => $request->mrp,
            'unit_price' => $request->unit_price,
            'purchase_exc_tax' => $request->purchase_exc_tax,
            'purchase_inc_tax' => $request->purchase_inc_tax,
            'margin' => $request->margin,
            'sell_exc_price' => $request->sell_exc_price,
            'sell_inc_price' => $request->sell_inc_price,
            'tax_percentage' => $request->tax_percentage,
            'tax_amount' => $request->tax_amount,
        ]);
 
        DB::commit();

        return redirect()->back()->with('success', 'Product created successfully');

    } catch (\Exception $e) {

        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
    }
    
public function search(Request $request)
{
    $search = $request->search;

    $products = DB::table('products')
        ->join('product_prices', 'products.id', '=', 'product_prices.product_id')
        ->where(function($q) use ($search) {
            $q->where('products.name', 'LIKE', "%$search%")
              ->orWhere('products.sku', 'LIKE', "%$search%");
        })
        ->select(
            'products.id',
            'products.name',
            'products.sku',
            'products.hsn_code',
            'product_prices.sell_inc_price',
            'product_prices.sell_exc_price',
            'product_prices.purchase_exc_tax',
            'product_prices.purchase_inc_tax',
            'product_prices.mrp',
            'product_prices.unit_price',
            'product_prices.tax_amount',
            
        )
        ->limit(15)
        ->get();

    return response()->json($products);
}
    
     private  function variation(Request $request)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
