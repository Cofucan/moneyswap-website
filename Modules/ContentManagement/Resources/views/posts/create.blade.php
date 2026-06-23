@extends('layouts.admin')
@section('content_title', 'New Post')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

<div class="container-fluid">
    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('posts/manage') }}">  Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Post</li>
            
        </ol>
    </nav>  
<div class="row">

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Post </h4>
          <form method="POST" action="{{ route('posts.store') }}" id="CreateBlog" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="headline"> Headline <span class="required">*</span></label>
                    <input type="text" name="headline" value="{{  old('headline') }}" class="form-control{{ $errors->has('headline') ? ' is-invalid' : '' }}" placeholder="Enter title "  id="headline" required/>
                    @if ($errors->has('headline'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('headline') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="story">Content</label>
                    <textarea name="story" class="form-control" rows="4" placeholder="Enter Post content" id="textarea"> {!! old('story') !!}</textarea>
                    @if ($errors->has('story'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('story') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3 form-group">
                    <label for="gender" class="control-label"> Categories </label><br>
                    
                                        
                    @foreach($classifications as $key => $classification)
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="classifications[]" id="{{$key}}" value="{{$key}}" class="custom-control-input {{ $errors->has('classification') ? ' is-invalid' : '' }}">
                            <label class="custom-control-label" for="{{$key}}">{{$classification}}</label>
                        </div>
  
                        @endforeach
                        @if ($errors->has('classification'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('classification') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="allow_comment" id="allow_comment" value="1" checked>
                            <label class="form-check-label" for="allow_comment">Allow Comment </label>
                        </div>
                        <button class="btn btn-sm reveal pull-right">Add Post Source </button>
                        <div class="toggle_container" id="Description">
                            <div class="form-group ">
                                <label for="post_source">Source</label>
                                <input type="text" name="post_source" value="" class="form-control" id="post_source" />
                                @if ($errors->has('post_source'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('post_source') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <label for="display_media">Display Media <span class="required">*</span></label>
                    <input type="file" name="display_media" class="form-control {{ $errors->has('headline') ? ' is-invalid' : '' }}"  id="display_media" required/>
                    @if ($errors->has('display_media'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('display_media') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- <div class="form-group">
                    <label for="display_media">Video URL </label>
                    <input type="text" name="video" class="form-control {{ $errors->has('video') ? ' is-invalid' : '' }}"  id="video" />
                    @if ($errors->has('video'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('video') }}</strong>
                        </span>
                    @endif
                </div> --}}
                <hr class="mb-4">
                <button class="btn btn-success" type="submit" name="status" value="Draft">Save </button>
                <button class="btn btn-success" type="submit" name="status" value="Scheduled">Schedule </button>
                {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}

            </form>
        </div>
</div>
</div>


@endsection
@include('partials.summernote')
@push('scripts')
       <script>

        jQuery(document).ready(function($){
            $(".toggle_container").hide();
            $("button.reveal").click(function(){
                $(this).toggleClass("active").next().slideToggle("fast");

                if ($.trim($(this).text()) === 'Add Description') {
                    $(this).text('Hide Description');
                } else {
                    $(this).text('Add Description');
                }

                return false;
            });
            $("a[href='" + window.location.hash + "']").parent(".reveal").click();
        });

    </script>

@endpush
