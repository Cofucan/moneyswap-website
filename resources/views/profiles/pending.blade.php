@extends('layouts.signin')
@section('page_title', $page->headline)
@section('content')

<section class="login-body align-items-center">
<div class="container px-3 py-4 mx-auto my-lg-5 mt-lg-5 align-items-center">
    <div class="row">
            
        <div class="col-md-8 offset-md-2 card">
            <div class="row justify-content-center my-auto">
                <div class="col-md-9 col-10 px-3 py-3">
                    <div class="row justify-content-center px-3 mb-3">
                        <a href="{{ url('/') }}">  <img id="logo" src="{{asset('img/logo/logo2.png')}}"></a>
                    </div>
                    
                   
                        @if ($profile->status == 'Rejected')
                            <h3 class="mt-5 mb-4 text-center heading text-uppercase">Attention Required </h3>
                         
                                @include('objections._form')
                        @else  
                            <h3 class="mt-5 mb-4 text-center heading text-uppercase">{{ $page->headline }}</h3>                               
                            <h5>Welcome on board, {{ $profile->full_name }}</h5>
                            {!! $page->body !!} 
                        @endif
                     
                   
                    <div class="bottom text-center">
                      <a class="btn btn-white ml-2" href="{{ url('/') }}">Home</a> 
                      <a class="btn btn-white ml-2" href="{{ url('contactus') }}">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
