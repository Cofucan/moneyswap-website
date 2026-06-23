@section('page_title', $state->state_name)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<!-- <link href="{{ asset ('css/util.css') }}" rel="stylesheet"> -->
@endpush

@section('content')

<section class="set-bg page-banner parallax" data-setbg="{{ asset($state->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  
            
          </div>
      </div>
  </div>
</section>

 <!-- ======= Breadcrumbs ======= -->
 <div id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>{{$state->state_name}}</li>
        </ol>
        <h2>{{$state->state_name}}</h2>

      </div>
</div><!-- End Breadcrumbs -->
  <!-- ======= About Section ======= -->
  <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        

        <div class="row content">
         
        
          <div class="col-lg-6 pt-4 pt-lg-4">
            <div class="section-title">
              <h2>{{$state->state_name}}</h2>
              <p>{{$state->slogan}}</p>
            </div>
            <p class="text-justify">{!! $state->about_state !!}</p>

          </div>
         
          <div class="col-lg-6 align-items-stretch video-box set-bg" data-setbg="{{asset($state->Governor->passport)}}"  data-aos="zoom-in" data-aos-delay="100">
          
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>PROJECTS</h2>
          <p>Projects</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{asset('img/portfolio/abia.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Infrastructure</p>
              <a href="{{asset('img/portfolio/abia.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{asset('img/portfolio/agric.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Agricultural</p>
              <a href="{{asset('img/portfolio/agric.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{asset('img/portfolio/landmark.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Land</p>
              <a href="{{asset('img/portfolio/landmark.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{asset('img/portfolio/property.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Property</p>
              <a href="{{asset('img/portfolio/property.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{asset('img/portfolio/southeast.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Road</p>
              <a href="{{asset('img/portfolio/southeast.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{asset('img/portfolio/waterproject.jpg')}}" class="img-fluid gallery-thumb" alt="">
            <div class="portfolio-info">
              <p>Water Project</p>
              <a href="{{asset('img/portfolio/waterproject.jpg')}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->


    
 <!-- ======= Cta Section ======= -->

 @include('partials.cta')

<!-- End Cta Section -->
    
  @endsection
 



