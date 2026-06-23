@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<!-- <link href="{{ asset ('css/util.css') }}" rel="stylesheet"> -->
@endpush

@section('content')
<!-- 
<section class="set-bg page-banner parallax" data-setbg="{{ asset('img/background/header-bg.jpg') }}">
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  
            
          </div>
      </div>
  </div>
</section> -->

<section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
            <h1 class="mt-5 mb-5 text-white">{{$page->headline}}</h1>
                  
            
          </div>
      </div>
  </div>
</section>

<!-- <div class="page-title mt-5" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="current">About Us</li>
          </ol>
        </nav>
        <h1>{{$page->headline}}</h1> 
      </div>
    </div>
-->
    <!-- Why Us Section -->
    <section id="why-us" class="section why-us" data-builder="section">

      <div class="container">

        <div class="row">

          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content" data-aos="fade-up" data-aos-delay="100">
              <h3>{{$page->headline}}</h3>
              {!!$page->body!!}
            </div>

            

          </div>

          <div class="col-lg-6 order-1 order-lg-2 why-us-img">
            <img src="{{asset($page->thumbnail)}}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section>



 <!-- Team Section -->
 <section id="team" class="team section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>OUR TEAM</h2>
  <!-- <p>{!!$page->body!!}</p> -->
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

  @foreach($employees as $employee)
      <div class="col-md-6 mb-5">
        <div class="team-member">
          <div class=" d-flex align-items-start">
            <div class="pic">
              <img src="{{asset($employee->profile->avatar)}}" class="img-fluid" alt="">
            </div>
            <div class="staff-info">
              <h4>{{$employee->staff_name}}</h4>
              <span>{{$employee->position}}</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""> <i class="bi bi-linkedin"></i> </a>
              </div>           
            </div>
          </div>
          
          <p>{{$employee->profile->bio}}</p> 
        </div>
      </div>

      
      @endforeach

   
  </div>

</div>

</section><!-- /Team Section -->

<!-- End Cta Section -->
    
  @endsection
 



