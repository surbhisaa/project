<?php

namespace App\Http\Controllers;

use App\Models\AddtoCart;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductContoller extends Controller
{
    public function product()
    {
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();
        return view('admin.addProduct',$data);
    }
    
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'prod_image' => 'required',
            'product_details' => 'required',
            'product_price' => 'required|numeric|min:2',
            'quantity' => 'required|numeric|min:2|max:10000000',
            'exp_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => json_decode(json_encode($validator->errors()), true),
            ]);
        } else {
            $save = new Product();
                $reImage = null;
            if($request->has('prod_image')){
                $image=$request->file('prod_image');
                $reImage=time().'.'.$image->getClientOriginalExtension();

                $image_resize=Image::make($image->getRealPath());
                $image_resize->resize(300,300);
            
                $dest=public_path('/imgs');
                $image->move($dest,$reImage);}

       // echo $request->input('editor');//editor is the name of text area
            $save->title = $request->input('title');
            $save->img_product = $reImage;
            $save->prod_details = $request->input('product_details');
            $save->price = $request->input('product_price');
            $save->quantity = $request->input('quantity');
            $save->exp_date = $request->input('exp_date');
            $save->save();
            return response()->json([
                'status' => 200,
                'message' => 'Added successfully'
            ]);
        }
    }
    public function viewProduct()
    {
        $data['cartcount'] = AddtoCart::where('user_id', Auth::id())->count();
        $data['wishCount'] = WishList::where('user_id',Auth::id())->count();
        $data['prods'] = DB::table('products')->where('status', '=', 'stockIn')->get();
        return view ('users.viewProduct',$data);
    }
    public function productList()
    {
        return view ('admin.productList');
    }

    public function editList($id)
    {
        $user = Product::find($id);
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
            'title' => 'required',
            'prod_image' => 'required',
            'product_details' => 'required',
            'product_price' => 'required',
            'quantity' => 'required',
            'exp_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = Product::find($id);
            if ($user) {

                    $reImage = null;
                if($request->has('prod_image')){
                    $image=$request->file('prod_image');
                    $reImage=time().'.'.$image->getClientOriginalExtension();
                    $dest=public_path('/imgs');
                    $image->move($dest,$reImage);}

            $user->title = $request->input('title');
            $user->img_product = $reImage;
            $user->prod_details = $request->input('product_details');
            $user->price = $request->input('product_price');
            $user->quantity = $request->input('quantity');
            $user->exp_date = $request->input('exp_date');
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'update successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'product not found',
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
    
        $product = Product::findOrFail($request->id);
        $product->delete();
       //$user = Product::find($request->id)->update(['status' => 'delete']);
        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully',
        ]);
    }
    public function changeStatus(Request $request)
    {
        $user = Product::find($request->id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json([
            'status' => 200,
            'success'=>'Status change successfully.'
        ]);
    }
    
}

