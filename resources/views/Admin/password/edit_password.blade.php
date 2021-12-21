@extends('Admin.admin_master')
@section('admin.content')
<div class="row" style="padding: 40px">
    <div class="col-md-6">
        <h4>Change Password</h4>
     <form method="post" action="{{route('admin.password.update')}}">
         @csrf
         <div class="form-group">
           <label for="exampleInputEmail1">Old Password</label>
           <input id="current_password"  type="password" name="oldpassword" value="" class="form-control" placeholder="Enter Password">
         </div>
         <div class="form-group">
           <label for="exampleInputPassword1">New Password</label>
           <input id="password" type="password" name="password" value="" class="form-control" placeholder="Password">
         </div>
         <div class="form-group">
            <label for="exampleInputPassword1">Retype-New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" value="" class="form-control" placeholder="Password">
         </div>
 
         <button type="submit" class="btn btn-primary">Update</button>
       </form>
    </div> 
 </div>
@endsection