@extends('User.user_master')
@section('user')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="row" style="padding: 40px">
   <div class="col-md-6">
    <form method="post" action="{{route('profile.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">User Name</label>
          <input type="name" name="name" value="{{$edit->name}}" class="form-control" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">User Email</label>
          <input type="email" name="email" value="{{$edit->email}}" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">User Profile Input</label>
          <input type="file" name="profile_photo_path" id="image" class="form-control-file">
        </div>
        <div class="form-group">
           <img id="showimage" src="{{(!empty($edit->profile_photo_path))?
            url('upload/user_images/'.$edit->profile_photo_path):url('upload/no_image.jpg') }}" style="height: 150px", width="150px">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
   </div> 
</div>

<script type="text/javascript">
 $(document).ready(function(){
     $('#image').change(function(e){
         var reader = new FileReader();
         reader.onload = function(e){
            $('#showimage').attr('src',e.target.result);  
         }
         reader.readAsDataURL(e.target.files['0']);
     });
 });
</script>
@endsection