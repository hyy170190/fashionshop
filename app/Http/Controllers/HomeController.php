<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //redirect
    public function redirect()
    {
        $userRole = Auth::user()->role;

        if ($userRole === 'admin')
        {
            $totalProducts = Product::all()->count();
            $totalOrders = Order::all()->count();
            $totalCustomers = User::where('role','user')->count();

            $orders = Order::all();
            $totalRevenue = 0;

            foreach ($orders as $order)
            {
                $totalRevenue += $order->total_price;
            }

            $orderDelievered = Order::where('deliever',1)->count();
            $orderProcess = Order::where('deliever',0)->count();

            return view('admin.home',compact('totalProducts','totalOrders','totalCustomers','totalRevenue','orderDelievered','orderProcess'));
        }
        else
        {

            $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

            $totalPrice = 0;
            foreach ($cart as $c)
            {
                $totalPrice += $c->quantity * $c->products[0]->price;
            }

            list($newArrivals,$bestSellers,$hotSales) = $this->getProducts();

            return view('user.home',compact('cart','totalPrice','newArrivals','bestSellers','hotSales'));


        }
    }

    //user home page
    public function userHome()
    {
        if (Auth::user() != null)
        {
            $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

            $totalPrice = 0;
            foreach ($cart as $c)
            {
                $totalPrice += $c->quantity * $c->products[0]->price;
            }

            list($newArrivals,$bestSellers,$hotSales) = $this->getProducts();
            // dd($hotSales->toArray());

            return view('user.home',compact('cart','totalPrice','newArrivals','bestSellers','hotSales'));
        }
        else
        {
            if (Product::exists()) {

                list($newArrivals,$bestSellers,$hotSales) = $this->getProducts();

                return view('user.home',compact('newArrivals','bestSellers','hotSales'));

            } else {

                return redirect()->route('login');

            }
        }

    }

    //warning to login
    public function warning ()
    {
        return back()->with(['msg' => 'You need to login first!']);
    }

    //404 page
    public function page404 ()
    {
        return view('error404');
    }

    //get products for home page
    private function getProducts ()
    {
        $newArrivals = Product::orderBy('created_at','desc')->take(4)->get();
        $bestSellers = Product::orderBy('order_count','desc')->take(8)->get();

        $rawProducts = OrderList::with('products')->orderBy('created_at','desc')->get();
        // dd($rawProducts->toArray());
        $id = array();
        $hotSales = collect([]);
        foreach ($rawProducts as $item)
        {
            if (count($id) < 4)
            {
                if (!in_array($item->product_id, $id))
                {
                    $hotSales->push($item);
                    array_push($id,$item->product_id);
                }
            }
        }

        return [$newArrivals, $bestSellers, $hotSales];
    }
}
