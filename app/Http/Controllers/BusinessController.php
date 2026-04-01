<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('business.index');
    }
    public function data_all_business(Request $request)
    {
    $businesses = Business::all();

    return DataTables::of($businesses)
        ->addColumn('action', function ($business) {
           $editUrl = route('business-settings.edit', $business->id);
            return ' 
                <a href="' . $editUrl . '" 
                    class="btn btn-primary btn-sm editbusinessBtn">
                    <i class="fa fa-edit"></i>
                </a>
                &nbsp;
                <a href="javascript:void(0)" data-id="' . $business->id . '" 
                    class="btn btn-danger btn-sm deletebusinessBtn">
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
        return view('business.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'name'     => 'required',
       ]);
       try {
        $data = $request->all();
        if (empty($request->number)) {

        $lastBusiness = Business::orderBy('id', 'DESC')->first();

        if (!$lastBusiness || empty($lastBusiness->number)) {
            $nextNumber = 1;
        } else {
            $lastCode = $lastBusiness->number;
            $number = (int) filter_var($lastCode, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = $number + 1;
        }
        $generatedCode = "bus_" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    } else {
        $generatedCode = $request->number;   
    }
        $form_data = [
            'name'         => $data['name'],
            'number'       => $generatedCode,
            'phone'        => $data['phone'],
            'email'        => $data['email'],
            'website'      => $data['website'],
            'address'      => $data['address'],
            'city'         => $data['city'],
            'state'        => $data['state'],
            'country'      => $data['country'],
            'zip_code'     => $data['zip_code'],
            'gst_number'   => $data['gst_number'],
            'pan_number'   => $data['pan_number'],
             ];

        Business::create($form_data);

        return redirect()->route('business-settings.index')->with('success', 'New Business Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->route('business-settings.index')->with('error', 'Something went wrong! Please try again.');
    }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $business = Business::findOrFail($id);
    return view('business.edit')->with(compact('business'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'name'          => 'required',    
    ]);

    try {
        $business = Business::findOrFail($id);
        if (empty($request->number)) {
            $lastBusiness = Business::orderBy('id', 'DESC')->first();
            if (!$lastBusiness || empty($lastBusiness->number)) {
                $nextNumber = 1;
            } else {
                $lastCode = $lastBusiness->number;
                $number = (int) filter_var($lastCode, FILTER_SANITIZE_NUMBER_INT);
                $nextNumber = $number + 1;
            }
            $generatedCode = "bus_" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $generatedCode = $request->number;
        }
        $form_data = [
            'name'         => $request->name,
            'number'       => $generatedCode,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'website'      => $request->website,
            'address'      => $request->address,
            'city'         => $request->city,
            'state'        => $request->state,
            'country'      => $request->country,
            'zip_code'     => $request->zip_code,
            'gst_number'   => $request->gst_number,
            'pan_number'   => $request->pan_number,
        ];
        $business->update($form_data);
        return redirect()->route('business-settings.index')
                         ->with('success', 'Business Updated Successfully!');
    } catch (\Exception $e) {
        return redirect()->route('business-settings.index')
                         ->with('error', 'Something went wrong! Please try again.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
     {
      try {
        $business = Business::findOrFail($id);
        $business->delete();
        return response()->json(['status' => 'success']);
    } 
    catch (\Exception $e) {
        return response()->json(['status' => 'error']);
    }
  }
}
