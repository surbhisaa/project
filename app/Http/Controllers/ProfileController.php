<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
   
    public function profile()
    {
        $users['data'] = null;
        if(Auth::check()) {
        $users['data'] = DB::table('users')->first();
        }
        return view ('profile',$users);
    }

    public function store(Request $request,$id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'address' => 'required',
            'profile_image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
            'date_of_birth' => 'required',
            'profile_type'=> 'required|in:admin,user'
             ]);

             $role = ($request->profile_type == 'admin') ? 1 : 0;
             $user = User::find($id);
            // print_r($user);
            if($user) {
                $reImage = null;
            if($request->has('profile_image')){
                $image=$request->file('profile_image');
                $reImage=time().'.'.$image->getClientOriginalExtension();
                $dest=public_path('/imgs');
                $image->move($dest,$reImage);}
            
            $user->name = $request->input('name');
            $user->address = $request->input('address');
            $user->profile_image = $reImage;
            $user->date_of_birth = $request->input('date_of_birth');
            $user->profile_type = $role;
            $user->update();
        // return redirect()->back()->with('status','Data Updated Successfully');
        return response()->json([
            'status' => 200,
            'massage' => 'update successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'massage' => 'student not found',
                ]);
            }
    }

    
    }  
