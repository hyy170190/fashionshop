<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //admin info view and edit page
    public function viewInfo()
    {
        $id = Auth::user()->id;
        $data = User::where('id',$id)->first();
        return view('admin.account.view', compact('data'));
    }

    //admin information update
    public function updateInfo($id, Request $request)
    {
        $this->accountInfoValidationCheck($request);
        $data = $this->getAdminAccData($request);

        //for image update
        if ($request->hasFile('image'))
        {
            $oldImg = User::where('id',$id)->first()->image;

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/profile_img',$fileName);
            $data['image'] = $fileName;

            if ($oldImg != null)
            {
                Storage::delete('public/profile_img/' . $oldImg);
            }
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#dashboard')->with(['updateSuccess' => 'Admin Info Updated']);
    }

    //view admin accounts list
    public function list ()
    {
        $accounts = User::where('role','admin')
                        ->when(request('key'),function($query){
                            $query->where(function($q){
                                $q->orWhere('name','like','%'.request('key').'%')
                                      ->orWhere('gender','like','%'.request('key').'%')
                                      ->orWhere('phone','like','%'.request('key').'%');
                            });
                        })
                        ->get();

        return view('admin.account.list', compact('accounts'));
    }

    //view user accounts list
    public function userAccount ()
    {
        $accounts = User::where('role','user')->get();
        return view('admin.account.userList', compact('accounts'));
    }

    //delete admin account
    public function delete ($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('admin#list');
    }

    //ajax admin account role change
    public function roleChange (Request $request)
    {
        User::where('id',$request->userId)->update([
            'role' => $request->role
        ]);
    }

    //admin account password change page
    public function changePasswordPage ()
    {
        return view('admin.account.passwordChange');
    }

    //account password change
    public function changePassword (Request $request)
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

    //user email send page
    public function sendEmail ($id)
    {
        $order = Order::with('user')->where('id',$id)->get();

        return view('admin.user.email',compact('order'));
    }

    //send user mails
    public function sendUserEmail (Request $request, $id)
    {
        $order = Order::with('user')->where('id',$id)->get();
        $userId = $order[0]->user->id;
        $user = User::find($userId);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline
        ];

        Notification::send($user,new SendEmailNotification($details));

        return redirect()->back();
    }

    //account information validation check
    private function accountInfoValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //get admin account data
    private function getAdminAccData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'gender' => $request->gender ,
            'address' => $request->address ,
            'updated_at' => Carbon::now() ,
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
