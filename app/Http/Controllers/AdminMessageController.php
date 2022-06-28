<?php

namespace App\Http\Controllers;

use App\Mail\AdminMess;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminMessageController extends Controller
{
    public function adminMess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:0',
            'reply' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validator->errors()), true),
            ]);
        } else {
            $data = Data::find($request->id);
            $data->reply = $request->input('reply');

            $mail = $data->save();
            if ($mail) {
                Mail::to('surbhisaxena70@gmail.com')->send(new AdminMess($data));
            }

            return response()->json([
                'status' => 200,
                'message' => 'Added successfully'
            ]);
        }
    }
}
