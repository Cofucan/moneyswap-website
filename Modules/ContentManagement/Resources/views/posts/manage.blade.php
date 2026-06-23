@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Blog Post</li>
        <div class="ml-auto mr-0">
           <a class="btn btn-success btn-sm" href="{{url('posts/create')}}">Add New Post</a>
        </div>
    </ol>
</nav>
<div class="row">
  <div class="col-md-6 content_title">
     	<h3> Posts</h3>	
	</div>
    
    
</div>
    <div class="row mt-3">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Post Title</th>
                    <th > Status</th>
                    <th > Last Updated</th>
                    <th  width="30%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($posts as $post)
            <tr class="post{{$post->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$post->headline}}</td>
                <td>
                    @if($post->published == true)                 
                    Published
                    @else                        
                    Not Publish
                    @endif
                </td>
                <td>{{$post->updated_at}}</td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('posts.show', $post->id) }}">Details</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}">Edit </a>
                        </div>
                        {{-- @if($post->published == true)
                        <div class="col-md-3">                 
                            <a class="btn btn-warning btn-sm" href="{{ url('posts/toggle', $post->id)}}">Unpublish</a>
                            @else 
                            @if($post->status == 'Archived')                        
                            <a class="btn btn-success btn-sm" href="{{ url('posts/toggle', $post->id)}}">Publish</a>
                            @endif
                        </div>
                        @endif --}}
                        @if( $post->published == false)  
                        <div class="col-md-3">
                            <form action="{{ route('posts.process') }}" method="post"
                                onsubmit="return confirm('Are you sure you want to Approve this post?');">
                                <input type="hidden" name="post_id" value="{{$post->id}}" />
                                {{ csrf_field() }}
                                <button type="submit" name="status" class="btn btn-sm btn-success action_btn" value="Approved"> Approve</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('posts.process') }}" method="post"
                                onsubmit="return confirm('Are you sure you want to Reject this post?');">
                                <input type="hidden" name="post_id" value="{{$post->id}}" />
                                {{ csrf_field() }}
                                <button type="submit" name="status" class="btn btn-sm btn-danger action_btn" value="Rejected">Reject</button>
                            </form>
                        </div>
                        @endif
                        <div class="col-md-2">
                            <form action="{{ route('posts.destroy',$post->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </td>

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
  
 </script>

 @endpush
