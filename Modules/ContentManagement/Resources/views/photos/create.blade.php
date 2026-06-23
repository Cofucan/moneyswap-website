@extends('layouts.admin')
@section('page_title', 'Add Photo')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')
<div class="container-fluid">
<div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('studio/manage')}}" class="s-text16">
        Gallery
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('photo/manage')}}" class="s-text16">
        Photos
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Add Photo
    </span>
</div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"> </span>
            <!-- <span class="badge badge-secondary badge-pill">3</span> -->
          </h4>
        <div class="page-menu">
            <ul>

            </ul>
        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Upload Images</h4>

                <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="gallery"> Gallery</label>
                        <select class="custom-select d-block w-100 select2 {{ $errors->has('gallery') ? ' is-invalid' : '' }}"  name="gallery_id" id="gallery" required>
                        @foreach($galleries as $key => $gallery)
                            <option value="{{$key}}"> {{$gallery}}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('gallery_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('gallery_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    @include('photos._form')


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
   $('.select2').select2();
  }
  );
</script>
@endpush
