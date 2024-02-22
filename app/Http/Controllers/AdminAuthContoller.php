<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthContoller extends Controller
{
    public function index() {
        return view('admin.auth.login');
    }

    public function login(Request $request) {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::guard('admin')->user()->roles == 0){
                return redirect('dashboard');
            }
            elseif(Auth::guard('admin')->user()->roles == 1){
                return redirect('dashboard/staff');
            }
            elseif(Auth::guard('admin')->user()->roles == 2){
                return redirect('dashboard/finance');
            }
            elseif(Auth::guard('admin')->user()->roles == 3){
                return redirect('dashboard/underwriting');
            }
        };

        return back()->withErrors([
            'email' => 'The provided credentials do not match our record',
        ])->onlyInput('email');        
        
    }

    public function logout_id(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dashboard/admin');
    }
}
