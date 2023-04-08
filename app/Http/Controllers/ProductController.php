<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all the products
        $products = Product::query();

        // search function
        if ($request->has('search')) {
            $search = $request->input('search');
            $products->where('name', 'LIKE', "%$search%");
        }

        // Filtering by category
        if ($request->has('category')) {
            $category = $request->input('category');
            $products->where('category', $category);
        }

        // Filtering by price
        if ($request->has('price_min')) {
            $price_min = $request->input('price_min');
            $products->where('price', '>=', $price_min);
        }

        if ($request->has('price_max')) {
            $price_max = $request->input('price_max');
            $products->where('price', '<=', $price_max);
        }

        // Filtering by size
        if ($request->has('size')) {
            $size_S = $request->input('size');
            $products->where('size', $size);
        }

        // Sorting
        switch ($request->input('sort')) {
            case 'name_asc':
                $products->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $products->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;
            default:
                // Sorting by desc order
                $products->orderBy('id', 'desc');
                break;
    }


        // Get the products based on the selected filters
        $products = $products->get();

        return view('products.index', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('products.view', ['product' => $product]);
    }
}