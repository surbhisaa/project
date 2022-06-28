<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getLogin()
    { 
        $users['data'] = null;
        if(Auth::check()) {
        $users['data'] = DB::table('users')->first();
        }
        return view('admin.userList');
    } 

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'password' => 'required|max:191',
            'email' => 'required|email|unique:users|max:191',
            'address' => 'required|max:191',
            'date' => 'required|max:191',
            'profile_image' => 'required|mimes:jpg,jpeg,png,bmp,tiff'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validator->errors()), true),
            ]);
        } else {
            $user = new User;
                $reImage = null;
            if($request->has('profile_image')){
                $image=$request->file('profile_image');
                $reImage=time().'.'.$image->getClientOriginalExtension();
                $dest=public_path('/imgs');
                $image->move($dest,$reImage);}
            
            $user->name = $request->input('name');
            $user->password = $request->input('password');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->date_of_birth = $request->input('date');
            $user->profile_image = $reImage;
            $user['profile_type'] = 0;
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Added successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'user not found',
            ]);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'address' => 'required|max:191',
            'date' => 'required|max:191'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = User::find($id);
            if ($user) {

                    $reImage = null;
                if($request->has('profile_image')){
                    $image=$request->file('profile_image');
                    $reImage=time().'.'.$image->getClientOriginalExtension();
                    $dest=public_path('/imgs');
                    $image->move($dest,$reImage);}

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->address = $request->input('address');
                $user->date_of_birth = $request->input('date');
                $user->profile_image = $reImage;
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'update successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'user not found',
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
       // $student = Student::findOrFail($id);
       // $student->delete();
       $user = User::find($request->id)->update(['status' => 'delete']);
        return response()->json([
            'status' => 200,
            'message' => 'Status changed successfully',
        ]);
    }
    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json([
            'status' => 200,
            'success'=>'Status change successfully.'
        ]);
    }

    

    
    // public function adminLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);
    //     $validated = auth()->attempt([
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'is_admin' => 1
    //     ]);
    //     // dd($validated);
    //     if ($validated) {
    //         return redirect()->route('dashboard')->with('success', 'login successfully');
    //     } else {
    //         $validated = auth()->attempt([
    //             'email' => $request->email,
    //             'password' => $request->password,
    //             // 'is_admin'=>1
    //         ]);

    //         if ($validated) {
    //             //redirect to user dashboard
    //             return redirect()->route('dashboard')->with('success','login as a user');
    //         } else {
    //             return redirect()->back()->with('error', 'Invalid credentials');
    //         }
    //     }
    // }
}
