@extends('layouts.admin')
@section('page_title', $slider->caption)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{url('home')}}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{url('sliders/manage')}}">Sliders</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{$slider->caption }}</li>
        
    </ol>
</nav>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit slider </h4>
            <form action="{{ route('sliders.update', $slider) }}" method="POST"  id="Updateslider" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')
                @include('contentmanagement::sliders._formedit')
                
                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Update</button>

            </form>


        </div>
      
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("slider_description",
        {
            height: 120
        });
</script>

@endpush
