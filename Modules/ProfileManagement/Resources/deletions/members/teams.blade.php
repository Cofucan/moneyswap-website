@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

    @section('content')

<section class="set-bg page-banner" data-setbg="{{ asset('img/background/header-bg.jpg') }}">
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  
            
          </div>
      </div>
  </div>
</section>

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{$page->headline}}</h2>
        <p>{!!$page->body!!}</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        @foreach($members as $member)
            <div class="col-md-6 mb-5">
              <div class="team-member">
                <div class=" d-flex align-items-start">
                  <div class="pic">
                    <img src="{{asset($member->profile->avatar)}}" class="img-fluid" alt="">
                  </div>
                  <div class="staff-info">
                    <h4>{{$member->full_name}}</h4>
                    <span>{{$member->post}}</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter-x"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""> <i class="bi bi-linkedin"></i> </a>
                    </div>           
                  </div>
                </div>
                
                <p>{{$member->profile->bio}}</p> 
              </div>
            </div>

            
            @endforeach

         
        </div>

      </div>

    </section><!-- /Team Section -->


  

  @endsection

