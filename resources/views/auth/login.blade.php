@extends('layouts.signin')

@section('content')

<section class="login-body d-flex align-items-center ">
<div class="container d-flex align-items-center px-3 py-4 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right text-white">
                    <h3 class="text-white">{{ $instruction->headline }}</h3>
                    {!! $instruction->body !!}
                </div>
            </div>
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-9 col-10 my-3">
                        <div class="row justify-content-center px-3 mb-3">
                            <a href="{{ url('/') }}">  <img id="logo" src="{{asset('img/login-logo.png')}}"></a>
                        </div>
                        <h3 class="mt-4 text-center heading">Sign in</h3>
                        {{-- <h6 class="msg-info">Please login to your account</h6> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-control-label text-muted">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>


                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>


                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

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

                                    <!-- <div class="col-md-5 text-right">
                                           <a href="{{url('register')}}" class="btn btn-sm btn-warning btn-block"> Create Account</a>
                                    </div> -->
                                </div>


                    </form>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
