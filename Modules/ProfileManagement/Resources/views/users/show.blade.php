@extends('layouts.admin')
@section('page_title', $user->Profile->name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')


 
  
<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('users')}}" class="s-text16">
        Users
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        {{ $user->Profile->full_name }}
    </span>
</div>
    
    
<div class="row mt-4 mb-5">
  	<div class="col-md-3"><!--left col-->              

        <div class="text-center">
            <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" > 
                {{csrf_field()}}
                <input type="hidden" name="profile_id" value="{{$user->profile_id}}">
                <div class="input-group mb-3">
                    <img src="{{ asset ($user->Profile->avatar) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
                    <input type="file" name="display_image" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                    <div class="input-group-append" id="button-addon4">
                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                        {{ __('Change') }}
                    </button>
                    </div>
                </div>
            </form>
        
        </div><hr><br>

          
        </div><!--/col-3-->
    	<div class="col-md-5">
            <h4>   {{ $user->Profile->full_name }} </h4>
            <table class="table table-bordered">                
                   <tr> <td><strong>Profile: </strong>{{$user->Profile->name}}</td> </tr>
                   <tr> <td><strong>Telephone: </strong> {{$user->Profile->DefaultPhone->contact_value ?? 'None'}}</td></tr>
                    <tr> <td><strong>Email</strong></span> {{$user->email}}</td></tr>
                    <tr>  <td><strong>Last Login: </strong>{{ $user->last_login_at }} </td></tr>
                    <tr><td><strong>Last Login Ip: </strong>  {{ $user->last_login_ip }}</td></tr>
                    <tr><td><strong>Last Password Change: </strong>  {{ $user->password_change_at }}</td></tr>
                    <tr><td><strong>Email Verified At: </strong>  {{ $user->email_verified_at }}</td></tr>
                    <tr><td><strong>Status: </strong>  {{ $user->status }}</td></tr>
               
            </table>
           
           <ul class="list-stream">
            <li class="list-stream-item text-muted">Info <i class="fa fa-dashboard fa-1x"></i></li>
            
      

        </div><!--/col-9-->
        <div class="col-md-10">
            
        </div>
    </div>

        
   


@endsection

@push('scripts')
<script>
  $(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>

 @endpush
