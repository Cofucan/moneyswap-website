
@extends('layouts.theme')
@section('page_title', 'Welcome' . $user->Profile->full_name)
@push('style')
<link href="{{ asset ('css/event.css')}}" rel="stylesheet">
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
@endpush



    @section('content')

<section id="general-hero" class="d-flex align-items-center">

  <div class="container text-center"> 
      <h1 class="p-t-20 p-b-20">Thank you for verifying your email</h1>
  </div>

</section>

    
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">
            
            <div class="col-md-12 new-user">
				
				<h4 class="mt-4">Welcome {{ $user->Profile->full_name }},</h4>
				<p>Your account has been activated and you can now login to your {{ config('app.name') }} to your profile. 
				</p> 
			
				<p class="mb-4">Thanks for being a part of our community.</p>
                <a href="{{url ('/login')}}" class="btn btn-succcess btn-mail">Login Now to get started</a>
                    <hr>                                              
                  
            </div>
              
        </div>
    </section>

  @endsection

 