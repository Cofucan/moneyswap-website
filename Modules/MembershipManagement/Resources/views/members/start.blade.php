@section('page_title', 'Become A Member')
@extends('layouts.theme')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/util.css') }}">
<style>
        #state_loading{
        visibility:hidden;
        }
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
        #plan_loading{
            visibility:hidden;
        }
</style>

@endpush


@section('content')

    <section class="section-padding">
      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="section-title mb-5">
                  <h4 class="section-header">{{ $page->headline }}</h4>
                </div>
                  <div class="mb-4">
                    <h6 class="mt-3 mb-3">Already has an account? <a href="{{url('login')}}" class="text-danger  ml-2 text-underline"> <i class="fa fa-key">Sign in here</i> </a></h6>
                    {{-- <hr> --}}
                    <h5 class="text-uppercase mb-3"><b> Instructions:</b></h5>
                    {!! $page->body !!}
                    <hr>
                </div>


                  <div class="card form-card">
                    <div class="card-body px- py-4">
                      <form action="{{ route('members.store') }}" method="POST" id="CreateMember" enctype="multipart/form-data">
                        {{csrf_field()}}

                        {{-- <h5>Login Information</h5>
                        <hr> --}}
                        <div class="row">
                          <div class="col-md-12">
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
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="birthday">Date of Birth</label>
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                          <input type="date" name="birthday" value="{{old('birthday')}}" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" min='1899-01-01' max="2015-01-01"/>

                                      </div>
                                      @if ($errors->has('birthday'))
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('birthday') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="occupation">Occupation</label>
                                      <input type="text" name="occupation" value="{{old('occupation')}}" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" min='1899-01-01' max="2015-01-01"/>


                                      @if ($errors->has('occupation'))
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('occupation') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>
                              </div>

                          </div>
                          {{-- <div class="col-md-2 col-sm-5 mb-3">
                              <div class="text-center">
                                  <img src="{{ asset('img/upload-passport.jpg')}}" class="avatar img-circle img-thumbnail" alt="Upload Passport Photo">

                                  <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                              </div>
                          </div> --}}
                        </div>


                        <h5 class="title">Contact Details</h5>  <hr>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="address_no" class="control-label">Ref</label>
                                <div class="input-group">
                                  <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                    <select class="custom-select w-100 select2" id="address_prefix" name="address_prefix">
                                        @foreach($addressPrefix as $address_prefix)
                                                @if(old('address_prefix') == $address_prefix)
                                                    <option value="{{  $address_prefix }}" selected>{{  $address_prefix }}</option>
                                                @else
                                                    <option value="{{  $address_prefix }}">{{  $address_prefix }}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                  </div>
                                  <input type="text" name="address_no" value="{{old ('address_no') }}" class="form-control{{ $errors->has('address_no') ? ' is-invalid' : '' }}" id="address_no" placeholder="123/456" >
                                </div>
                                @if ($errors->has('address_no'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('address_no') }}</strong>
                                  </span>
                                @endif
                            </div>
                          </div>

                          <div class="col-md-9 mb-3">
                            <div class="form-group">
                              <label for="street_name" class="control-label">Street Name</label>
                              <input type="text" name="street_name" value="{{ old('street_name') }}" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" id="street_name" placeholder="e.g. John Adamu Ola Avenue" >
                              @if ($errors->has('street_name'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('street_name') }}</strong>
                              </span>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <select id="country_id" name="country_id" class="select2 w-100 form-control" title="Please select a cause ...">
                                      <option value=""> Choose Country </option>
                                      @foreach($countries as $country)
                                          @if(old('country_id') == $country->id)
                                              <option value="{{$country->id}}" selected>  {{ $country->label }} </option>
                                              @else
                                              <option value="{{$country->id}}">  {{ $country->label }} </option>
                                          @endif
                                      @endforeach
                                  </select>
                                      @if ($errors->has('country_id'))
                                          <span class="invalid-feedback">
                                          <strong>{{ $errors->first('country_id') }}</strong>
                                          </span>
                                      @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" name="state_name" value="{{  old('state_name') }}" class="form-control{{ $errors->has('state_name') ? ' is-invalid' : '' }}" placeholder="Enter State"  id="state_name"/>
                                      @if ($errors->has('state_name'))
                                          <span class="invalid-feedback">
                                          <strong>{{ $errors->first('state_name') }}</strong>
                                          </span>
                                      @endif
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                              <input type="text" name="city_name" value="{{  old('city_name') }}" class="form-control{{ $errors->has('city_name') ? ' is-invalid' : '' }}" placeholder="Enter city"  id="city_name"/>
                                  @if ($errors->has('city_name'))
                                      <span class="invalid-feedback">
                                      <strong>{{ $errors->first('city_name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                        </div>

                        <div class="form-row mt-3">
                          <div class="col-md-6">
                            <div class="form-group">
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
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="telephone">Telephone</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <select id="country_code" name="country_code" class="select2 w-100 " data-live-search="true" title="Please select a country_code ...">
                                    @foreach($countries as $country)
                                      <option value="{{$country->dialling_code}}"> {{$country->dialling_code}}</option>

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
                        </div>


                        <hr class="mb-4">
                        <button class="btn btn-primary" type="submit" name="status" value="Draft">continue</button>
                        {{-- <button class="btn btn-success" type="submit" name="status" value="Scheduled">Schedule </button> --}}
                      </form>
                    </div>

                    </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  @endsection
  @push('scripts')
  <script src="{{ asset('js/select2.js')}}" defer></script>
  <script>
    jQuery(document).ready(function($) {
      var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });

  </script>
@endpush
