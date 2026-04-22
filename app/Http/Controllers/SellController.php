<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('sell.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sell.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{

    $request->validate([
        'customer_id'     => 'required',
       ]);
         $date = Carbon::createFromFormat('Y-m-d', $request->sales_date)->format('Y-m-d');
    $sale = Sell::create([
        'customer_id' => $request->customer_id,
        'sales_code' => $request->sales_code,
        'sales_date' => $date,
        'reference_no' => $request->reference_no,

        'subtotal' => $request->subtotal,
        'other_charges' => $request->other_charges,
        'discount' => $request->discount,
        'grand_total' => $request->grand_total,
    ]);

  
    foreach ($request->product_id as $key => $productId) {

        $qty = $request->qty[$key];
        $price = $request->price[$key];
        $discount = $request->discount_item[$key] ?? 0;
        $tax = $request->tax[$key];
        $taxAmount = $request->tax_amount[$key];

        $total = ($qty * $price) + $taxAmount - $discount;

        SaleItem::create([
            'sells_id' => $sale->id,
            'product_id' => $productId,
            'qty' => $qty,
            'price' => $price,
            'discount' => $discount,
            'tax' => $tax,
            'tax_amount' => $taxAmount,
            'total' => $total,
        ]);
    }

    return redirect()->back()->with('success', 'Sale saved successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell)
    {
        //
    }
}
