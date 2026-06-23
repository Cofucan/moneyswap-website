@extends('layouts.admin')
@section('page_title', $post->headline )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">

@endpush
@section('content')
    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('posts/manage') }}">  posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $post->headline }}</li>
            <div class="ml-auto mr-0">
                <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->id) }}"><i class="fa fa-edit"></i> Edit</a>
            </div>
        </ol>
    </nav> 

    <div class="row">
        <div class="col-md-7 content_title">
                <h4>  {{ $post->headline }} Details </h4>
        </div>
        <div class="col-md-5 ">
                <ul>
                    @foreach ($post->Classifications as $classification)
                    <li> {{$classification->label }} </li>
                    @endforeach
                </ul>
        </div>
    </div>

    <div class="row details">
        <div class="col-xs-12 col-sm-12 col-md-12 school-image">
            <div class="form-group">
            <img src="{{ asset ($post->display_media) }}" alt="{{$post->headline }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group mt-3">
                {{ $post->headline }}
            </div>
            <hr>
            <div class="form-group">
                <strong>Overview:</strong>
                {!! $post->story !!}
            </div>
        </div>
        <div class="form-group mt-3">
            {!! $post->video_html !!}
        </div>

    </div>



    </div>



@endsection
