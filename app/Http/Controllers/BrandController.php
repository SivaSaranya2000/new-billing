<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('brands.index');
    }
    public function data_all_brands(Request $request)
    {
    $brands = Brand::select([
        'id', 'brand', 'brand_code', 'description'
    ]);

    return DataTables::of($brands)
        ->addColumn('action', function ($brand) {
           $editUrl = route('brands.edit', $brand->id);
            return '
                <a href="javascript:void(0)" data-id="'.$brand->id.'" 
                        class="btn btn-primary btn-sm editBrandBtn">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                
                <a href="javascript:void(0)" data-id="'.$brand->id.'" 
                    class="btn btn-danger btn-sm deleteBrandBtn">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'brand'     => 'required',
        'brand_code' => 'unique:brands,brand_code',
        'description' => 'nullable',
       ]);
       try {
        $data = $request->all();
        $form_data = [
            'brand' => $data['brand'],
            'brand_code' => $data['brand_code'],
            'description'   => $data['description'],
             ];

        Brand::create($form_data);
        
        return redirect()->route('brands.index')->with('success', 'New Brand Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->route('brands.index')->with('error', 'Something went wrong! Please try again.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
   {
    $request->validate([
        'brand'     => 'required',
        'description'    => 'nullable',
    ]);

    try {
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

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
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['status' => 'success']);
     } 
     catch (\Exception $e) {
        return response()->json(['status' => 'error']);
     }
  
    }
}
