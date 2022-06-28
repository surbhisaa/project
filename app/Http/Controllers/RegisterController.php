<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
    $this->validate(request(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'terms' => 'required'
         ]);
     $data = User::create([
         'name'=>$request['name'],
         'email'=>$request['email'],
         'password'=>Hash::make($request['password'])
        ]);
        auth()->login($data);

        Mail::to($request['email'])->send(new WelcomeMail($data));
      
        return redirect('/');
    
    }
    

    
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:191',
    //         'email' => 'required|string|email|email:rfc,dns0|max:191',
    //         'password' => 'required|max:191',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 400,
    //             'errors' => json_decode(json_encode($validator->errors()), true),
    //         ]);
    //     } else {
    //         $user = new User;
    //         $user->name = $request->input('name');
    //         $user->email = $request->input('email');
    //         $user->password = $request->input('password');
    //         $mail = $user->save();
    //         if ($mail) {
    //             Mail::to('surbhisaxena70@gmail.com')->send(new SendMail($data));
    //         }
    //         'password' => Hash::make($data['password']),

    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Added successfully'
    //         ]);
    //     }
    // }
}
