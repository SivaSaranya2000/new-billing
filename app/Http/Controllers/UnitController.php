<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('units.index');
    }

     public function data_all_units(Request $request)
{
    $units = Unit::select([
        'id', 'unit', 'description'
    ]);

    return DataTables::of($units)
        ->addColumn('action', function ($unit) {
           $editUrl = route('units.edit', $unit->id);
            return '
                <a href="javascript:void(0)" data-id="'.$unit->id.'" 
                        class="btn btn-primary btn-sm editUnitBtn">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                
                <a href="javascript:void(0)" data-id="'.$unit->id.'" 
                    class="btn btn-danger btn-sm deleteUnitBtn">
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
        'unit'     => 'required',
        'description' => 'nullable',
       ]);
    try {
        $data = $request->all();
        $form_data = [
            'unit' => $data['unit'],
            'description'   => $data['description'],
             ];

        Unit::create($form_data);

        return redirect()->route('units.index')->with('success', 'New Unit Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->route('units.index')->with('error', 'Something went wrong! Please try again.');
    }
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
     {
        $unit = Unit::findOrFail($id);
        return response()->json($unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
   {
    $request->validate([
        'unit'     => 'required',
        'description'    => 'nullable',
    ]);

    try {

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());

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
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json(['status' => 'success']);
     } 
     catch (\Exception $e) {
        return response()->json(['status' => 'error']);
     }
  
    }
}
