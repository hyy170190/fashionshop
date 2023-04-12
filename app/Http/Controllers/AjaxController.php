<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //get product lists
    public function productList (Request $request)
    {
        if($request->status == 'lowTohigh'){
            $data = Product::orderBy('price','asc')->get();
        }else if ($request->status == 'highTolow')
        {
            $data = Product::orderBy('price','desc')->get();
        }
        logger($data);
        return response()->json($data, 200);
    }

    //add to cart
    public function addToCart (Request $request)
    {

        if (!Auth::check())
        {
            return response()->json(['msg' => 'unlogin'],401);
        }
        else
        {
            $this->checkAndAddCart($request);

            return response()->json([
                'status' => 'success'
            ], 200);
        }

    }

    //remove product from cart and delete product in cart from database
    public function removeFromCart (Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)
            ->delete();
    }

    //remove products from wishlist
    public function addToCartnRemove (Request $request)
    {

        $this->checkAndAddCart($request);

        Wishlist::where('user_id',$request->userId)
                ->where('product_id', $request->productId)
                ->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    //delete wishlist
    public function deleteWishlist (Request $request)
    {
        Wishlist::where('id', $request->id)->delete();

        return response()->json(['msg' => 'success'], 200);
    }

    //go to shop page
    public function shopPage ()
    {
        if (Auth::check())
        {
            return response()->json(['msg' => 'login'], 200);
        }
        else
        {
            return response()->json(['msg' => 'unlogin'], 401);
        }
    }

    //check the product and add to cart
    private function checkAndAddCart ($request)
    {
        if (Cart::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->exists())
        {
            //oldcount + new count not to show twice product in ui
            $updateQty = Cart::select('quantity')
                            ->where('user_id',Auth::user()->id)
                            ->where('product_id',$request->productId)
                            ->first()->quantity + $request->count;
            $data = [
                'quantity' => $updateQty
            ];

            Cart::select('quantity')->where('user_id',Auth::user()->id)
                    ->where('product_id',$request->productId)
                    ->update($data);
        }
        else
        {
            $data = [
                'user_id' => Auth::user()->id,
                'product_id' => $request->productId,
                'quantity' => $request->count
            ];

            Cart::create($data);
        }
    }

    //cart to checkout order page
    public function checkoutPage (Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value)
        {
            $updateQty = [
                'quantity' => $value['quantity']
            ];

            Cart::select('quantity')->where('user_id',Auth::user()->id)
                    ->where('product_id',$value['product_id'])
                    ->update($updateQty);

        }

    }
}
