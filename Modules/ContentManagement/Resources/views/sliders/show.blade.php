@extends('layouts.admin')
@section('title', $slider->title )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

<section>
    <div class="container">
        <nav aria-label ="breadcrumb">
           
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('/home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('sliders/manage') }}">Sliders</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$slider->caption }}</li>

                <div class="ml-auto mr-0">
                    @if($slider->published == true)                 
                    <a class="btn btn-warning btn-sm" href="{{ url('sliders/toggle', $slider)}}">Disable</a>
                    @else                        
                    <a class="btn btn-success btn-sm" href="{{ url('sliders/toggle', $slider->id)}}">Enable</a>
                    @endif 
                    <a class="btn btn-primary btn-sm" href="#editslider{{ $slider->id }}" data-toggle="modal" data-target="#editslider{{ $slider->id }}"><i class="fa fa-edit"></i> Edit</a>
                    @include('contentmanagement::sliders._modaledit')
                </div>
            </ol>
        </nav>
        
        <div class="row details">
            <div class="col-sm-5 col-md-4">
                <div class="school-image">
                    <form action="{{ route('sliders.changeimage') }}" method="POST" enctype="multipart/form-data" >
                        {{csrf_field()}}
                       <input type="hidden" name="slider_id" value="{{$slider->id}}">
                       <div class="input-group mb-3">
                           <img src="{{ asset ($slider->display_media) }}" alt="{{ $slider->title }}" class="avatar img-circle img-thumbnail">
                           <input type="file" name="display_media" class="form-control center-block file-upload {{ $errors->has('display_media') ? ' is-invalid' : '' }}">
                           <div class="input-group-append" id="button-addon4">
                           <button type="submit" class="btn btn-sm btn-primary btn-block">
                               {{ __('Save') }}
                           </button>
                           </div>
                       </div>
                   </form>
                </div>
                
            </div>
    
            <div class="col-sm-5 col-md-4">
                <div class="form-group mt-4">               
                   <h5>{{ $slider->caption }}</h5> 
                </div>
                <hr>
               
                <p> {!! $slider->highlight !!} </p>   
               
                <div class="form-group">
                    @if (!empty($slider->button_one_link))               
                        <a href="{{url ($slider->button_one_link)}}" class="btn btn-success">{{$slider->button_one}}</a>
                    @endif
                    @if (!empty($slider->button_two_link))               
                        <a href="{{url ($slider->button_two_link)}}" class="btn btn-success">{{$slider->button_two}}</a>
                    @endif
                </div>
            </div>
           
        </div> 
    </div>
</section>
    
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