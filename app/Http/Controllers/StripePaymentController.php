<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session;

class StripePaymentController extends Controller
{
    //view payment page
    public function paymentPage ($price)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.order.payment',compact('cart','price','totalPrice'));
    }

    //stripe post method
    public function stripePost (Request $request, $price)
    {
        $price = (int)$price;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge:: create([
            'amount' => $price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Test payment for fashion shop'
        ]);

        Session::flash('success','Payment has been successfully.');
        return back();
    }
}
