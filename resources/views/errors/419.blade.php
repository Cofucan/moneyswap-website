@section('page_title', 'Time Out')
@extends('layouts.signin')
@push('styles')
<link href="{{ asset ('css/style.css')}}" rel="stylesheet">
@endpush

 
@section('content')

<section class="login-body d-flex align-items-center">
    <div class="container align-items-center px-3 py-4 mx-auto">
        <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center text-white mb-4">
                    <a href="{{ url('/') }}"> <img id="logo"  src="{{asset('img/login-logo.png')}}" alt="{{$portal->Organization->legal_name}}" title="{{$portal->Organization->legal_name}}" ></a>
                    
                </div>   
            </div> 
            <div class="card error4">
                    <div class="row justify-content-center my-auto px-5 py-4">
                        
                            <div class="col-md-6 error-details">
                                <h2 class="mt-5 pt-5"> SESSION EXPIRED </h2>
                                <h4>Please refresh and try again</h4>
                                <a class="btn btn-sm btn-secondary" href="{{ url('/') }}">Go Home</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/') }}"><img src="{{ asset ('img/419.png') }}" alt="Session has expired" class="feature-image"> </a>
                            </div>
                    
                    </div>
                </div>
        </div>
        </div>
    </div>
</section>

@endsection 