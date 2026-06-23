@extends('layouts.theme')
@section('page_title', 'Volunteer')
@push('styles')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')

<section id="hero" class="d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-7 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1 class="text-white text-uppercase mb-4">{!! $page->headline !!}</h1>          
        <h2 class="text-white">{!! $page->body !!}</h2>
       
        <div class="d-lg-flex">
          <a href="{{ route('volunteers.start') }}" class="btn-get-started scrollto">Invest Now</a>     
          <a href="{{ url('packages') }}" class="btn-watch-video scrollto">Learn More</a>      
        </div>
        
      </div>
      <div class="col-lg-6 col-sm-6 order-sm-2 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        {{-- <img src="{{asset ('icons/reality.png')}}" class="img-fluid animated" alt=""> --}} 
      </div>
    </div>
  </div>
 
</section>

<section class="plan section-padding">
  <div class="container">   
    <div class="main_title">
      <h2><span>An volunteer plan for everybody</span></h2>
      <p>Choose an volunteer plan that suits your appetite and overall goal</p>
    </div>
    <div class="row text-md-left text-center text-sm-center">  
      @foreach ($causes as $cause)
      <div class="col-md-3 col-sm-6">
        <div class="plan-item">   
          <div class="row no-gutters">
            <div class="col-md-3 col-sm-4 col-4 text-md-left text-center text-sm-center"><img src="{{ asset($cause->icon) }}" alt="{{ $cause->name }}"></div>
            <div class="col-md-4 col-sm-6 col-4 mt-2"> <h5 class="text-uppercase text-left">{{ $cause->name }}</h5></div>
          </div>         
          <h5> <span>{{ $cause->plan_amount }} </span> </h5>
          <p>{{ $cause->returns }}</p>
        </div>
      </div>          
      @endforeach   

      
    </div>
  </div>
</section>

<section class="hiw section-padding mb-3">
  <div class="container">
    <div class="main_title">
      <h2><span>Investing in GMC-CFI is easy, safe and rewarding</span></h2>
      <p>We put your money to work so that you can enjoy the reward</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-sm-7 pt-lg-0 about-content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100"> 
        <ul>
          @foreach ($howitworks as $howitwork)
          <li> 
            <i class="fa fa-check"></i>
            <div>
              <h5>{{ $howitwork->label }}</h5>
              <p>{!! $howitwork->overview !!}</p>
            </div>
          </li>
          @endforeach        
       
          <hr>
          <a href="{{ url('volunteers/start') }}" class="btn btn-invest btn-lg">Invest Now</a>      
        
      </div>
      <div class="col-lg-6 col-sm-5" data-aos="zoom-out" data-aos-delay="100">
        <img src="{{asset('icons/investing.jpg')}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section>

{{-- <section class="bg-img section-padding">
  <div class="container">
    <div class="main_title">
      <h2 class="text-white"><span>Gmc- Cash flow Programme</span></h2>
      <p class="text-white">Invest in GMC-Cash flow today!</p>
    </div>
    <div class="row">
      @foreach ($advantages as $advantage)
        <div class="col-md-4 col-sm-4">
          <div class="feature-item text-center">
            <img src="{{ asset($advantage->display_image) }}" alt="Basic">
            <h5 class="text-uppercase">{{ $advantage->value_title }}</h5>  
            <p>{!! $advantage->summary !!} </p>
          </div>
        </div>          
      @endforeach    
    </div>
  </div>
</section> 

@if ($testimonials->count() > 0)
<section class="testimonial-area section-padding">
    <div class="container ">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Tittle -->           
                <div class="main_title">
                    <h2><span>Meet other CFI investors</span></h2>
                    <p>People have CFI to grow their capital and take care of their regular bills conveniently</p>
                  </div>
            </div>
        </div>
        <div class="testimonial-slider owl-carousel">    
          @foreach ($testimonials as $testimonial)
            <div class="single-testimonial">
              <div class="testimonial-caption ">
                <div class="testimonial-top-cap">  
                  <p>{!!$testimonial->testimony!!}</p>
                </div>
                <div class="testimonial-founder d-flex align-items-center">
                    <div class="founder-text">
                      <span>{{$testimonial->Person->full_name}}</span>
                    </div>
                </div>
              </div>                        
            </div>  
          @endforeach          
        </div>
   
    </div>
  </section>
@endif--}}
  
  

<!-- Statement -->
    
@endsection

@push('scripts')
  <script src="{{ asset ('plugins/nice-select/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('js/script.js')}}"></script>

@endpush
