
@extends('layouts.admin')
@section('page_title', 'Create Organization')
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

        <a href="{{ url ('organizations/manage')}}" class="s-text16">
          Organizations
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Create Organization
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
      <h4 class="mb-5">Use the form below to add a new organisation</h4>

      <form action="{{ route('organizations.store') }}" method="POST" enctype="multipart/form-data" id="CreateOrganization">
        {{csrf_field()}}
        <div class="form-group">

            <label class="control-label" for="organization_name">Legal Name (required)&nbsp;<span class="requiredfield">*</span></label>
            <input type="text" class="form-control{{ $errors->has('organization_name') ? ' is-invalid' : '' }}" value="{{old('organization_name') }}" id="organization_name" name="organization_name" placeholder="Legal Name">

            @if ($errors->has('organization_name'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('organization_name') }}</strong>
              </span>
            @endif

        </div>

        <div class="form-row">
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label" for="trading_name">Trading Name</span></label>
            <input type="text" class="form-control" id="trading_name" name="trading_name" value="{{old('trading_name') }}"  placeholder="Enter Common Name">
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
            <label class="control-label">Reg Number</label>
            <input type="text" class="form-control{{ $errors->has('reg_number') ? ' is-invalid' : '' }}" id="reg_number" name="reg_number" placeholder="Enter Registration Number" value="{{old('reg_number') }}" >
            @if ($errors->has('reg_number'))
                <span class="invalid-feedback glyphicon glyphicon-remove">
                <strong>{{ $errors->first('reg_number') }}</strong>
                </span>
              @endif
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-6 form-group">
            <label for="industry_id">Industry <span class="required">*</span></label>
            <select class="custom-select d-block w-100 select2{{ $errors->has('industry_id') ? ' is-invalid' : '' }}"  name="industry_id" id="industry" required>
                    <option value=""> Select Industry</option>
                 @foreach($industries as $key => $industry)
                      @if(old('industry_id') == $key)
                        <option value="{{$key}}" selected> {{$industry}}</option>
                        @else
                        <option value="{{$key}}"> {{$industry}}</option>
                      @endif
                    @endforeach
            </select>
            @if ($errors->has('industry_id'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('industry_id') }}</strong>
                </span>
            @endif
          </div>
          <div class="col-md-6 form-group">
            <label>Official Logo</label>
            <input id="official_logo" type="file" class="form-control" name="official_logo">
            @if ($errors->has('official_logo'))
              <span class="invalid-feedback glyphicon glyphicon-remove">
              <strong>{{ $errors->first('official_logo') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
            <label>About Organisation</label>
            <textarea name="about_organization" class="resizable_textarea form-control" placeholder="Enter About Organisation">
                {!! old('about_organization') !!}
            </textarea>
            @if ($errors->has('about_organization'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('about_organization') }}</strong>
              </span>
          @endif
        </div>

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
