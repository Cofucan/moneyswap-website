@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.css">
@endpush
@section('content')
<div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('studio/manage')}}" class="s-text16">
        Gallery
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Photos
    </span>
</div>
        <div class="row">
            <div class="col-md-8 content_title">
                <h3> Photos </h3>	<small>The list below shows the photos create for various galleries</small>
            </div>
            <div class="col-md-4">

                <div class="page_button">
                    <a href="{{ url('photo/create') }}"><button class="btn btn-sm btn-success">Add New Photo <i class="fa fa-photo"></i></button></a>
                   
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">              
                <div class="">
                    <table class="table table-unbordered" id="table">

                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Date/Time Added</th>
                                <th>Operations</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($photos as $photo)
                            <tr>
                                <td>{{$photo->id}}</td>
                                <td><img class="img-responsive thumbnail_img" src="{{  asset($photo->thumbnail) }}" /></td>
                                <td>
                                    @if($photo->published == 1)
                                        <span class="enable">Active</span>
                                    @else
                                        <span class="disable">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $photo->updated_at->format('F d, Y') }}</td>
                                <td>
                                    <form action="{{ route('photo.update', $photo->id) }}" method="post"
                                        onsubmit="return confirm('Revert process will Enable/Disable the image. Continue?');">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put" />
                                        <input type="hidden" name="id" value="{{ $photo->id }}" />
                                        <button type="submit" class="btn btn-sm btn-info action_btn">Revert</button>
                                    </form>
                                    <form action="{{ route('photo.destroy', $photo->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endsection
        @push('scripts')
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/datatables.min.js"></script>
        <script>
          $(document).ready(function() {
            $('#table').DataTable();
        } );
         </script>

         @endpush
