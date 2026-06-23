@extends('layouts.admin')
@section('page_title', $guideline->label )
@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">

@endpush
@section('content')


<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{route ('portals.show', $portal->id) }}">School Details</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$guideline->label}}</li>
        <div class="ml-auto mr-0">
            <a class="btn btn-primary btn-sm px-3 mb-2" data-toggle="modal" data-target="#editpolicy{{$guideline->id}}" href="#editpolicy{{ $guideline->id }}"><i class="fa fa-edit"></i> Edit</a >
                @if($guideline->enabled == true)
                <a class="btn btn-warning btn-sm px-3 mb-2" href="{{ url('guidelines/toggle', $guideline->id)}}">Unpublish</a>
                @else
                <a class="btn btn-success btn-sm px-3 mb-2" href="{{ url('guidelines/toggle', $guideline->id)}}">Publish</a>
                @endif
                @include('contentmanagement::guidelines._formedit')
        </div>
    </ol>
</nav>


    <div class="row details mt-4 ">
       <div class="col-xs-10 col-sm-10 col-md-10  ">
                <h3>  {{ $guideline->label }} </h3>

                <strong>Status:</strong>
                @if($guideline->enabled == true)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif

            <div class="card mt-4">
                <div class="card-body">
                {!! $guideline->overview!!}
                </div>
            </div>
        </div>


    </div>


@endsection

@push('scripts')
<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 400,
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
