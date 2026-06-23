@extends('layouts.admin')
@section('pagetitle', 'Add City')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content') 

<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          

          
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Edit City</h4>
          <form action="{{ url('cities') }}" method="POST"  id="CreateCity" novalidate>
          {{csrf_field()}}

             
            <div class=" row">
                    <div class="col-md-6 col-sm-6 col-xs-12 mb-3 form-group has-feedback">
                      <label for="state_id" > State (required)&nbsp;
                        <span class="requiredfield">*</span>
                      </label>
                        <select value="{{old('state_id') }}" class="form-control{{ $errors->has('state_id') ? ' is-invalid' : '' }} select2"  data-placeholder="Select State" name="state_id" id="state" required="true" >
                          
                        @foreach($states as $key => $state) 
                  <option value="{{$key}}"> {{$state}}</option> 
                @endforeach      
                        </select>
                        @if ($errors->has('state_id'))
                          <span class="invalid-feedback fa fa-map form-control-feedback right">
                          {{ $errors->first('state_id') }}
                          </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 mb-3 form-group has-feedback">
                      <label for="city_code">City Code (required)&nbsp;
                        <span class="requiredfield">*</span>
                      </label>
                      <input type="text" class="form-control{{ $errors->has('city_code') ? ' is-invalid' : '' }}" value="{{old('city_code') }}" id="city_code" name="city_code" placeholder="Enter City Code" value="{{old('city_code') }}"  required="true" >
                        @if ($errors->has('city_code'))
                          <span class=" error text-center alert alert-danger">
                          {{ $errors->first('city_code') }}
                          </span>
                        @endif
                    </div>
              
            </div>

            <div class="row">
                  <div class=" col-xs-12 col-sm-12 col-md-12 mb-3 form-group has-feedback">
                    <label for="city_name">City Name (required)&nbsp;
                      <span class="requiredfield">*</span>
                    </label>
                    <input value="{{old('city_name') }}" type="text" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" id="city_name" name="city_name" placeholder="City Name"  required="true">                      
                      @if ($errors->has('city_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('city_name') }}</strong>
                        </span>
                      @endif
                  </div>
            </div>
           
              <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12 mb-3 form-group has-feedback">
                    <label for="latitude">Latitude </label>
                    <input type="text" class="form-control" id="latitude" value="{{old('latitude') }}" name="latitude" placeholder="Latitude">
                    @if ($errors->has('latitude'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('latitude') }}</strong>
                        </span>
                      @endif
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12 mb-3 form-group has-feedback">
                    <label for="longitude">Longitude</label>
                      <input type="text" class="form-control" id="longitude" value="{{old('longitude') }}" name="longitude" placeholder="Enter Longitude">
                      @if ($errors->has('longitude'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('longitude') }}</strong>
                        </span>
                      @endif
                  </div>
              </div>
                       
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 mb-3 form-group has-feedback">
                    <label for="about_city">About City</label>
                    <textarea name="about_city" class="form-control" value="{{old('about_city') }}" placeholder="City Overview" id="about_city"></textarea>
                    @if ($errors->has('about_city'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('about_city') }}</strong>
                        </span>
                      @endif
                    </div>       
              </div>
            

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Submit </button>
            <button class="btn btn-primary" type="reset">Reset</button>
            
          </form>
        </div>  
</div>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CityRequest', '#CreateCity'); !!}
@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script>
      $(document).ready(function(){
          $('#state').select2();
       });
    </script>

@endpush

