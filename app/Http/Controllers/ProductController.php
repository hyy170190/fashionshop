<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;


use Session;

class ProductController extends Controller
{
    //
    public function index()
    {

        if (Gate::allows('isAdmin')) {
            $data = Product::getRecord();
            return view('product.index', ['products' => $data]);
        } 
        else {
            return abort('403');
        }
    }

    public function create(Request $request)
    {
        $data = product::getRecord();

        if (Gate::allows('isAdmin')) {
            if ($request->isMethod('POST')) {

                $request->validate([
                    'product_name' => 'required',
                    'type_name' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'quantity' => 'required|numeric',
                ]);

                Product::create($request->all());
                return view('product.index', ['products' => $data])->with('success', 'product created successfully.');
            }
            return view('product.create');
        } else {
            return abort('403');

        }
    }

    // public function buy(Request $request, $product_id)
    // {
    //     $data = Product::getRecord();
    //     $user = Auth::user();

    //     $product = Product::find($product_id);

    //     if (Gate::allows('isUser')) {
    //         if ($request->isMethod('POST')) {
    //             $request->validate([
    //                 'quantity' => 'required|numeric',
    //             ]);
    //             Transaction::create([
    //                 'user_id'=>$user->id,
    //                 'product_id'=>$product_id,
    //                 'quantity'=>$request('quantity'),
    //                 'total'=>($request('quantity') * $request('price')),
    //             ]);
    //             $product->update([
    //                 'quantity'=>($product('quantity') - $request('quantity')),
    //             ]);

    //             return view('product.index', ['products' => $data])->with('success', 'product bought successfully.');
    //         }
    //         return view('product.buy', [
    //             'product' => $product,
    //             'id' => $product->id,
    //         ]);
    //     } else {
    //         return abort('403');

    //     }
    // }

    public function update(Request $request, $product_id)
    {
        $data = Product::getRecord();

        $product = Product::find($product_id);

        if (Gate::allows('isAdmin')) {
            if ($request->isMethod('POST')) {

                $request->validate([
                    'product_name' => 'required',
                    'type_name' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'quantity' => 'required|numeric',
                ]);
                $product->update($request->all());
                return view('product.index', ['products' => $data])->with('success', 'product created successfully.');
            }
            return view('product.update', [
                'product' => $product,
                'id' => $product->id,
            ]);
        } else {
            return abort('403');

        }
    }

    public function delete($product_id)
    {
        $data = Product::getRecord();
        $product = Product::find($product_id);

        if (Gate::allows('isAdmin')) {

            $product->delete();

            return view('product.index', [
                'products' => $data,
            ])->with('success', 'product delete successfully.');
        } else {
            return abort('403');

        }
    }
}
