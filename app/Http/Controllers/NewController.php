<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\AddtoCart;
use App\Models\data;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewController extends Controller
{
    public function new()
    {
        $data['data'] = DB::table('templates')->where('type','about_us')->first();
        $data['imgs'] = DB::table('templates')->where('type','expertises')->get();
        $data['prods'] = DB::table('templates')->where('type','our_product')->get();
        $data['test'] = DB::table('templates')->where('type','testmonials')->get();
        $data['blogs'] = DB::table('templates')->where('type','our_blog')->get();
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();
        $data['wishCount'] = WishList::where('user_id',Auth::id())->count();
       // $imgs['imgs'] = DB::table('templates')
       // ->where image_name('')
        return view('template', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required|alpha_num|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validator->errors()), true),
            ]);
        } else {
            $data = new data;
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->message = $request->input('message');

            if (Auth::check()) {
                $data->user_id = Auth::user()->id;
            }

            $mail = $data->update();
            if ($mail) {
                Mail::to('surbhisaxena70@gmail.com')->send(new SendMail($data));
            }

            return response()->json([
                'status' => 200,
                'message' => 'Added successfully'
            ]);
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}
