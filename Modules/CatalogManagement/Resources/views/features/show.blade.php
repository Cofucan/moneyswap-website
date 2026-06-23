@extends('layouts.admin')
@section('page_title', $feature->label )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
@endpush
@section('content')


<section>
    <div class="container">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"> <a href="{{ url('features/manage') }}"> Feature</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $feature->label }}</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-primary btn-sm" href="{{ route('features.edit',$feature->slug) }}"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </ol>
        </nav>        
    

        <div class="row mt-3">
            <div class="col-md-9">
                <h3>  {{ $feature->label }} </h3>
                <div class="card">
                    <div class="school-image mt-3">
                        <form action="{{ route('features.changeimage') }}" method="POST" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <input type="hidden" name="feature_id" value="{{$feature->id}}">
                            <div class="input-group mb-3">
                                <img src="{{ asset ($feature->display_image) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
                                <input type="file" name="display_image" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                                <div class="input-group-append" id="button-addon4">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Change Cover Image
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $feature->status}}
                            <hr>
                        </div>                     
                        <div class="form-group">                           
                            {!! $feature->overview!!}
                        </div>

                       
                    </div>
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

    $(function() {
      var readURL = function(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
  
              reader.onload = function (e) {
                  $('.thumb').attr('src', e.target.result);
              }
  
              reader.readAsDataURL(input.files[0]);
          }
      }
  
  
      $(".thumb-upload").on('change', function(){
          readURL(this);
      });
    });
  </script>
@endpush