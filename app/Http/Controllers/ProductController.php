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
        $data = Product::getRecord();

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
