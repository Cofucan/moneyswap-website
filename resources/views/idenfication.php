@extends('layouts.theme')
@section('page_title', 'Welcome to')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/theme/product.css') }}" type="text/css">
@endpush
@section('content')
<!-- Hero Section Begin -->

    <section class="hero" id="hero">
        <div class="hero_slider owl-carousel">
            @foreach ($slides as $slider)
            <div class="hero_item set-bg" data-setbg="{{ asset($slider->display_media) }}">
                <div class="overlay-div"></div>
                <div class="container ">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="hero_text">
                                <h2>{!! $slider->caption !!}</h2>
                                <p>{!! $slider->highlight !!}</p>
                                @if (!is_null($slider->button_one_link))
                                <a href="{{ url($slider->button_one_link) }}" class="primary-btn">{{ $slider->button_one }}</a>
                                @endif
                                @if (!is_null($slider->button_two_link))
                                <a href="{{ url($slider->button_two_link) }}" class="white-btn">{{ $slider->button_two }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

<section  class="d-flex align-items-center section-padding about ">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1 ftco-animate" data-aos="fade-up" data-aos-delay="200">

            <h4 class="text-uppercase mb-3">{{ $portal->Organization->Page->headline }}</h4>
            <div class="about-content">
               <p>{!! $portal->Organization->Page->summary !!}</p>
            </div>
          <p class="">
            <a href="{{url ('/signup')}}" class="btn btn-white-outline px-3 mr-3">Donate Now</a>
            <a href="{{url ('/member/requirements')}}" class="btn btn-theme px-3">Join Us</a>
          </p>

      </div>
      <div class="col-lg-6 col-sm-6 order-sm-2 order-1 order-lg-2 hero-img fade-in-image" data-aos="zoom-in" data-aos-delay="200">
        <img src="{{asset($portal->Organization->Page->thumbnail)}}" alt="{{$portal->organization->organization_name}}" class="w-100">
      </div>
    </div>
  </div>
</section>

<section class="parallax-bg section-padding ">
 
</section> 

<section class="section-padding ">
    <div class="container ">
      <div class="section-title mb-5 ftco-animate">
        <h4 class="section-header">Our Goals & Objectives</h4>
      </div>
      <div id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">

          <div class="row mt-2">
            @foreach ($advantages as $advantage)           
            <div class="col-md-4 col-lg-4 col-sm-6 d-flex align-items-stretch mb-5 mb-lg-0 text-center">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset ($advantage->display_image) }}" alt="" class="icon-lg">
                <h5 class="title mt-3">{{ $advantage->label }}</h5>
                <p class="description">{!! $advantage->overview !!}</p>
              </div>
            </div>     
            @endforeach  
          </div>

        </div>
      </div>
    </div>
</section> 

<section class="parallax-bg section-padding ">
 
</section> 

 
<section class="section-padding">
    <div class="container ">
      <div class="section-title mb-5">
        <h4 class="text-upppercase">How to get Involved</h4>
      </div>
      <div class="row mt-2">
        <div class="col-md-10 offset-md-1">
          <div class="row">
              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="#">
                        <img src="{{ asset ('img/icons/donate.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Donate Now</h4>
                      </a>
                  </div>
              </div>

              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="{{url('members/requirement')}}">
                        <img src="{{ asset ('img/icons/newmember.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Become A Member</h4>
                      </a>
                  </div>
              </div>

              <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                  <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                      <a href="#">
                        <img src="{{ asset ('img/icons/volunteer.png') }}" alt="" class="icon-lg">
                        <h4 class="link-title mt-3">Volunteer</h4>
                      </a>
                  </div>
              </div>
          </div>
        </div>
    </div>
    </div>
</section>

<section class="parallax-bg2 section-padding ">
 
</section> 

<section class="bg-theme section-padding">
    <div class="container">
      <div class="section-title text-white mb-5">
        <h4 class="section-header text-white">Our Recent Outreach</h4>
      </div>
      <div class="row mt-2">
        <div class="col-md-4 col-sm-6 mb-5 mb-lg-0 text-center">
            <div class="box-border" data-aos="fade-up" data-aos-delay="100">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/O5hShUO6wxs">
                </iframe>
                <h4 class="link-title px-3 py-2">Visiting Orphanage</h4>

            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-5 mb-lg-0 text-center">
            <div class="box-border" data-aos="fade-up" data-aos-delay="100">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/E1xkXZs0cAQ">
                </iframe>
                <h4 class="link-title px-3 py-2">Visiting Orphanage</h4>

            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-5 mb-lg-0 text-center">
            <div class="box-border" data-aos="fade-up" data-aos-delay="100">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/O5hShUO6wxs">
                </iframe>
                <h4 class="link-title px-3 py-2">Visiting Orphanage</h4>

            </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('scripts')
<script src="{{ asset('js/theme/jquery.nice-select.min.js')}}" defer></script>
<script>
  
</script>
@endpush
