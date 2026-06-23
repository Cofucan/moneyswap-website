@extends('layouts.signin')

@section('content')

<section class="login-body d-flex align-items-center ">
<div class="container d-flex align-items-center px-3 py-4 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">

            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-9 col-10 my-3">
                        <div class="row justify-content-center px-3 mb-3">
                            <a href="{{ url('/') }}">  <img id="logo" src="{{asset('img/login-logo.png')}}"></a>
                        </div>
                        <h4 class="mt-5 text-center heading"> <b>{{ __('You Need to Verify Your Email Address') }}</b></h4>

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif

                     <p href="#" class="sm-text text-center mx-auto mb-3">

                        {{ __('An activation email has been sent to your email box, kindly login to your email box and click the activation link to verify your email address.') }}
                        <p> </p>
                        {{ __('If you did not receive the email') }},
                        {{ __('do check your junk/spam folder if its not in your inbox or ') }},

                        <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-white ml-2">{{ __('click here to request another') }}</button>.
                        </form>
                    </p>

                    <br>



                    </div>

                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white mb-4">Need Help?</h3>
                     <!--<p class="text-white">Pay. Get paid.  Share. Join more than 70 million people who use the Venmo app. </p>-->
                    <h5 class="text-white ">  <i class="fa fa-phone-square pr-3"></i>: {{ $portal->telephone }}</h5>
                    <h5 class="text-white"> <i class="fa fa-envelope-square pr-3"></i> {{ $portal->email }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
