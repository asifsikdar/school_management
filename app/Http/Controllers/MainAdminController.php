<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class MainAdminController extends Controller
{
    public function adminprofile(){
        $adminData = Admin::find(1);
        return view('Admin.profile.adminprofile',compact('adminData'));
    }

    public function AdminProfileEdit(){
        $adminData = Admin::find(1);
        return view('Admin.profile.adminprofile_edit',compact('adminData'));
    }

    public function AdminProfileUpdate(Request $request){
       $data = Admin::find(1);
       $data->name = $request->name;
       $data->email = $request->email;

       if($request->file('profile_photo_path')){
         $file = $request->file('profile_photo_path');
         @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
         $filename = date('YmdHi').$file->getClientOriginalName();
         $file->move(public_path('upload/admin_images'),$filename);
         $data['profile_photo_path'] = $filename;
         
       }
       $data->save();
       $notification = array(
        'message' => 'Admin Profile Updated Successfully',
        'alert-type' => 'success'
      );
         return redirect()->route('admin.profile')->with($notification);
      }

    public function adminpasswordview(){
        $data = Admin::find(1);
        return view('Admin.password.edit_password');
    }

    public function adminpasswordupdate(Request $request){
        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
         ]);
  
        $password = Admin::find(1)->password;
        if(Hash::check($request->oldpassword, $password)){
          $admin = Admin::find(1);
          $admin->password = Hash::make($request->password);
          $admin->save();
          Auth::logout();
          $notification = array(
              'message' => 'User Password Updated Successfully',
              'alert-type' => 'info'
          );
          return redirect()->route('admin.logout')->with($notification);
        }else{
            return redirect()->back();
        }
    }

}
