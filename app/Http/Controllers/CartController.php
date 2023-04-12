<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //show cart list page
    public function cartList()
    {
        $cart = Cart::where('user_id',Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.product.cart', compact('cart','totalPrice'));
    }

    //clear all products from cart
    public function cartClear ()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
        return back();
    }
}
