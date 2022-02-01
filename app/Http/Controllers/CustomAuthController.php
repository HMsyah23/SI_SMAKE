<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Crypt;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
    
    public function portal()
    {
        $user = Crypt::decrypt($_GET['id']);
        if (Auth::loginUsingId($user,true)) {
            Session::put('navbarState', True);
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->with(['error' => 'Email Atau Password Tidak Cocok']);
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::put('navbarState', True);
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->with(['error' => 'Email Atau Password Tidak Cocok']);
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("admin/dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            if (Auth::user()->role->id == '71e61563-591c-4800-8485-ae51f509bdf9') {
                return view('admin.index');
            } else if (Auth::user()->role->id == '219dd050-96b9-47bb-9727-b6cf6a84fac8') {
                return view('admin.ketuaUPTD');
            } else if (Auth::user()->role->id == '73e819e5-0a2f-4493-9b4f-61bb02c5c03c') {
                return view('admin.ketuaTU');
            } else {
                return view('admin.user');
            }
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}