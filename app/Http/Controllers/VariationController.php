<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Models\VariationValue;
class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('variation.index');
    }

    public function data_all_variations(Request $request)
   {
    $variations = Variation::select([
        'id', 'name'
    ]);

    return DataTables::of($variations)
           ->addColumn('value', function ($variation) {
            return $variation->values->pluck('value')->join(', ');
           })
          ->addColumn('action', function ($variation) {
                 return '
                <a href="javascript:void(0)" data-id="'.$variation->id.'" 
                        class="btn btn-primary btn-sm editVariationBtn">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;
                <a href="javascript:void(0)" data-id="'.$variation->id.'" 
                    class="btn btn-danger btn-sm deleteVariationBtn">
                    <i class="fa fa-trash"></i>
                </a>
            ';
        })
        ->rawColumns(['value', 'action'])
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
        'name'     => 'required',
        'value'    => 'required|array|min:1',
     ]);

    try {
        $variation = Variation::create([
         'name' => $request->name
      ]);

      foreach ($request->value as $val) {
       $variation->values()->create([
        'value' => $val
        ]);
     }

        return redirect()->route('variations.index')->with('successmessage', 'New Variation Added Successfully!');
     } 
    catch (\Exception $e) {
        return redirect()->route('variations.index')->with('errormessage', 'Something went wrong! Please try again.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $variation = Variation::with('values')->findOrFail($id);
    return response()->json($variation);
   }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
  {
    $request->validate([
        'name'  => 'required|string|max:255',
        'value' => 'required|array|min:1',
        'value.*' => 'required|string|max:255'
    ]);
    try { 
        $variation = Variation::findOrFail($id);
        // Update variation name
        $variation->update([
            'name' => $request->name
        ]);
        // Clear old values
        $variation->values()->delete();
        // Insert new values
        foreach ($request->value as $val) {
            $variation->values()->create([
                'value' => $val
            ]);
        }
        return redirect()
            ->route('variations.index')
            ->with('successmessage', 'Variation updated successfully!');
      } 
        catch (\Exception $e) {
        return redirect()
            ->route('variations.index')
            ->with('errormessage', 'Something went wrong! Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    try {
        $variation = Variation::findOrFail($id);
        $variation->delete();

       return response()->json(['status' => 'success']);
     } catch (\Exception $e) {

        return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);
    }
   }
   public function getValues($id)
{
    $values = VariationValue::where('variation_id', $id)->get();

    return response()->json([
        'values' => $values
    ]);
}

}
