<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('back.auth.login');
    }
    public function loginPost(Request $request){
        
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            toastr()->success('Welcome Back!\n'.Auth::user()->email);
            return redirect()->route('admin.dashboard');
        }
        else
            return redirect()->route('admin.login')->withErrors('Check your email or password!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
