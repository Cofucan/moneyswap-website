@extends('layouts.admin')
 @section('page_title', $announcement->headline)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('announcements')}}" class="s-text16">
                Announcement
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                {{$announcement->headline}}
            </span>
        </div>
    <div class="row">
  <div class="col-md-6 content_title">
     	<h3>  {{ $announcement->headline }} </h3>
    </div>
    @if ( Auth::user()->profile->role_id == 1 )
  <div class="col-md-5">
	  <div class="page_button">
        <a href="{{ url('announcements/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
        {{-- <a href="{{ url('announcements/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a> --}}
        <a class="btn btn-primary btn-sm" href="{{ route('announcements.edit',$announcement->id) }}"><i class="fa fa-pencil"></i> Edit</a>
	  </div>
    </div>
    @endif
</div>

<div class="row details">

        <div class="col-xs-8 col-sm-8 col-md-8">
            {{-- <hr>
            <div class="form-group">
                <strong>Title :</strong>
                {{ $announcement->headline }}
            </div>
            <hr> --}}


                <div class="school-image mb-2">
                    {{-- Image: <img src="{{$announcement->getFirstMediaUrl('images')}}" /> --}}
                     <img src="{{$announcement->getFirstMediaUrl('images')}}" />
                </div>
                <div class="box-white">
                    {!! $announcement->announcement_body !!}
                    @if (!empty($announcement->action_url))
                    <div class="form-group">
                        <a href="{{url ($announcement->action_link)}}" class="btn btn-success">{{$announcement->page_button}}</a>
                    </div>
                    @else
                    @endif
               </div>

            {{-- <hr>
            <h4>Display Comments</h4>
                    @include('comments._comment_replies', ['comments' => $announcement->comments, 'commentable_id' => $announcement->id])
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="commentable_id" value="{{ $announcement->id }}" />
                            <input type="hidden" name="commentable_type" value="announcement" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form> --}}
        </div>
    </div>
    </div>

@endsection
