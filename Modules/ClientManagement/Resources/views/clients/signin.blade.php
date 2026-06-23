@section('page_title', "Client Portal")
@extends('layouts.sign-in')
@push('style')
<link href="{{ asset ('css/client-login.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">

@endpush


@section('content')


  <!--==========================
      What We Do Section
    ============================-->
    <div class="main">
      <header>
        <div class="container">
          <div class="row">
            <div class="col-md-4 offset-md-4">
              <div class="header">
                <a class="navbar-brand" href="{{url('/')}}" >
                    <img src="{{ asset($portal->Organization->official_logo) }}" alt="{{ $portal->Organization->legal_name }}"/>
                  </a>
              </div>
            </div>
          </div>

        </div>
      </header>


      <div class="container-fluid">
        <div class='row'>
          <div class="col-md-5 col-sm-7 order-md-2">
            <div class='html5clientOnly'>
              <div class='join-meeting '>
                <h4>Signin with Your Details</h4>
                @include('partials.alert')
                <form method="POST" action="{{ route('clients.portal') }}" id="StudentCheckin">
                    {{csrf_field()}}
                    <div class="form-group">
                      <label for="student_code" class="text-left"> Client No</label>
                      <input type="text" name="student_code" value="{{old('student_code')}}" class="form-control {{ $errors->has('student_code') ? ' is-invalid' : '' }}" placeholder="Enter Admission Number"  id="student_code"/>
                      @if ($errors->has('student_code'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('student_code') }}</strong>
                          </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label text-left" for="birthday">Birth Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }} pull-right" name="birthday" id="birthday" value="{{old ('birthday')}}">
                        </div>

                        @if ($errors->has('birthday'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                </div>
                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Sign In </button>
                </form>



              </div>
            </div>

          </div>
          <div class="col-md-6 col-sm-7 order-md-1 order-sm-1">
            <div class='overview'>
              <h4> {{$page->headline}}</h4>

            <p class="text-justify">
              {!! $page->body !!}
            </p>



              <!-- <p> For more information visit our <a href="https://bigbluebutton.org/">website</a>, <a href="https://docs.bigbluebutton.org/">documentation</a>, and <a href="https://demo.bigbluebutton.org/">demo server</a>.</p> -->
            </div>

          </div>
      </div>
      </div>

    </div>









  @endsection
  @push('script')
  <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
    jQuery(document).ready(function($) {
      $('input[name="birthday"]').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          timePicker: false,
          locale: {
          format: 'YYYY-MM-DD'
          }
      });
    });
  </script>



  @endpush
