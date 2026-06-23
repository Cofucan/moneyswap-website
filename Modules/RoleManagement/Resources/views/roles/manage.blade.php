@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('posts/manage')}}" class="s-text16">
        Posts
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Manage
    </span>
</div>

<div class="row">
  <div class="col-md-8 headline">
     	<h3> Posts </h3>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
        <a href="{{ url('posts/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

        <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>

                    <th> Last Updated</th>
                    <th> Status</th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->headline}}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                @if($post->published == 1)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif

                </td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-9">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('posts.show', $post->slug) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->slug) }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('posts.destroy',$post->slug) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
<!--
                <form action="{{ route('posts.changestatus', $post->id) }}" method="post"
                    onsubmit="return confirm('Action Publish/Unpublish the record. Continue?');">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />
                    <input type="hidden" name="id" value="{{ $post->id }}" />
                    <button type="submit" class="btn btn-sm btn-info action_btn"> <i class="fa fa-gear"></i>Change Status</button>
                </form> -->

            </tr>
            @endforeach
            </tbody>
            </table>
</div>
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
