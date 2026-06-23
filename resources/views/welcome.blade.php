@extends('layouts.theme')
@section('page_title', $portal->slogan)
@push('styles')
@endpush
@section('content')
@php
  $homeSections = $sections ?? collect();
  $whySection = $homeSections->get('why-us');
  $hiwSection = $homeSections->get('home-how-it-works');
  $servicesSection = $homeSections->get('home-services');
  $ctaOne = $homeSections->get('home-cta-1');
  $ctaTwo = $homeSections->get('home-cta-2');
@endphp
<!-- Hero Section Begin -->
  <!-- Hero Section -->

  <section id="hero" class="hero section grad-background">

    <div class="container">
      @foreach ($slides as $slider)
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
          <!-- <div class="col-lg-6 order-2 order-lg-1" data-aos="zoom-out"> -->
            <h1 class="mt-lg-5">{!! $slider->caption !!}</h1>
            <p class="mt-lg-3">{!! $slider->highlight !!}</p>
            <div class="d-flex justify-content-center">
              <a href="{{ url($slider->button_one_link) }}" class="">
                <img src="{{asset('img/google-play.png')}}" alt=""class="download-btn" >
              </a>
              <a href="{{ url($slider->button_two_link) }}" class="">
                <img src="{{asset('img/appstore.png')}}" alt="" class="download-btn">
              </a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset($slider->display_media) }}" class="img-fluid animated" alt="">
          </div>
        </div>
      @endforeach
    </div>

</section><!-- /Hero Section -->
  <!-- ======= Hero Section ======= -->


 <!-- Why Us Section -->
 <section id="why-us" class="why-us set-bg" data-setbg="{{ asset('img/background/section-bg1.jpg') }}" data-builder="section">

    <div class="container">
       <!-- Section Title -->
      <div class="section-title" data-aos="fade-up">
        <h4>{!! $whySection->headline ?? $portal->Organization->Page->headline !!}</h4>
        <p>{!! $whySection->subtext ?? $portal->Organization->Page->summary !!}</p>
      </div>
      <!-- End Section Title -->
      <div class="row">

        <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-2">
          @foreach($features as $feature)
          <div class="advantage">
            <h4> {{$feature->label}}</h4>
            <p>{{$feature->overview}}</p>
          </div>
          @endforeach
          <p>
          <a href="#" class="read-more"><span>Open Account</span><i class="bi bi-arrow-right"></i></a></p>

        </div>

        <div class="col-lg-5 order-1 order-lg-1 why-us-img">
          <img src="{{asset($portal->Organization->Page->thumbnail)}}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
        </div>
      </div>

    </div>

</section><!-- /Why Us Section -->

<!-- how-it-works -->
<section class="set-bg" data-setbg="{{ asset('img/background/section-bg2.jpg') }}" data-builder="section">

<div class="container">

  <div class="row">

    <div class="col-lg-7 d-flex flex-column justify-content-center">
      <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
        <h3>{!! $hiwSection->headline ?? 'Get Started with <strong>Moneyswap app</strong>' !!}</h3>
        @if(!empty($hiwSection) && !empty($hiwSection->subtext))
          <p>{!! $hiwSection->subtext !!}</p>
        @endif
      </div>

    </div>


  </div>
  <div class="row">
  @foreach($howitworks as $hiw)
    @if($loop->first)
    <div class="col-md-4">
      @else
    <div class="col-md-4 mt-lg-4">
    @endif
      <div class="hiw-box"  data-aos="zoom-in" data-aos-delay="100">
        <div class="content">
          <div class="num">
            <h6>No. {{$loop->iteration}}</h6>
          </div>
          <h5>{{$hiw->label}}</h5>
          <p>{{$hiw->overview}}</p>
        </div>
        @php
          $extension = strtolower(pathinfo((string) $hiw->display_image, PATHINFO_EXTENSION));
          $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
        @endphp
        @if($isVideo)
          <video class="img-fluid" controls loop muted playsinline data-aos="zoom-in" data-aos-delay="100">
            <source src="{{ asset($hiw->display_image) }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
          </video>
        @else
          <img src="{{asset($hiw->display_image)}}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
        @endif

      </div>
    </div>
    @endforeach
  </div>

</div>

</section>

<!-- how-it-works end -->

<!-- Services Section -->
<section id="services" class="services section set-bg" data-setbg="{{ asset('img/background/section-bg3.jpg') }}">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>{!! $servicesSection->headline ?? 'Built for Everyday and Cross-Border Needs' !!}</h2>
  @if(!empty($servicesSection) && !empty($servicesSection->subtext))
    <p>{!! $servicesSection->subtext !!}</p>
  @endif
  <!-- <p>Lorem ipsum is simply dummy text of the printing and typesetting</p> -->
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">
  @foreach($advantages as $advantage)
    <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
      <div class="hiw-box"  data-aos="zoom-in" data-aos-delay="100">
        <img src="{{asset($advantage->display_image)}}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
        <div class="content">
        <h4> {{$advantage->label}}</h4>
        <p>{{$advantage->overview}}</p>
        </div>
      </div>
    </div>
    @endforeach

  </div>

</div>

</section>
<!-- /Services Section -->

<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9 cta-2">
        <div class="row">
          <div class="col-md-8 d-flex flex-column justify-content-cente"  data-aos="zoom-in" data-aos-delay="100">
            <div class="content">
            <h4>{!! $ctaOne->headline ?? 'Your Money, Handled Responsibly' !!}</h4>
              {!! $ctaOne->subtext ?? '<p>MoneySwap applies industry-standard security practices and works with regulated partners to support secure transactions and responsible fund handling.</p><small>Service availability depends on jurisdiction and regulatory requirements</small>' !!}
            </div>
          </div>
          <div class="col-md-4">
            <img src="{{ asset($ctaOne->image ?? 'img/banner/spend-money.png') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>
      </div>

      <div class="col-md-9 offset-md-3 cta-1 ">
        <div class="row">
          <div class="col-md-8 order-md-2  d-flex flex-column justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <div class="content">
            <h4>{!! $ctaTwo->headline ?? 'You\'re in Safe Company' !!}</h4>
              {!! $ctaTwo->subtext ?? '<p>Moneyswap is a versatile solution that empower you to utilize funds in your wallet as you desire.</p>' !!}

            </div>
          </div>
          <div class="col-md-4 order-md-1">
            <img src="{{ asset($ctaTwo->image ?? 'img/banner/safe-hand.png') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Testimonials Section -->
{{--<section class="testimonials section set-bg" data-setbg="{{ asset('img/background/section-bg3.jpg') }}">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>What Our Users are saying</h2>
    <p>Don't take our word for it-listen to the savvy traders and happy users who have experienced the benefits of MoneySwap </p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "items" : 3,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "640": {
              "slidesPerView": 1
            },
            "768": {
              "slidesPerView": 2
            },
            "1024": {
              "slidesPerView": 4
            }
          }
        }
      </script>
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
            <h3>Saul Goodman</h3>
            <h4>Ceo &amp; Founder</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
            <h3>Sara Wilsson</h3>
            <h4>Designer</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
            <h3>Jena Karlis</h3>
            <h4>Store Owner</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>

</section><!-- /Testimonials Section -->--}}

@endsection


@push('scripts')
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/custom.js')}}" defer></script>
@endpush
