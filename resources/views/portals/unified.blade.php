@section('page_title', "Unified Portal")
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
@endpush


@section('content')

<section id="page-image">
    <img class="d-block w-100" src="{{ asset ('img/parent-portal.jpg') }}" alt="parent Portal">
 </section>


  <!--==========================
      What We Do Section
    ============================-->

        <div class="container p-t-20 p-b-20">
            <div class="row">
                <div class="col-md-7 ">

                    <h6 class="line mb-4">Welcome to {{ config('app.name')}} Portal</h6>
                    <p class="text-primary"> 
                        <b>
                            A simplified dashboard to view announcements, upcoming events, assessment results, birthdays, 
                            send revenue notice or make secured online revenue.</b>
                    </p>
                    <p class="text-justify">
                        To use this site you will need to first register then you can perform and view tasks associated wtih your user profile.
                        Please ensure you use a valid email address as you will have to validate your account in order for you to complete your registration.

                    </p>
                    <hr>
                    <p class="m-t-10">If you already have an account but cannot remember your password please click on the ‘forgotten your password?’ to initiate a password reset. If you do not receive a password reset email, please contact the support team or use the chat snippet to get help.</p>
                    <!-- <hr> -->

                    <hr>


                </div>
                <div class="col-md-4 offset-md-1 m-t-15 side-menu">

                    <div class="card ">
                        <div class="card-header">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body p-l-10">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
    
                                <div class="form-group row">
                                    @if(Request::has('previous'))
                                    <input id="previous" type="hidden" name="previous" value="{{ Request::get('previous') }}" >
                                    @else
                                    <input id="previous" type="hidden" name="previous" value="{{ URL::previous() }}" >
                                    @endif
                                </div>
    
                                
    
                                    <div class="form-row">
                                        <div class="col-md-12 form-group">
                                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                        
                                        </div>
    
                                        <div class="col-md-12 form-group">
                                            <label for="password" class="control-label">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
    
                                    <div class="form-row">
                                        <div class="col-md-6 m-l-20 form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
    
                                        
                                        <div class="col-md-3 offset-md-2 text-right">
                                            <button type="submit" class="btn btn-primary btn-sm btn-block">
                                                {{ __('Login') }}
                                            </button>
    
                                      
                                        </div>
    
                                    </div>
                                <hr>
    
                                <div class="form-row p-t-5">
                                    <div class="col-md-7">
                                        <a  href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
    
                                    <div class="col-md-5 text-right">
                                           <a href="{{url('register')}}" class="btn btn-sm btn-warning btn-block"> Create Account</a>
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>

                </div>
            </div>
        </div>


      @include('partials.admission')


  @endsection
  @push('script')


  @endpush
