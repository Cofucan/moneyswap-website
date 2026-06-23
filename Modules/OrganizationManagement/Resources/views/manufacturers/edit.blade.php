
@extends('layouts.admin')
@section('page_title', $merchant->Organization->organization_name)
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')
<div class="container">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('merchants/manage')}}" class="s-text16">
         Merchants
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Editing 
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

      <form action="{{ route('merchants.update', $merchant->id) }}" method="POST"  id="UpdateBank" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('PUT')
          <div class="form-group mb-4">

              <label class="control-label" for="merchant_code">Merchant Code</label>
              <input type="text" class="form-control{{ $errors->has('merchant_code') ? ' is-invalid' : '' }}" value="{{$merchant->merchant_code}}" id="merchant_code" name="merchant_code" placeholder="Enter Merchant Code">
              <input type="hidden" value="{{$organization->industry_id}}" id="industry_id" name="industry_id">
              @if ($errors->has('merchant_code'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('merchant_code') }}</strong>
                </span>
              @endif

          </div>

          @include('organizations._formedit')
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
