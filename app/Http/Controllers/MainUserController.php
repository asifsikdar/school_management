<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MainUserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userprofile(){
        $id = Auth::User()->id;
        $user = User::find($id);
        return view('User.profile.userprofile_view',compact('user'));

    }

    public function UserProfileEdit(){
        $id = Auth::User()->id;
        $edit = User::find($id);
        return view('User.profile.userprofile_edit',compact('edit'));

    }

    public function UserProfileUpdate( Request $request){
       $data = User::find(Auth::user()->id);
       $data->name = $request->name;
       $data->email = $request->email;

       if($request->file('profile_photo_path')){
           $file = $request->file('profile_photo_path');
           @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'),$filename);
           $data['profile_photo_path'] = $filename;
       }
       $data->save();
       $notification = array(
           'message' => 'User Profile Updated Successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('user.profile')->with($notification);
    }


    public function Userpasswordview(){
        return view('User.Password.edit_password');
    }

    public function Userpasswordupdate(Request $request){
       $validate = $request->validate([
          'oldpassword' => 'required',
          'password' => 'required|confirmed',
       ]);

      $password = Auth::user()->password;
      if(Hash::check($request->oldpassword, $password)){
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        $notification = array(
            'message' => 'User Password Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('login')->with($notification);
      }else{
          return redirect()->back();
      }
    }

}
