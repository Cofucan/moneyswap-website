@section('page_title', 'New Volunteer')
@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link href="{{ asset ('css/admission.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
  <style>
      .form-group{
        margin-bottom: 30px;
      }
</style>

@endpush


@section('content')



   <!--==========================
      Intro Section
    ============================-->
    <section id="admission">
        <div class="container-fluid">
            <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
                <a href="{{ url ('home')}}" class="s-text16">
                  <i class="fa fa-home"></i> Dashboard
                  <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
        
                <a href="{{ url ('volunteers/manage')}}" class="s-text16">
                  Investments
                  <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
        
                <span class="s-text17">
                 new Volunteer
                </span>
            </div>
        
          <div class="row">
            <div class="col-md-7 mt-4">

              
                <form method="POST" action="{{ route('volunteers.store') }}" id="CreateInvestment">
                    {{csrf_field()}}
                    <h6>Personal Details</h6>
                    <hr>
                    <div class="form-row">
                      <div class="col-md-4 mb-3 form-group">
                          <label class="control-label" for="Last Name"> Name </label>
                          <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" name="first_name" placeholder="First Name" required >
                          @if ($errors->has('first_name'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('first_name') }}</strong>
                              </span>
                          @endif       
                      </div>
                  
                      <div class="col-md-4 mb-3 form-group">
                          <label class="control-label text-white" for="first"> . </label>
                          <input id="last_name" type="text" value="{{ old('last_name') }}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" placeholder="Last Name" required >
                          @if ($errors->has('last_name'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                              </span>
                          @endif
                      </div>
                  
                      <div class="col-md-4 mb-3 form-group">
                              <label class="control-label text-white" for="middle_name"> . </label>
                              <input id="middle_name" type="text" value="{{ old('middle_name') }}" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" placeholder="Middle Name">
                  
                          @if ($errors->has('middle_name'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('middle_name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="col-md-6 form-group mb-3">
                          <label for="email">{{ __('E-Mail Address') }}</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                              </div>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                          </div>
                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="col-md-6 form-group mb-3">
                          <label for="telephone">Telephone</label>
                          <div class="input-group">
                              <div class="input-group-append">
                                  <select id="country_code" name="country_code" class="custom-select w-100 select2" data-live-search="true" title="Please select a country_code ...">
                                  @foreach($telcodes as $key => $telcode)
                                  @if ($telcode == 234)
                                  <option value="{{$telcode}}" selected> {{$telcode}}</option>
                                  @else
                                  <option value="{{$telcode}}"> {{$telcode}}</option>
                                  @endif
                                  @endforeach
                                  </select>
                              </div>
                              <input type="text" id="telephone" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" placeholder="Mobile Telephone Number" required>
                          </div>
                          @if ($errors->has('telephone'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('telephone') }}</strong>
                                  </span>
                              @endif
                      </div>  
                  </div>
                   

                    <h6 class="mt-3">Contact Address</h6>
                    <hr>        
                    @include('locationmanagement::addresses._form') 
                    
                    <h6 class="mt-3">Your Volunteer</h6>
                    <hr>   
                    @include('humanresources::volunteers._form')

                    <hr>
                    <div class="row">
                        <div class="col-md-3 col-sm-4 offset-md-9">
                            <button class="btn btn-primary btn-block" type="submit">Invest</button>
                            <!-- <button type="submit" class="btn btn-primary btn-sm btn-block pul-right">{{ __('Proceed to Payment') }}</button> -->
                        </div>
                    </div>
                </form>
            </div>

    </section>

  @endsection
  @push('scripts')

 
  <script src="{{ asset('js/select2.full.min.js')}}"></script>


@endpush
