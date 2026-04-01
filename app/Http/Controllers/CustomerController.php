<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
  {
    $request->validate([
        'name'     => 'required',
        'email'    => 'nullable|email',
        'mobile'   => 'required',
        'address'  => 'nullable',
    ]);

    try {

        Customer::create($request->all());
        return redirect()->back()->with('success', 'New Customer Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }
  }
public function data_all_customer(Request $request)
{
    $customers = Customer::select(['id', 'name', 'mobile', 'email', 'address']);

    return DataTables::of($customers)
      ->addColumn('action', function ($customer) {
                    return '
                        <a href="javascript:void(0)" data-id="'.$customer->id.'" 
                        class="btn btn-primary btn-sm editCustomerBtn">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;

                         <a href="javascript:void(0)" data-id="'.$customer->id.'" 
                            class="btn btn-danger btn-sm deleteCustomerBtn">
                            <i class="fa fa-trash"></i>
                        </a>
                    ';
                })

        ->rawColumns(['action'])
        ->make(true);
}



    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
     {
    $customer = Customer::findOrFail($id);
    return response()->json($customer);
   }


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'nullable|email',
        'mobile'   => 'required',
        'address'  => 'nullable',
    ]);

    try {

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json(['status' => 'success']);

    } catch (\Exception $e) {
        return response()->json(['status' => 'error']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    try {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['status' => 'success']);
    } 
    catch (\Exception $e) {
        return response()->json(['status' => 'error']);
    }
}

}
