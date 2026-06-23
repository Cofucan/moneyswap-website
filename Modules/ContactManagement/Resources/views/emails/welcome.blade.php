
@extends('layouts.theme')
@section('page_title', 'Welcome' . $user->full_name)
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

    <section class="bg-title-page p-t-100 p-b-50 flex-col-c-m" style="background-image: url({{ asset ('images/welcome.jpg')}});">
		<h2 class="xl-text4 t-center">
				Welcome {{ $user->full_name }},
			</h2>
	</section>
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">
            
            <div class="col-md-12 new-user">
				
				<h4 class="mt-4">Thank you verifying your email</h4>
				<p>Your account has been activated and you can now login to your {{ config('app.name') }} membership area to submit your order. 
				</p> 
				<p> Your membership details including the referral Code has been sent to your email. Please check your junk mail folder if you cant find an email from us in your inbox </p>
				<p class="mb-4">Thanks for being a part of our community.</p>
                <a href="{{url ('/login')}}" class="btn btn-succcess btn-mail">Login to get started</a>
                    <hr>                                              
                  
            </div>
              
        </div>
    </section>
	{{--  @include('partials.valueadded')  --}}
  @endsection

