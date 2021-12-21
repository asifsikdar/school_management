@extends('User.user_master')
@section('user')
<div style="padding: 40px">
  <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{(!empty($user->profile_photo_path))?
    url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">User-Name : {{$user->name}}</h5>
      <p class="card-text">User-Email : {{$user->email}}</p>
      <a href="{{route('user.edit.profile')}}" class="btn btn-primary">Edit Profile</a>
    </div>
  </div>
</div>
@endsection

