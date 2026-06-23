@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Photo Albums</li>
        <div class="ml-auto mr-0">
           <a class="btn btn-success btn-sm" href="{{url('albums/create')}}">Add New Album</a>
           <a class="btn btn-primary btn-sm" href="{{url('photos')}}">All Pictures</a>
        </div>
    </ol>
</nav>

<div class="row">
    <div class="col-md-7 content_title">
     	<h3> Albums </h3>	<small>The list below shows the album create for various views</small>
	</div>
    <div class="col-md-3 offset-md-2">
        {{-- <a href="{{ url('photo/manage') }}" class="p-l-5"><button class="btn btn-sm btn-warning">View Photos  <i class="fa fa-photo"></i></button></a> --}}
	</div>

</div>
    <div class="row mt-4">
        @foreach ($albums as $album)
            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="card">
                    <a href="{{ route('albums.show', $album->slug) }}"><img class="img-responsive w-100" src="{{  asset($album->cover) }}" height="120px"/>
                    </a>
                    <div class="px-3 py-3">
                        <h5>{{$album->label}}</h5>
                        <p><i class="fa fa-photo"></i>: {{ $album->Photos->count() }} Images</p>
                        <p>
                            <div class="row no-gutters">
                                <div class="col-md-10">
                                    <a class="btn btn-secondary btn-sm" href="{{ route('albums.show', $album->slug) }}">Details</a>
                                    @if($album->published == true)
                                    <a class="btn btn-warning btn-sm" href="{{ url('albums/toggle', $album->slug)}}">Unpublish</a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ url('albums/toggle', $album->slug)}}">Publish</a>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('albums.destroy',$album) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Thumbnail</th>
                            <th >Album Title</th>
                            <th >Album Type</th>
                            <th>Status</th>
                            <th >Total Images </th>
                            <th  width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $album)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img class="img-responsive thumbnail_img" src="{{  asset($album->thumbnail) }}" width="70px" height="70px"/></td>
                            <td>{{$album->label}}</td>
                            <td>{{$album->albumable_type}}</td>
                            <td>
                                @if($album->published == 1)
                                Published
                                @else
                                Not Published
                                @endif
                            </td>
                            <td>{{ $album->Photos->count() }} Images</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-10">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('album.show', $album->id) }}">Details</a>
                                        @if($album->published == true)
                                        <a class="btn btn-warning btn-sm" href="{{ url('albums/toggle', $album->id)}}">Unpublish</a>
                                        @else
                                        <a class="btn btn-success btn-sm" href="{{ url('albums/toggle', $album->id)}}">Publish</a>
                                        @endif
                                        <a class="btn btn-primary btn-sm" href="{{ route('album.edit',$album->id) }}"><i class="fa fa-edit"></i> </a>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="{{ route('album.destroy',$album->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
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
