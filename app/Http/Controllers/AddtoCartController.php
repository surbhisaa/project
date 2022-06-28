<?php

namespace App\Http\Controllers;

use App\Models\AddtoCart;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AddtoCartController extends Controller
{
    public function viewCart()
    {
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();
        $data['wishCount'] = WishList::where('user_id',Auth::id())->count();
        $data['counts'] = DB::table('addtocarts')->get();
        $data['cartItems'] = AddtoCart::where('user_id', Auth::id())->get();
        //echo '<pre>';print_r($data['cartItems']);
        return view('users.viewCart', $data);
    }
    public function addtoCart(Request $request)
    {
        $product_id = $request->input('product_id');

        if (Auth::check()) {
            $prod_check = Product::where('id', $product_id)->first();
            if (!empty($prod_check)) {
                if (AddtoCart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json([
                        'status' => $prod_check->title . "Allready Added to the Cart"
                    ]);
                }

                $cartItem = new AddtoCart();
                $cartItem->prod_id = $product_id;
                $cartItem->user_id = Auth::id();
               // $cartCount = AddtoCart::where('user_id', Auth::id())->count();
               // $cartItem-> count = $cartCount;
                $cartItem->save();

            
               $cartCount = AddtoCart::where('user_id', Auth::id())->count();
               Session::put('count', $cartCount);
               $session = session()->all();
                dd($session);
                return response()->json([
                    'status' => $prod_check->title . "Added to Cart"
                ]);
            }
        } else {
            return response()->json([
                'status' => "Login to continue"
            ]);
        }
    }
    public function deleteCart(Request $request)
    { {
            if (Auth::check()) {
                $product_id = $request->input('product_id');
                if (AddtoCart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    $cartItem = AddtoCart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                    $cartItem->delete();
                    return response()->json(['status' => "product deleted successfully"]);
                }
            } else {
                return response()->json(['status' => "Login to Continue"]);
            }
        }
    }
    public function cartCount(Request $request)
    {
        $cartCount = AddtoCart::where('user_id', Auth::id())->count();
        //$cartCount = AddtoCart::where('user_id','count');
        //Session::put('count',$cartCount);
        //$session = session()->all();
        //dd($session);
        return response()->json(['count' => $cartCount]);
    }
}
