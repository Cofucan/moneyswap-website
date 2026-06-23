@extends('layouts.admin')
@section('page_title', 'Video')
@push('styles')

@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Videos</li>
        <div class="ml-auto mr-0">
          <a class="btn btn-success btn-sm" href="{{url('albums/manage')}}">Albums</a>
           <a class="btn btn-primary btn-sm" href="{{url('photos')}}">All Pictures</a>
           <a class="btn btn-primary btn-sm" href="#addvideo" data-toggle="modal" data-target="#addvideo">
            Add Videos </a>
           {{--Add Video modal begins--}}
                <div class="modal fade" id="addvideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title text-center text-black">Add Video</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('videos.store') }}" method="post" >
                            {{ csrf_field() }}
                        
                            @include('contentmanagement::videos._form')

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Add</button>
                         
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
    <div class="col-md-7 content_title">
     	<h3> Videos </h3>	<small>The list below shows the video create for various views</small>
	</div>
    <div class="col-md-3 offset-md-2">
        {{-- <a href="{{ url('photo/manage') }}" class="p-l-5"><button class="btn btn-sm btn-warning">View Photos  <i class="fa fa-photo"></i></button></a> --}}
	</div>

</div>
    <div class="row mt-4">
        @foreach ($videos as $video)
            <div class="col-md-4 col-sm-4 mb-2">
                @include('contentmanagement::videos._show')
            </div>
        @endforeach
      
    </div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
