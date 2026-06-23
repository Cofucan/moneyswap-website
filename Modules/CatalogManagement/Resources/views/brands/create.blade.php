
@extends('layouts.admin')
@section('page_title', 'Create Brand')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('banks/manage')}}" class="s-text16">
          Brands
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
         Add Brand
        </span>
      </div>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Information</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-5">Use the form below to add a new supplier</h4>

      <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" id="CreateBank">
        {{csrf_field()}}
        <input type="hidden" value="2" id="industry_id" name="industry_id">
        <div class="form-group mb-4">

            <label class="control-label" for="supplier_code">Brand Code</label>
            <input type="text" class="form-control{{ $errors->has('supplier_code') ? ' is-invalid' : '' }}" value="{{old('supplier_code') }}" id="supplier_code" name="supplier_code" placeholder="Enter Brand Code">

            @if ($errors->has('supplier_code'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('supplier_code') }}</strong>
              </span>
            @endif

        </div>

        @include('organizations._form')
        <hr>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">


              <button type="submit" class="btn btn-success">Save and close</button>
              <button class="btn btn-primary" type="reset">Cancel</button>

            </div>
          </div>

      </form>
    </div>
  </div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection
@push('scripts')
<!-- Select2 -->
<script>
    CKEDITOR.replace( 'about_organization' );
</script>


@endpush
