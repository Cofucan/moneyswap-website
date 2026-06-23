@extends('layouts.admin')
@section('page_title', $person->last_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{asset ('css/select2.css') }}">
<style>
        #state_loading{
        visibility:hidden;
        }
    </style>
     <style>
            .myDiv{
                display:none;
            }  
        
        </style>
@endpush
@section('content')


 
    <div class="container ">
     <div class="row ">
        <div class="col-md-9 content_title">
            <h4>  {{ $full_name }} </h4>
        </div>
        <div class="col-md-3">

          <div class="page_button">
            <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#person{{$person->id}}">
              <i class="fa fa-edit"></i> Edit 
          </button>
          {{-- modal begins--}}
              <div class="modal fade" id="person{{$person->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h4 class="modal-title text-center">Edit Personal Info</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          </div>
                          <div class="modal-body">
                          <form method="POST" action="{{ route('people.update',  $person->id) }}" id="UpdatePerson">
                                  {{csrf_field()}}
                                  @method('PUT')
                                  
                              @include('people._formedit')
                              <div class="modal-footer">
                              <button class="btn btn-success" type="submit">Save </button>
                              <button class="btn btn-primary" type="reset">Reset</button> 
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
              </div>
          {{-- modal ends--}}
          </div>
        </div>
      </div>
    
    <div class="row mt-4 mb-5">
  		<div class="col-sm-4"><!--left col-->
           
      <div class="text-center ">
         {{-- <form action="" method="POST" enctype="multipart/form-data" > --}}
          <form action="{{ route('people.changephoto') }}" method="POST" enctype="multipart/form-data" > 
            {{csrf_field()}}
            <input type="hidden" name="person_id" value="{{ $person->id }}">
            <div class="input-group mb-3">
                <img src="{{ asset ($person->avatar ) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
                <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
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
            {{--  <span> <strong class="p-r-50">Status: </strong>Active</span><br>  --}}
            {{-- <span> <strong class="p-r-50">Has Login: </strong> --}}
            
            
            </span>
           <ul class="list-stream">
            <li class="list-stream-item text-muted">Info <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-stream-item text-right"><span class="pull-left"><strong>Full Name</strong></span> {{$full_name}}</li>
            <li class="list-stream-item text-right"><span class="pull-left"><strong>Birthday</strong></span> {{$person->birthday}}</li>
            <li class="list-stream-item text-right"><span class="pull-left"><strong>Gender</strong></span> {{$person->gender}}</li>
            <li class="list-stream-item text-right"><span class="pull-left"><strong>Religion</strong></span> {{$person->religion}}</li>
            <li class="list-stream-item text-right"><span class="pull-left"><strong>Created </strong></span> {{ $person->created_at }} </li>
            
          </ul> 

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
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
       
   
<script>
    jQuery(document).ready(function($) {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: false,
            locale: {
            format: 'YYYY/MM/DD'
            }
        });
    });
</script>

 @endpush
