@extends('layouts.admin')
@section('page_title', $page->headline )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pages/manage') }}">  Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->headline }}</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-primary btn-sm" href="{{ route('pages.edit',$page->page_tag) }}"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </ol>
        </nav>        
    

        <div class="row mt-3">
            <div class="col-md-9">
                <h3>  {{ $page->headline }} </h3>
                <div class="card">
                    <div class="school-image mt-3">
                        <form action="{{ route('pages.changeimage') }}" method="POST" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <input type="hidden" name="page_id" value="{{$page->id}}">
                            <div class="input-group mb-3">
                                <img src="{{ asset ($page->display_image) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
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
                            @if($page->published == 1)
                            <span class="enable">Published</span>
                            @else
                            <span class="disable"> Not Published</span>
                            @endif
                            <hr>
                        </div>
                        @if (!empty($page->button_link))

                        <hr>
                        <div class="form-group">
                            <strong>Page Button:</strong>
                            <a href="{{url ($page->button_link)}}" class="btn btn-success">{{$page->page_button}}</a>
                        </div>           
                        @else
                        @endif
                        <div class="form-group">                           
                            {!! $page->body!!}
                        </div>
                    </div>
                </div>               
            </div>         
            <div class="col-md-3 mt-3">
                <div class="school-image">
                    <form action="{{ route('pages.changethumb') }}" method="POST" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        <input type="hidden" name="page_id" value="{{$page->id}}">
                        <div class="input-group mb-3">
                            <img src="{{ asset ($page->thumbnail) }}" alt="Photograph" class="thumb img-circle img-thumbnail">
                            <input type="file" name="thumbnail" class="form-control center-block thumb-upload {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" required>
                            <div class="input-group-append" id="button-addon4">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Change Thumbnail
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">                        
                        @if($page->show_thumbnail == true)                 
                        <a class="btn btn-danger btn-sm" href="{{ url('pages/thumbnail', $page)}}" data-toggle="tooltip" data-placement="top" title="Click to Disable Thumbnail">Disable Thumbnail</a>
                        @else                        
                        <a class="btn btn-success btn-sm" href="{{ url('pages/thumbnail', $page)}}" data-toggle="tooltip" data-placement="top" title="Click to Display Thumbnail">Display Thumbnail</a>
                        @endif 
                    </div>
                </div>
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