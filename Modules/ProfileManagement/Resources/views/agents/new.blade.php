
@extends('layouts.admin')
@section('page_title', 'Add Agent')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

  <nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('agents/home') }}">Agents</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add</li>
    </ol>
  </nav>
  <div class="row">

    <div class="col-md-8 order-md-1">
      <h4 class="mt-3">Update Your Personal Details</h4>
      <h5 class="mt-3">Tell us moreabout you <br>
      <small>All fields marked (<span class="text-danger">*</span>) are compulsory</small>
      </h5>
      <hr>
      <form action="{{ route('agents.make') }}" method="POST" enctype="multipart/form-data" id="CreateAgent">
        {{csrf_field()}}
        <input type="hidden" id="profile_id" name="profile_id" value="{{ $profile->id}}">
        @include('profilemanagement::profiles._formedit')

        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="occupation">What is your Occupation</label>
              <input type="text" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" id="occupation" name="occupation" placeholder="" value="{{old('occupation') }}">
              @if ($errors->has('occupation '))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('occupation ') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="income" class="label-control">Annual Income</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">NGN</div>
                </div>
                <input type="text" value="{{old('income') }}" class="form-control{{ $errors->has('income') ? ' is-invalid' : '' }}" id="income" name="income" placeholder="Annual Income" value="{{old('occupation') }}">
              </div>

              @if ($errors->has('income'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('income') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>


        <hr>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

              <button type="submit" class="btn btn-success">Save and close</button>
              <button class="btn btn-primary" type="submit" name="todo" value="Continue">Save & Add New</button>

            </div>
          </div>

      </form>
    </div>
  </div>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection

