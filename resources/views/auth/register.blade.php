@extends('layouts.signin')

@section('content')

<section class="login-body d-flex align-items-center">
<div class="container px-3 py-4 mx-auto d-flex align-items-center">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5">
                    <h3 class="text-white">{{$instruction->headline}}</h3>
                    <div class="text-white">
                    {!!$instruction->body!!}
                    <div class="bottom text-center">
                        <p href="#" class="sm-text mx-auto mb-3">Already have an account?<a class="btn btn-white ml-2" href="{{ url('login') }}">Sign-in</a></p>
                    </div>
                    </div>

                </div>
            </div>
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-9 col-10">
                        <div class="row justify-content-center px-3 mb-3">
                            <a href="{{ url('/') }}">  <img id="logo" src="{{ asset('img/login-logo.png') }}"></a>
                        </div>
                        <h3 class="mt-4 mb-4 text-center heading">Let's Meet You</h3>
                         <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label text-muted">Tell us who you are</label>
                            <select id="role_id" name="role_id" class="select2 w-100 form-control" data-live-search="true" title="Please select your role ...">
                            @foreach($roles as $key => $role)
                            <option value="{{$key}}"> +{{$role}}</option>
                            @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-muted">First Name</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Last Name</label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label class="form-control-label text-muted">Telephone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select id="dialling_code" name="dialling_code" class="select2 w-100 " data-live-search="true" title="Please select a country telephone code ...">
                                    @foreach($dialingcodes as $dialingcode)
                                    <option value="{{$dialingcode}}"> +{{$dialingcode}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required>
                            </div>
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        {!!getCaptchaBox()!!}
                        </div>

                         <div class="row justify-content-center">
                             <button class="btn-block btn-color"> {{ __('Sign Up') }}</button>
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
@push('scripts')
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script>
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>

@endpush
