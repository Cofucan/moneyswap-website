@extends('layouts.admin')
@section('content_title', 'Add Service')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('causes/manage') }}"> What We Do</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Service</li>
        <div class="ml-auto mr-0">
        </div>
    </ol>
</nav>
<div class="container-fluid">

<div class="row">

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Service</h4>
            <form method="POST" action="{{ route('causes.store') }}" id="CreateExpertise" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="label"> Title <span class="required">*</span></label>
                    <input type="text" name="label" value="{{  old('label') }}" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Service Title"  id="label" required/>
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="overview">Description</label>
                    <textarea name="overview" class="form-control" rows="4" placeholder="Description" id="textarea">{!! old('facility_description') !!}</textarea>
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

                <div class="form-group">
                    <label for="display_image">Display Image <span class="required">*</span></label>
                    <input type="file" name="display_image" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}"  id="display_image" required/>
                    @if ($errors->has('display_image'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('display_image') }}</strong>
                        </span>
                    @endif
                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>
</div>

@include('partials.summernote')

@endsection
@push('scripts')

<script>

    $(document).ready(function(){
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
