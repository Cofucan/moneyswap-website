@extends('layouts.admin')
@section('page_title', $album->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/gallery.css') }}">
<style>
 
</style>
@endpush
@section('content')
<nav aria-label ="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item"> <a href="{{ url('albums/manage') }}">Photo Albums</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $album->label }} </li>
      <div class="ml-auto mr-0">
         <a class="btn btn-success btn-sm" href="#uploadpictures" data-toggle="modal" data-target="#uploadpictures">
          Upload Pictures </a>

          
        <a class="btn btn-secondary btn-sm" href="#editalbum" data-toggle="modal" data-target="#editalbum">
          Edit Album
        </a>
         {{-- Edit Album modal begins--}}
         <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-center">Edit {{ $album->label }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('albums.update', $album) }}" method="POST"  id="UpdateSection" enctype="multipart/form-data">
                  {{csrf_field()}}
                  @method('PUT')

                  <input type="hidden" name="album_id" value="{{ $album->id }}" />
                  @include('contentmanagement::albums._formedit')

                  <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Save </button>
                  {{--  <button class="btn btn-primary" type="reset">Reset</button>  --}}
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- modal ends--}}

        {{--Upload Pictures modal begins--}}
        <div class="modal fade" id="uploadpictures" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-center text-black">Add Pictures to {{ $album->label }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                  <input type="hidden" name="album_id" value="{{ $album->id }}" />
                  <input type="hidden" name="owner_type" value="{{ $album->galleryable_type }}" />
                  <input type="hidden" name="owner_id" value="{{ $album->galleryable_id }}" />
                 
                  @include('contentmanagement::photos._form')

                  <div class="modal-footer">
                  <button class="btn btn-success" type="submit">Upload</button>
                  {{--  <button class="btn btn-primary" type="reset">Reset</button>  --}}
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
  <div class="row">  
    <div class="col-md-9 col-sm-9 order-md-1 order-sm-1"> 
        <div class="bg-white px-3 py-3">  
          
            <div class="row">
              <div class="col-md-12 content_title">
                  {{-- <h3>  {{ $album->label }}</h3> --}}
              </div>
              <div class="col-md-4">
                <div class="school-image">
                  <form action="{{ route('albums.changephoto') }}" method="POST" enctype="multipart/form-data" >
      
                    {{csrf_field()}}
                    <input type="hidden" name="album_id" value="{{  $album->id }}">
                        <img src="{{ asset ($album->cover) }}" alt="Album Image" class="avatar img-circle img-thumbnail">
                    <div class="input-group mb-3">
                        <input type="file" name="display_image" class="form-control center-block file-upload {{ $errors->has('display_image') ? ' is-invalid' : '' }}" required>
                        <div class="input-group-append" id="button-addon4">
                          <button type="submit" class="btn btn-sm btn-primary btn-block">
                              Change Album Image
                          </button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-7 ">
                <h3 class="mt-3">  {{ $album->label }}</h3>
                <div class="form-group">   
                          
                  {!! $album->overview !!}
                </div>
              </div>
            </div>
            <div class="row mt-4">
            
              <div class="col-md-2 offset-md-7"> 
                  
                    
              </div>
            </div>
                  
          <div class="box-body">
          
              @if ($album->photos->count() > 0)
                <h5>Photos in this album</h5>
                <div class="row">
                  @foreach($album->photos as $photo)  
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-2">
                      <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="{{asset($photo->file_path)}}" data-target="#image-gallery">
                            <img class="img-thumbnail" src="{{asset($photo->file_path)}}" alt="Another alt text">
                      </a>
                      <div class="delete-button">
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="post"
                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                          <input type="hidden" name="_method" value="DELETE" />
                          {{ csrf_field() }}
                          <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </div>
                    
                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="image-gallery-title"></h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                            <div class="row mt-3">
                              <div class="col-md-12">
                                <span>{{$photo->description}}</span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                            </button>

                            <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>  
                  @endforeach
                </div>
              @else
                
              <p class="text-center text-danger"><b>No pictures in this album yet, click the "Add Pictures" button to add pictures </b></p>
              
              @endif
           
          </div>

          
        </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          Other Albums
        </div>
        <div class="card-body">
          <div class="side-menu">
            <ul>
              @foreach ($albums as $album)
              <li><a href="{{route('albums.show', $album->slug)}}">{{$album->label}}</a></li>
              @endforeach
            </ul> 
        </div>
        </div>
      </div>
    </div>
  
  </div>
@endsection
@push('scripts')
<script src="{{ asset('js/album.js')}}"></script>
@include('contentmanagement::photos.script')

<script>
  CKEDITOR.replace("overview",
      {
          height: 100,
          // Define the toolbar streams as it is a more accessible solution.
      toolbarGroups: [{
      "name": "basicstyles",
      "streams": ["basicstyles"]
      },
      {
      "name": "links",
      "streams": ["links"]
      },
      {
      "name": "paragraph",
      "streams": ["list", "blocks"]
      },
      {
      "name": "document",
      "streams": ["mode"]
      },
      {
      "name": "insert",
      "streams": ["insert"]
      },
      {
      "name": "styles",
      "streams": ["styles"]
      },
      {
      "name": "about",
      "streams": ["about"]
      }
  ],
  // Remove the redundant buttons from toolbar streams defined above.
  removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
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
</script>
@endpush 