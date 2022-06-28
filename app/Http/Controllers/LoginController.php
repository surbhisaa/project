<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $validated = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'profile_type' => 1
        ]);
        // dd($validated);
        if ($validated) {
            return redirect()->route('AdminLogin')->with('success', 'login successfully');
        } else {
            $validated = auth()->attempt([
                'email' => $request->email,
                'password' => $request->password,
        
            ]);

            if ($validated) {
                //redirect to user dashboard
                return redirect()->route('dashboard')->with('success','login as a user');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }
    }
}