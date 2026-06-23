@extends('layouts.admin')
@section('content_title', 'Add Service')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('expertises/manage') }}"> What We Do</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
        <div class="ml-auto mr-0">
        </div>
    </ol>
</nav>
<div class="container-fluid">
    
<div class="row">

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Edit Service </h4>
            <form action="{{ route('expertises.update', $expertise) }}" method="POST"  id="UpdateExpertise" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-group">
                    <label for="label"> Title <span class="required">*</span></label>
                    <input type="text" name="label" value="{{  $expertise->label }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Service Title"  id="label" required/>
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="overview">Description</label>
                    <textarea name="overview" class="form-control" rows="4" placeholder="Description" id="textarea">{!! $expertise->overview !!}</textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- <div class="custom-control custom-checkbox custom-control-inline mb-4">
                    <input id="featured" name="featured" type="checkbox" value="1" class="custom-control-input">
                    <label class="custom-control-label" for="featured">Featured</label>
                </div> --}}

               
                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
    </div>
</div>
 
@include('partials.summernote')

@endsection
@push('scripts')


@endpush
