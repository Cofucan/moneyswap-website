@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/compact-gallery.css')}}">
<link href="{{ asset ('css/gallery.css')}}" rel="stylesheet">
@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pictures</li>
        <div class="ml-auto mr-0">
           <a class="btn btn-primary btn-sm" href="{{url('albums')}}">Photo Album</a>
        </div>
    </ol>
</nav>
    <div class="row">
        <div class="col-md-2 side-menu">                
            <div class="side-menu-header">
                <h5>View By Albums <i class="fa fa-list-ul"></i></h5>
            </div>
            <div class="quick-links">
                <ul>
                  @foreach ($albums as $album)
                  <li><a href="{{route('albums.show', $album)}}">{{$album->label}}</a></li>
              @endforeach
                </ul> 
            </div>
        
          </div>
            <div class="col-md-10">
                
              <h4>Most Recent Photos</h4>
              <div class="row">
                @foreach($photos as $photo)      
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-2">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                         data-image="{{asset($photo->file_path)}}" data-target="#image-gallery">
                          <img class="img-thumbnail" src="{{asset($photo->file_path)}}" alt="Another alt text">
                    </a>
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
                {{$photos->links()}}
              </div>
    
           
        </div>
            
    </div>
</div> 

@endsection
@push('scripts')
    @include('contentmanagement::photos.script')
    <script src="{{ asset ('plugins/magnific-popup/magnific-popup.min.js')}}"></script>
@endpush
