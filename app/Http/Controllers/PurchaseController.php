<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Supplier;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $suppliers = Supplier::all();
       return view('purchase.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $request->validate([
    'supplier_id' => 'required',
    'purchase_date' => 'required',
    'product_id' => 'required|array',
    ]);
     $date = Carbon::createFromFormat('d-m-Y', $request->purchase_date)
                ->format('Y-m-d');
        $purchase = Purchase::create([
        'supplier_id' => $request->supplier_id,
        'purchase_date' => $date ,
        'purchase_invoice_no' => $request->purchase_invoice_no,
        'shipping_charges' => $request->shipping_charges ?? 0,
        'paid_amount' => $request->paid_amount ?? 0,
        'payment_mode' => $request->payment_mode,
        'round_off' => $request->round_off ?? 0,
        'discount' => $request->discount ?? 0,
        'total_amount' => $request->grand_total ?? 0,
    ]);

    if ($request->product_id) {
        foreach ($request->product_id as $key => $product_id) {

            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $product_id,

                'qty' => $request->qty[$key] ?? 0,
                'mrp' => $request->mrp[$key] ?? 0,

                'purchase_exc_tax' => $request->purchase_exc_tax[$key] ?? 0,
                'purchase_inc_tax' => $request->purchase_inc_tax[$key] ?? 0,
                'tax_amount' => $request->tax_amount[$key] ?? 0,

                'unit_price' => $request->unit_price[$key] ?? 0,
                'price' => $request->price[$key] ?? 0,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Purchase Saved Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
