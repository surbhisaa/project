<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePassController extends Controller
{
    public function changePass()
    {
        $data['js_files'] = array('assets/js/changepassword.js');
        
        return view('users.changePassword',$data);
    }

    public function updatePassword(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'old_password' => 'required|min:6|max:100',
                'new_password' => 'required|string|min:6|max:100',
                'confirm_password' => 'required|same:new_password'
            ]
        );

        if ($validate->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validate->errors()), true),
            ]);
        
        }else{

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return response()->json([
                'status' => 401,
                'errors' => 'your current password does not match with what you provided'
            ]);
           // return back()->with('error', 'your current password does not match with what you provided');
        }
        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            return response()->json([
                'errors' => 'your new password cannot be the same as old one'
            ]);

           // return back()->with('error', 'your new password cannot be the same as old one');
        }

        $hashedPassword = Hash::make($request->new_password);
        User::where('id', '=', Auth::user()->id)
            ->update([
                'password' => $hashedPassword
            ]);
        
            return response()->json([
                'status' => 200,
                'message' => 'Password changed successfully',
            ]);
        }
        //update users set password = 'abc' where id = 10;
        // $user->password = bycrypt($request->get('new_password'));
        // $user->save();
        // return back()->with('message','Password changed successfully');


        // $current_user= auth()->user();
        // if (Hash::check($request->old_password,$current_user->password)){
        //     $current_user->update([
        //         'password'=>bcrypt($request->new_password)
        //     ]);
        //     return redirect()->back()->with('success','Password successfully updated.');
        // }else{
        //     return redirect()->back()->with('error','Old message does not match.');
        // }

    }
}
