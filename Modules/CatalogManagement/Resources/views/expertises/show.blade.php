@extends('layouts.admin')
@section('page_title', $expertise->label )
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
                <li class="breadcrumb-item"> <a href="{{ url('expertises/manage') }}"> What We Do</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $expertise->label }}</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-primary btn-sm" href="{{ route('expertises.edit',$expertise->slug) }}"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </ol>
        </nav>        
    

        <div class="row mt-3">
            <div class="col-md-9">
                <h3>  {{ $expertise->label }} </h3>
                <div class="card">
                    <div class="school-image mt-3">
                        <form action="{{ route('expertises.changeimage') }}" method="POST" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <input type="hidden" name="expertise_id" value="{{$expertise->id}}">
                            <div class="input-group mb-3">
                                <img src="{{ asset ($expertise->display_image) }}" alt="Photograph" class="avatar img-circle img-thumbnail">
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
                            {{ $expertise->status}}
                            <hr>
                        </div>                     
                        <div class="form-group">                           
                            {!! $expertise->overview!!}
                        </div>

                        <div class="box-body">
                            @if ($expertise->videos->count() > 0)
                            <h5>Videos</h5>
                            <div class="row">
                              @foreach($album->videos as $video)  
                                <div class="col-lg-6 col-md-6 col-xs-6 mb-2">
                                  @include('contentmanagement::videos._show')
                                </div>
                              @endforeach            
                            </div>
                            @else
                            {{-- <p class="text-center text-danger"><b>No vid in this album yet, click the "Add Pictures" button to add pictures </b></p> --}}
                            
                            @endif
                        </div>
                    </div>
                </div>               
            </div>         
            <div class="col-md-3 mt-3">
                <div class="school-image">
                    <form action="{{ route('expertises.changethumb') }}" method="POST" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        <input type="hidden" name="expertise_id" value="{{$expertise->id}}">
                        <div class="input-group mb-3">
                            <img src="{{ asset ($expertise->thumbnail) }}" alt="Photograph" class="thumb img-circle img-thumbnail">
                            <input type="file" name="thumbnail" class="form-control center-block thumb-upload {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" required>
                            <div class="input-group-append" id="button-addon4">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Change Thumbnail
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">                        
                        {{-- @if($expertise->show_thumbnail == true)                 
                        <a class="btn btn-danger btn-sm" href="{{ url('expertises/thumbnail', $expertise)}}" data-toggle="tooltip" data-placement="top" title="Click to Disable Thumbnail">Disable Thumbnail</a>
                        @else                        
                        <a class="btn btn-success btn-sm" href="{{ url('expertises/thumbnail', $expertise)}}" data-toggle="tooltip" data-placement="top" title="Click to Display Thumbnail">Display Thumbnail</a>
                        @endif  --}}
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