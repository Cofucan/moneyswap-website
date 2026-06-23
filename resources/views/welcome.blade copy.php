@extends('layouts.theme')
@section('page_title', $portal->slogan)
@push('styles')
@endpush
@section('content')
<!-- Hero Section Begin -->
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">
      @foreach ($slides as $slider)
         @if($loop->first)
        <div class="carousel-item active set-bg" data-setbg="{{ asset($slider->display_media) }}" >
          <div class="carousel-container">
            <div class="container"> 
              <h2 class="animate__animated animate__fadeInDown">{!! $slider->caption !!}</h2>
              <p class="animate__animated animate__fadeInUp">{!! $slider->highlight !!}</p>
              @if (!is_null($slider->button_one_link))
              <a href="{{ url($slider->button_one_link) }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">{{ $slider->button_one }}</a>
              <!-- <a href="" class="primary-btn"></a> -->
              @endif
             
            </div>
          </div>
        </div>
        @else
        <div class="carousel-item set-bg" data-setbg="{{ asset($slider->display_media) }}" >
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">{!! $slider->caption !!}</h2>
              <p class="animate__animated animate__fadeInUp">{!! $slider->highlight !!}</p>
              @if (!is_null($slider->button_one_link))
              <a href="{{ url($slider->button_one_link) }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">{{ $slider->button_one }}</a>
              <!-- <a href="" class="primary-btn"></a> -->
              @endif
             
            </div>
          </div>
        </div>
        @endif
      @endforeach
        <!-- Slide 1 -->
      

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

<!-- ======= About Us Section ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="row no-gutters">
      <div class="col-lg-6 video-box">
        <img src="{{asset($portal->Organization->Page->thumbnail)}}"class="img-fluid" alt="">
      </div>

      <div class="col-lg-6 d-flex flex-column justify-content-center about-content">   
       <div class="title">
         <h2 class="text-left">{{ $portal->Organization->Page->headline }}</h2>
         {!! $portal->Organization->Page->summary !!}
         <p class="mt-4">
          <a href="{{url ('/page/about')}}" class="btn get-started-btn">About Us</a>
          <a href="{{url ('/contactus')}}" class="btn primary-btn px-3 mr-3">Contact Us</a>
        </p>
       </div>
         

       
      </div>
    </div>

  </div>
</section><!-- End About Us Section -->

<!-- ======= About Lists Section ======= -->

<section class="parallax-bg section-padding set-bg" data-setbg="{{ asset('img/background/parralax-bg.jpg') }}">
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center ">
        <div class="info-box mb-lg-0 ">
          <h4>Vision</h4>
          <p>{{$portal->Organization->vision}}</p>
        </div>
      </div>
     
      <div class="col-md-4 text-center ">
        <div class="info-box mb-lg-0">
          <h4>Mission</h4>
          <p>{{$portal->Organization->mission}}</p>
        </div>
      </div>

      <div class="col-md-4 text-center ">
        <div class="info-box mb-lg-0">
          <h4>Core Values</h4>
          <p>{{$portal->Organization->core_values}}</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="">
  <div class="container">

    <div class="section-title">
      <h2>Our Services</h2>
    </div>
    <div class="row">
        @foreach($expertises as $expertise)
        <div class="col-lg-4 col-md-6" data-aos="fade-up">
          <div class="service-item">
            <img src="{{asset ($expertise->thumbnail)}}" class="img-fluid" alt="">
              <div class="item-content">            
                <h5>{{$expertise->label}}</h5>
                <p class="text-justify">{!! $expertise->summary!!}</p>
                <a href="{{ url('expertise', $expertise->slug)}}" class="btn btn-danger btn-sm px-3"><i class="bi-arrow-right"></i> More </a>
              </div>
            </div>
        </div>
        @endforeach    

     

    </div>

  </div>
</section>

<!-- End About Lists Section -->



<!-- ======= Services Section ======= -->
{{--<section id="services" class="services">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Who we Serve</h2>
    </div>

    <div class="row">
    @foreach ($industries as $industry)      
      <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
        <div class="icon-img">
          <img src="{{ asset ($industry->icon) }}" alt="" class="icon-lg">
        </div>
        <h4 class="title"><a href="{{ url('industry', $industry->slug) }}">{{ $industry->label }}</a></h4>
        <p class="description">{!! $industry->short_summary !!}</p>
      </div>
  @endforeach
  </div>
</section><!-- End Services Section -->--}}



<!-- <section class="services">
  <div class="container">

  <div class="section-title">
      <h2 class="">Why work with us</h2>
    </div>

    <div class="row">

    <div class="row">
    @foreach ($advantages as $advantage)      
      <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
        <div class="icon-img">
          <img src="{{ asset ($advantage->display_image) }}" alt="" class="icon-lg">
        </div>
        <h4 class="title">{{ $advantage->label }}</h4>
        <p class="description">{!! $advantage->overview !!}</p>
      </div>
  @endforeach
  </div>

  </div>
</section> -->

<section class="cta section-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="section-title text-left">
          <h2 class="">Join the list of our growing list of certified clients</h2>
        </div>
      </div>
      <div class="col-md-2 offset-md-3">      
        <a href="{{url ('/page/about')}}" class="btn get-started-btn btn-block mb-3">About Us</a>
        <a href="{{url ('/contactus')}}" class="btn primary-btn btn-block px-3 mr-3">Contact Us</a>        
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

@endsection


@push('scripts')
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/custom.js')}}" defer></script>
@endpush