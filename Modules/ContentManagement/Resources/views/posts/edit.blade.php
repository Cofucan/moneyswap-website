@extends('layouts.admin')
@section('page_title', $post->headline)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('posts/manage') }}">  Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{ $post->headline }}</li>
    </ol>
</nav>   
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Post </h4>
            <form action="{{ route('posts.update', $post->id) }}" method="POST"  id="UpdateBlog" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                <div class="form-group">
                    <label for="headline"> Title /Headline</label>
                    <input type="text" name="headline" value="{{$post->headline }}" class="form-control"  id="headline" />
                    @if ($errors->has('headline'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('headline') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="story">Description</label>
                    <textarea name="story" class="form-control" placeholder="Enter content" id="textarea">
                    {!! $post->story !!}</textarea>
                    @if ($errors->has('story'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('story') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    {{-- <div class="col-md-6 form-group mb-3">
                        <label for="display_media">Display Media</label>
                        <input type="file" name="display_media" value="{{$post->display_media }}" class="form-control"  id="display_media" />
                        @if ($errors->has('display_media'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('display_media') }}</strong>
                            </span>
                        @endif
                    </div> --}}
                    {{-- <div class="col-md-6 form-group">
                        <label for="display_media">Video URL </label>
                        <input type="text" name="video" value="{{$post->video }}" class="form-control {{ $errors->has('video') ? ' is-invalid' : '' }}"  id="video" />
                        @if ($errors->has('video'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('video') }}</strong>
                            </span>
                        @endif
                    </div> --}}
                </div>
                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>


        </div>
     

    </div>

@endsection
@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 500,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
@endpush
