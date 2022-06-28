<?php

namespace App\Http\Controllers;

use App\Models\AddtoCart;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function checkout()
    {
        $data['cartitem'] = AddtoCart::where('user_id', Auth::id())->get();
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();//because we are extending the main layout so we need to defined the this so thst cart value and wishvalue whould be shown
        $data['wishCount'] = WishList::where('user_id',Auth::id())->count();
        return view('users.checkout',$data);
    }
}
