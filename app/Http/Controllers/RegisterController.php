<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
class RegisterController extends Controller
{
   public function dashboard()
    {
     return view('control.dashboard'); 
    
    }
  public function postLogin(Request $request): RedirectResponse
  {
    $request->validate([
        'email'    => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        Session::flash('successmessage', "Logged In Successfully");
        return redirect()->route('dashboard');
    }
     Session::flash('errormessage', "Oops! You have entered invalid credentials");
   return redirect()->route('login');
}
     public function adduser(): View
  {
    return view('auth.adduser');
  }
    public function userCreate(Request $request): RedirectResponse
  {
    $request->validate([
      'name'     => 'required',
      'email'    => 'required|email|unique:users',
      'password' => 'required|min:8',
    ]);

    $data  = $request->all();
    $check = $this->create($data);

    Session::flash('successmessage', "New User Added Successfully !");
    return redirect()->back();
  }
/**
   * Write code on Method
   *
   * @return response()
   */
  public function create(array $data)
  {
    return User::create([
      'name'             => $data['name'],
      'email'            => $data['email'],
      'password'         => Hash::make($data['password']),
      'is_active'        => $data['is_active'],
    ]);
  }
}
