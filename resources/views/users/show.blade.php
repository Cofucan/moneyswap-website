@extends('layouts.admin')
@section('page_title', $user->last_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')


 
    <div class="container ">
     <div class="row ">
        <div class="col-md-7 content_title">
            <h4>  {{ $user->person->salutation }} {{ $user->person->last_name }} </h4>
        </div>
        <div class="col-md-3">

          
        </div>
      </div>
    
    <div class="row mt-4 mb-5">
  		<div class="col-sm-4"><!--left col-->
              

      <div class="text-center ">
         <form action="" method="POST" enctype="multipart/form-data" >
         {{--  <form action="{{ route('people.changedisplay') }}" method="POST" enctype="multipart/form-data" >  --}}
            {{csrf_field()}}
            <input type="hidden" name="person_id" value="">
            <div class="input-group mb-3">
                <img src="{{ asset ($user->Person->photograph) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
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
    	<div class="col-sm-7">
            <span> <strong class="p-r-50">Last Login At: </strong>{{ $user->last_login_at }} </span><br>
            <span> <strong class="p-r-50">Last Login Ip: </strong>{{ $user->last_login_at }}</span>
           <ul class="list-group">
            <li class="list-group-item text-muted">Info <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Person </strong></span> {{$user->person->salutation}} {{$user->person->last_name}} {{$user->person->first_name}} </li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Telephone</strong></span> {{$user->telephone}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> {{$user->email}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Referral Code </strong></span> {{ $user->referral_code }} </li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Last Login </strong></span> </li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Last Login </strong></span>  </li>
            
          </ul> 

        </div><!--/col-9-->
        <div class="col-md-10">
            <P
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
