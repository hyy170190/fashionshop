<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //ajax user role change
    public function userRoleChange (Request $request)
    {
        User::find($request->userId)->update([
            'role' => $request->role
        ]);

    }

    //account info and edit page
    public function infoPage ($id)
    {
        $data = User::where('id',$id)->first();

        return view ('user.account.edit', compact('data'));
    }

    //user account info update
    public function update (Request $request)
    {
        $this->infoValidationCheck($request);
        $data = $this->getUserInformation($request);

        if ($request->hasFile('image'))
        {
            if (Auth::user()->image == null)
            {
                $newImg = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/profile_img', $newImg);
                $data['image'] = $newImg;
            }
            else
            {
                $oldImg = Auth::user()->image;
                Storage::delete('public/profile_img/' . $oldImg);

                $newImg = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/profile_img', $newImg);

                $data['image'] = $newImg;
            }
        }

        User::find($request->id)->update($data);
        return redirect()->route('home');
    }

    //product shop page
    public function shopPage ()
    {
        $products = Product::when(request('key'), function($query){
                            $query->where('products.name','like','%'.request('key').'%');
                        })
                        ->orderBy('products.price', 'asc')
                        ->paginate(12);
        $categories = Category::with('products')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        $para = 'asc';

        $products->appends(request()->all());

        return view('user.shop', compact('products','categories','cart','totalPrice','para'));
    }

    //user account password change
    public function passwordChange (Request $request)
    {
        $this->passwordValidationCheck($request);

        $pwHashValue = User::where('id',$request->id)->first()->password;

        if (Hash::check($request->oldPassword,$pwHashValue))
        {
            User::where('id',$request->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            Auth::logout();
            return redirect()->route('login');
        }
        return back()->with(['notMatch' => 'The old password not match. Try again!']);
    }


    //user information validation check
    private function infoValidationCheck ($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ])->validate();
    }

    //get user information
    private function getUserInformation ($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now()
        ];
    }

    //password validation checking
    private function passwordValidationCheck ($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword'
        ])->validate();
    }
}
