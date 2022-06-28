<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishList;
use App\Models\AddtoCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function viewWish()
    {
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();
        $data['wishCount'] = WishList::where('user_id',Auth::id())->count();
        $data['wishItems'] = WishList::where('user_id',Auth::id())->get();
        //echo '<pre>';print_r($data['wishItems']);
        return view('users.wishList',$data);
    }
    public function addtoWish(Request $request)
    {
        $wishList_id= $request->input('WishList_id');

        if(Auth::check())
        {
            $prod_check = Product::where('id',$wishList_id)->first();
            if(!empty($prod_check))
            {
                if(WishList::where('prod_id',$wishList_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json([
                        'status'=>$prod_check->title."Allready Added to the WishLish"
                    ]);
                }
                $wishItem = new WishList();
                $wishItem->prod_id = $wishList_id;
                $wishItem->user_id = Auth::id();
                $wishItem->save();
                $wishCount = WishList::where('user_id', Auth::id())->count();
                if (request()->session()->has('count',$wishCount)) {
                    request()->session()->forget('count');
                }
                //get cart count and set
                request()->session()->put('count', $wishCount);
                $session = session()->all();
                //dd($session);
                return response()->json([
                    'status'=>$prod_check->title."Added to WishList"]);


            }
        }
        else{
            return response()->json([
                'status' =>"Login to continue"
            ]);
        }

    }
    public function deleteWishList(Request $request)
    {
        {
            if(Auth::check())
            {
                $product_id = $request->input('product_id');
                if(WishList::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $cartItem = WishList::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                    $cartItem->delete();
                    return response()->json(['status'=>"product deleted successfully"]);
                }
            }
            else
            {
                return response()->json(['status'=>"Login to Continue"]);

            }
        }

    }
    public function wishCount()
    {
        $wishCount = WishList::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishCount]);
    }
}
