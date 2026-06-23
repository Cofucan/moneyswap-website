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


{{--  --}}

    <section class="section-padding">
      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="section-title mb-5">
                  <h4 class="section-header">{{ $page->headline }}</h4>
                </div>
                  <div class="mb-4">
                    <h6 class="mt-3 mb-3">Already a member? <a href="{{url('login')}}" class="text-danger  ml-2 text-underline"> <i class="fa fa-key">Sign in here</i> </a></h6>
                    {{-- <hr> --}}
                    <h5 class="text-uppercase mb-3"><b> Instructions:</b></h5>
                    {!! $page->body !!}
                    <hr>
                </div>


                  <div class="card form-card">
                    <div class="card-body px- py-4">
                      <form action="{{ route('members.signup') }}" method="POST" id="CreateInvestor" enctype="multipart/form-data">
                        {{csrf_field()}}

                        {{-- <h5>Login Information</h5>
                        <hr> --}}
                        <div class="row">
                          <div class="col-md-2 col-sm-5 mb-3">
                              <div class="text-center">
                                  <img src="{{ asset('img/upload-passport.jpg')}}" class="avatar img-circle img-thumbnail" alt="Upload Passport Photo">

                                  <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                              </div>
                          </div>
                          <div class="col-md-9 col-sm-7">
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
                                          <input type="date" name="birthday" value="{{old('birthday')}}" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"/>

                                      </div>
                                      @if ($errors->has('birthday'))
                                          <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('birthday') }}</strong>
                                          </span>
                                      @endif
                                    </div>
                                  </div>
                              </div>

                          </div>
                        </div>


                        <h5 class="title">Contact Details</h5>  <hr>
                        @include('locationmanagement::addresses._form')

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
                                    @foreach($telcodes as  $telcode)
                                    @if ($telcode->dialling_code == +234)
                                      <option value="{{$telcode->id}}" selected> <span class="fi fi-{{$telcode->code}} "> ({{$telcode->dialling_code}})</span> </option>
                                    @else
                                      <option value="{{$telcode->id}}"> <i class="fi fi-{{$telcode->code}} "></i> ({{$telcode->dialling_code}})</option>
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
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                                </div>

                            </div>
                        </div> --}}

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
