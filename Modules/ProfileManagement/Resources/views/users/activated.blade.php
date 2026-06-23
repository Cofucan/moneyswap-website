
@extends('layouts.signin')
@section('page_title', 'Welcome' . $user->Profile->full_name)
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

    <section class="login-body align-items-center">
      <div class="container px-3 py-4 mx-auto my-lg-5 mt-lg-5 align-items-center">
          <div class="row">
                  
              <div class="col-md-8 offset-md-2 card">
                  <div class="row justify-content-center my-auto">
                      <div class="col-md-9 col-10 px-3 py-3">
                          <div class="row justify-content-center px-3 mb-3">
                              <a href="{{ url('/') }}">  <img id="logo" src="{{asset('images/icons/logo.png')}}"></a>
                          </div>
                            
                            <h3 class="mt-5 mb-4 text-center heading text-uppercase">Email Verified successfully</h3>                               
                            <h5>Welcome on board, {{ $user->Profile->full_name }}</h5>
                            <p>Your account has been activated and you can now login to your {{ config('app.name') }} membership area. </p> 
                            <p class="mb-4">Thanks for being a part of our community.</p>
                            
                          <div class="bottom text-center">
                            <a class="btn btn-white ml-2" href="{{ url('login') }}">Login to get started</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </section>
  @endsection

