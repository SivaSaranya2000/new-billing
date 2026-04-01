<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\View\View;
use App\Models\User;

class LoginController extends Controller
{
    public function index(): View
   {
    return view('auth.login');
   }
   public function data_all_user(Request $request)
    {
       if ($request->ajax()) {
        $users = User::select(['id', 'name', 'email']);

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
         return '
         <a href="" data-id="' . $user->id . '" class=" btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edi!"><i class="fa fa-edit"></i></a>&nbsp;
          <a href="' . route('user.delete', $user->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Are you sure?\')">
            <i class="fa fa-trash"></i>
        </a>
        ';
    })
            ->rawColumns(['action'])
            ->make(true);
    }
       
    }
    public function destroy($id)
    {
    $data = User::destroy($id);
    
    Session::flash('successmessage', "User Deleted Successfully");
    return redirect()->back();
    }
   }
