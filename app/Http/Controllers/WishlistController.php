<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    //add product to wish list
    public function addToWishlistAjax (Request $request)
    {
        if (!Auth::check())
        {
            return response()->json(['msg' => 'unlogin'],401);
        }
        else
        {
            if (Wishlist::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->exists())
            {
                return response()->json(['error' => 'already'], 422);
            }
            else
            {
                $data = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->product_id
                ];

                Wishlist::create($data);

                return response()->json(['msg' => 'success'], 200);
            }
        }
    }

    //view user wishlist page
    public function wishlist($userId)
    {
        $cart = Cart::where('user_id', $userId)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        $products = Wishlist::where('user_id',$userId)->with('products')->paginate(4);

        return view('user.product.wishlist', compact('products','cart','totalPrice'));
    }

    //add all wish items to cart
    public function addAllToCart ()
    {


        $lists = Wishlist::where('user_id', Auth::user()->id)->get();
        // dd($lists->toArray());

        foreach ($lists as $list) {

            $this->checkAndAddCart($list);

            Wishlist::where('user_id', Auth::user()->id)
                    ->where('product_id', $list->product_id)
                    ->delete();
        }

        return redirect()->route('home');
    }

    private function checkAndAddCart ($list)
    {
        if (Cart::where('user_id',Auth::user()->id)->where('product_id',$list->product_id)->exists())
            {
                //oldcount + new count not to show twice product in ui
                $updateQty = Cart::select('quantity')
                                ->where('user_id',Auth::user()->id)
                                ->where('product_id',$list->product_id)
                                ->first()->quantity + 1;
                $data = [
                    'quantity' => $updateQty
                ];

                Cart::select('quantity')->where('user_id',Auth::user()->id)
                        ->where('product_id',$list->product_id)
                        ->update($data);
            }
            else
            {
                $items = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $list->product_id,
                    'quantity' => 1
                ];

                Cart::create($items);
            }
    }
}
