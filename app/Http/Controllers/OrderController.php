<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use App\Rules\PasswordSame;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\BillingDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //order checkout page
    public function checkoutPage ()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }


        return view('user.product.checkout',compact('cart','totalPrice'));
    }

    //billing details
    public function order (Request $request)
    {

        $validator = $this->dataValidationCheck($request);

        $orderCode = $this->generateBarcodeNumber();

        $data = $this->getOrderData($request, $orderCode);


        BillingDetails::create($data);

        $total = 0;
        foreach($request->order_list as $item)
        {
            $item = Arr::add($item, 'order_code', $orderCode);
            OrderList::create($item);
            Product::where('id',$item['product_id'])->increment('order_count',1);
            $total += $item['total'];
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        $test = Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $orderCode,
            'total_price' => $total
        ]);

        return response()->json(['status' => 'success'], 200);

    }

    //admin ui order lists page
    public function list ()
    {
        $orders = Order::with('user','billingDetails')->orderBy('created_at','desc')->paginate(5);
        // dd($orders->toArray());
        return view('admin.order.list',compact('orders'));
    }

    //ajax order status change
    public function changeStatus (Request $request)
    {
        Order::where('id',$request->orderId)
            ->select('status')
            ->update([
                'status' => $request->status
            ]);

        return response()->json(['msg' => 'success'], 200);
    }

    //client order billing details page
    public function billingDetails ($id)
    {
        if ($id == 'null')
        {
            $details = BillingDetails::with('order')
                    ->when(request('key'), function($query){
                        $query->orWhere('order_code','like','%'.request('key').'%')
                            ->orWhere('order_code','like','%'.request('key').'%')
                            ->orWhere('first_name','like','%'.request('key').'%')
                            ->orWhere('last_name','like','%'.request('key').'%')
                            ->orWhere('email','like','%'.request('key').'%')
                            ->orWhere('city','like','%'.request('key').'%')
                            ->orWhere('state','like','%'.request('key').'%')
                            ->orWhere('country','like','%'.request('key').'%');
                    })
                    ->paginate(8);
            $details->appends(request()->all());
        }
        else
        {
            $details = BillingDetails::with('order')
                    ->where('order_code','like','%'.$id.'%')
                    ->paginate(8);
        }

        return view('admin.order.details',compact('details','id'));


    }

    //user ui order list page
    public function orderListPage ()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        $orders = Order::where('user_id', Auth::user()->id)->with('billingDetails')->paginate(5);

        return view('user.order.list', compact('cart','totalPrice','orders'));
    }

    //user cancel order
    public function orderCancel (Request $request)
    {
        Order::where('order_code', $request->order_code)->delete();
        OrderList::where('order_code', $request->order_code)->delete();
        BillingDetails::where('order_code', $request->order_code)->delete();

        return response()->json(['msg' => 'success'], 200);
    }

    //user order details products show page
    public function orderDetailsPage ($code)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        $orders = OrderList::where('order_code', $code)->with('products')->get();

        return view('user.order.details',compact('orders','cart','totalPrice','code'));
    }

    //order deliever status change
    public function delieverStatus (Request $request)
    {
        Order::where('id',$request->orderId)->update(['deliever' => $request->status]);
        return response()->json(['msg' => 'success'], 200);
    }

    //create unique id for orderId
    private function generateBarcodeNumber() {
        $number = mt_rand(100000000, 999999999);

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    private function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Order::where('order_code',$number)->exists();
    }

    //data from billing details validation check
    private function dataValidationCheck ($request)
    {
        $validationRules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => ['required', new PasswordSame],
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }

    //get order data to put in database
    private function getOrderData ($request, $orderCode)
    {
        return [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'phone' => $request->phone,
            'email' => $request->email,
            'notes' => $request->notes,
            'order_code' => $orderCode
        ];
    }
}
