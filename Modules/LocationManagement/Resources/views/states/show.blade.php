@extends('layouts.admin')
@section('page_title', $state->state_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('states/manage') }}">  States</a></li>
                <li class="breadcrumb-item active" aria-current="state">{{ $state->state_name }}</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-primary btn-sm px-4" data-toggle="modal" data-target="#edit{{$state->tag}}">Edit                                         
                    </a>
                            {{-- modal begins--}}
                                <div class="modal fade" id="edit{{$state->tag}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$state->state_name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('states.update', $state->tag) }}" id="UpdateState"> 
                                                    {{csrf_field()}}  
                                                    @method('PUT')
                                                   <input type="hidden" name="state_id" id="state_id" value="{{$state->tag}}">             
                                                    @include('locationmanagement::states._formedit')
                        
                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Save </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                </div>
            </ol>
        </nav>        
    

        <div class="row mt-3">
            <div class="col-md-8">
                <h3>  {{ $state->state_name }} </h3>
                <div class="card">
                    <div class="school-image mt-3">
                        <form action="{{ route('states.changeimage') }}" method="POST" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <input type="hidden" name="state_id" value="{{$state->id}}">
                            <div class="input-group mb-3">
                                <img src="{{ asset ($state->display_image) }}" alt="Cover Image" class="avatar img-circle img-thumbnail">
                                <input type="file" name="display_image" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                                <div class="input-group-append" id="button-addon4">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Change Image
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                       <p><b>Slogan:</b> {{$state->slogan}}</p>
                        <div class="form-group">                           
                            {!! $state->about_state!!}
                        </div>
                    </div>
                </div>               
            </div>         
            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="school-image">                    
                        <p><b>State Governor:</b> {{$state->Governor->name}}</p>
                            <form action="{{ route('governors.changeimage') }}" method="POST" enctype="multipart/form-data" >
                                {{csrf_field()}}
                                <input type="hidden" name="page_id" value="{{$state->id}}">
                                <div class="input-group mb-3">
                                    <img src="{{ asset ($state->Governor->passport) }}" alt="Photograph" class="thumb img-circle img-thumbnail">
                                    <input type="file" name="thumbnail" class="form-control center-block thumb-upload {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" required>
                                    <div class="input-group-append" id="button-addon4">
                                        <button type="submit" class="btn btn-sm btn-primary btn-block">
                                            Change Image
                                        </button>
                                    </div>
                                </div>
                            </form>                 
                        </div>
                </div>
               
            </div> 
        </div>

@endsection
@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 200,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
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