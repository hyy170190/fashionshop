<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list page
    public function list ()
    {
        $products = Product::with('category')
                        ->when(request('key'), function($query){
                            $query->where('products.name','like','%'.request('key').'%');
                        })
                        ->orderBy('products.created_at','desc')
                        ->paginate(5);
        return view('admin.product.list', compact('products'));
    }

    //create page
    public function createPage ()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //create product
    public function create (Request $request)
    {
        $this->productValidationCheck($request,'create');
        $data = $this->getProductInfo($request);

        $imageName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/product_img', $imageName);
        $data['image'] = $imageName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //view edit poge
    public function editPage ($id)
    {
        $data = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.edit', compact('data','categories'));
    }

    //update edited data of product
    public function edit (Request $request)
    {
        $this->productValidationCheck($request,'update');
        $data = $this->getProductInfo($request);

        if ($request->hasFile('image'))
        {
            $oldImg = Product::where('id',$request->id)->first()->image;
            Storage::delete('public/product_img/' . $oldImg);

            $newImg = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/product_img', $imageName);
            $data['image'] = $newImg;
        }

        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#list');
    }

    //delete product
    public function delete ($id)
    {
        $image = Product::where('id',$id)->first()->image;

        Product::where('id',$id)->delete();
        Storage::delete('public/product_img/' . $oldImg);

        return redirect()->route('product#list');
    }

    //filter products by category
    public function filterByCategory ($categoryId)
    {
        $products = Product::where('category_id',$categoryId)->orderBy('products.price', 'asc')->paginate(12);
        $categories = Category::with('products')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.shop', compact('products', 'categories','cart','totalPrice'));
    }

    //filter products by price
    public function filterByPrice ($p1,$p2)
    {
        $p1 = (int)$p1;
        $p2 = (int)$p2;

        $products = Product::whereBetween('price', [$p1, $p2])->orderBy('products.price', 'asc')->paginate(12);
        $categories = Category::with('products')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.shop', compact('products', 'categories','cart','totalPrice'));
    }

    //filter product by size
    public function filterBySize ($para)
    {
        $products = Product::where('size',$para)->orderBy('products.price', 'asc')->paginate(12);
        $categories = Category::with('products')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.shop', compact('products', 'categories','cart','totalPrice'));
    }

    //sorting products by price
    public function sortingByPrice ($para)
    {
        $products = Product::orderBy('price', $para)->orderBy('products.price', 'asc')->paginate(12);
        $categories = Category::with('products')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.shop', compact('products', 'categories','cart','totalPrice','para'));
    }

    //view product details
    public function details ($id)
    {
        $product = Product::where('id',$id)->first();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        $relatedProducts = Product::where('category_id',$product->category_id)
                                ->whereNot('id',$id)
                                ->get();

        $reviews = Review::where('product_id',$id)->with('user')->paginate(3);

        return view('user.product.details', compact('product','relatedProducts','cart','totalPrice','reviews'));
    }

    //product review by user
    public function review (Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'review' => $request->review
        ];

        Review::create($data);

        return back();
    }

    //admin UI user reviews lists
    public function userReviewLists ()
    {
        $reviews = Review::query()->with('user', 'product');

        if (!empty(request('key'))){
            $key = request('key');

            $reviews = $reviews->orWhereHas('user', function($query) use ($key) {
                                    $query->where('name','like','%'.$key.'%');
                                })->orWhereHas('product', function($query) use ($key) {
                                    $query->where('name','like','%'.$key.'%');
                                })->orWhere('reviews.review','like','%'.$key.'%');
        }

        $reviews = $reviews->paginate(4);

        $reviews->appends(request()->all());

        return view('admin.user.review',compact('reviews'));
    }

    //delete user review
    public function deleteReview (Request $request)
    {
        Review::where('id', $request->id)->delete();

        return response()->json(['msg' => 'success'], 200);
    }

    //product validation check
    private function productValidationCheck ($request,$action)
    {
        $validationRules = [
            'name' => 'required|unique:products,name,' . $request->id,
            'description' => 'required',
            'price' => 'required',
            'size' => 'required',
            'category' => 'required',
        ];
        $validationRules['image'] = $action == 'create' ? 'required' : '' ;

        Validator::make($request->all(), $validationRules)->validate();
    }

    //get product information
    private function getProductInfo ($request)
    {
        return [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'size' => $request->size,
        ];
    }
}
