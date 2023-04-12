<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    //user contact page
    public function contactPage ()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->with('products')->get();

        $totalPrice = 0;
        foreach ($cart as $c)
        {
            $totalPrice += $c->quantity * $c->products[0]->price;
        }

        return view('user.contact.index',compact('cart','totalPrice'));
    }

    //contact
    public function contact (Request $request)
    {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'message' => $request->message
        ];

        Contact::create($data);
        return redirect()->route('home');
    }

    //admin ui user contacts show
    public function userContactPage ()
    {
        $contacts = Contact::orderBy('created_at','desc')->paginate(4);

        return view('admin.user.contact',compact('contacts'));
    }

    //delete user contact
    public function delete ($id)
    {
        Contact::where('id',$id)->delete();
        return back();
    }

    public function emailBackPage ($id)
    {
        $contact = Contact::where('id',$id)->first();

        return view('admin.user.contact_mail',compact('contact'));
    }

    //email back to user contact
    public function emailBack (Request $request, $id)
    {
        $contact = Contact::where('id',$id)->get();

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline
        ];

        Notification::send($contact, new SendEmailNotification($details));

        return redirect()->back();
    }
}
