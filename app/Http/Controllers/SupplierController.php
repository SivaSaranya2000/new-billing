<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supplier.index');
    }
     
   public function data_all_supplier(Request $request)
{
    $suppliers = Supplier::select([
        'id', 'name', 'phone', 'email', 'supplier_code', 'gst_number', 'state', 'address'
    ]);

    return DataTables::of($suppliers)
        ->addColumn('action', function ($supplier) {
           $editUrl = route('suppliers.edit', $supplier->id);
            return '
                <a href="' . $editUrl . '" 
                    class="btn btn-primary btn-sm editSupplierBtn">
                    <i class="fa fa-edit"></i>
                </a>
                &nbsp;
                <a href="javascript:void(0)" data-id="' . $supplier->id . '" 
                    class="btn btn-danger btn-sm deleteSupplierBtn">
                    <i class="fa fa-trash"></i>
                </a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
      {
    $request->validate([
        'name'     => 'required',
        'email'    => 'nullable|email',
        'phone'   => 'required',
        'supplier_code' => 'nullable',
        'city' => 'nullable',
        'state' => 'nullable',
        'gst_number' => 'nullable',
        'address'  => 'nullable',
    ]);

    try {
        $data = $request->all();
            
    if (empty($request->supplier_code)) {

        $lastSupplier = Supplier::orderBy('id', 'DESC')->first();

        if (!$lastSupplier || empty($lastSupplier->supplier_code)) {
            $nextNumber = 1;
        } else {
            $lastCode = $lastSupplier->supplier_code;
            $number = (int) filter_var($lastCode, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = $number + 1;
        }
        $generatedCode = "Sup_" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    } else {
        $generatedCode = $request->supplier_code;   
    }
        $form_data = [
            'name'          => $data['name'],
            'phone'         => $data['phone'],
            'email'         => $data['email'],
            'supplier_code' => $generatedCode,
            'city'          => $data['city'],
            'state'         => $data['state'],
            'gst_number'    => $data['gst_number'],
            'address'       => $data['address'],
        ];

        Supplier::create($form_data);

        return redirect()->route('suppliers.index')->with('success', 'New Supplier Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->route('suppliers.index')->with('error', 'Something went wrong! Please try again.');
    }
  }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $supplier = Supplier::findOrFail($id);
    return view('supplier.edit')->with(compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'name'          => 'required',
        'email'         => 'nullable|email',
        'phone'         => 'required',
        'supplier_code' => 'nullable',
        'city'          => 'nullable',
        'state'         => 'nullable',
        'gst_number'    => 'nullable',
        'address'       => 'nullable',
    ]);

    try {
        $supplier = Supplier::findOrFail($id);
        if (empty($request->supplier_code)) {
            $lastSupplier = Supplier::orderBy('id', 'DESC')->first();
            if (!$lastSupplier || empty($lastSupplier->supplier_code)) {
                $nextNumber = 1;
            } else {
                $lastCode = $lastSupplier->supplier_code;
                $number = (int) filter_var($lastCode, FILTER_SANITIZE_NUMBER_INT);
                $nextNumber = $number + 1;
            }
            $generatedCode = "Sup_" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $generatedCode = $request->supplier_code;
        }
        $form_data = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'supplier_code' => $generatedCode,
            'city'          => $request->city,
            'state'         => $request->state,
            'gst_number'    => $request->gst_number,
            'address'       => $request->address,
        ];
        $supplier->update($form_data);
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier Updated Successfully!');
    } catch (\Exception $e) {
        return redirect()->route('suppliers.index')
                         ->with('error', 'Something went wrong! Please try again.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
     {
      try {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['status' => 'success']);
    } 
    catch (\Exception $e) {
        return response()->json(['status' => 'error']);
    }
  }
    
}
