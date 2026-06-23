@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/util.css') }}">
<style>
  .square{
    margin-left: 30px;
    font-size: 15px;
    
  }
</style>
@endpush
@section('content')

 	
<section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  <h2>{{$page->headline}}</h2> 
            
          </div>
      </div>
  </div>
</section>
  <!--==========================
      What We Do Section
    ============================-->

    <section  class="pt-5 about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
    
                <h4 class="text-uppercase">{{$page->headline}}</h4>
                <div class="about-content text-justify">
                    {!! $page->body !!}
                </div>   
                {{-- <table class="table table-borderless">
                @foreach ($requirements as $requirement)
                <tr>
                  <td><b>{{ $requirement->label }}</b> <br> {!! $requirement->overview !!}</td>

                </tr>
                @endforeach 


                </table>--}} 

                 
          </div>
         
        </div>
      </div>
    </section>

    <section class="hiw section-padding mb-3 about">
      <div class="container">
        <div class="section-title mb-5">
          <h4 class="section-header">How to join</h4>
        </div>
        <div class="row">
          <div class="col-lg-5 col-sm-5" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('img/member.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-7 col-sm-7 pt-lg-0 about-content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <ul class="timeline">
    
              @foreach ($howitworks as $howitwork)
                <li>          
                  <p> {!! $howitwork->overview !!} 
                    @if (!is_null($howitwork->button_url))
                      <a href="{{ url($howitwork->button_url) }}">{{ $howitwork->button_text }}</a>
                  @endif </p>
                </li>
              @endforeach
    
            </ul>
          
    
          </div>
        </div>
      </div>
    </section>
  
    <section class="section-padding about">
      <div class="container ">
        <div class="section-title mb-5">
          <h4 class="section-header">Membership Benefits</h4>
          <p class="mt-3">Be part of a dynamic, God-Fearing women group that exists for the well-being of others.</p>
        </div>
        <div id="featured-services" class="featured-services">
          <div class="container" data-aos="fade-up">
  
            <div class="row mt-2">
              @foreach ($advantages as $advantage)
              <div class="col-md-3 col-lg-3 col-sm-6 d-flex align-items-stretch mb-5 mb-lg-0 text-center">
                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                  <img src="{{ asset ($advantage->display_image) }}" alt="" class="icon-lg">
                  <h5 class="title mt-3">{{ $advantage->label }}</h5>
                  <p class="description">{!! $advantage->overview!!}</p>
                </div>
              </div> 
              @endforeach
             
           
  
            </div>
  
          </div>
        </div>
      </div>
    </section>

    <section class="bg-theme section-padding">
      <div class="container ">
        {{-- <div class="section-title mb-5">
          <h4 class="text-upppercase text-white">How to get Involved</h4>
        </div> --}}
        <div class="row mt-2">
          <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                    <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{url('register')}}">
                          <img src="{{ asset ('img/icons/newmember.png') }}" alt="" class="icon-lg">
                          <h4 class="link-title mt-3">Join Us Now</h4>
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

                <div class="col-md-4 col-lg-4 col-sm-6 mb-5 mb-lg-0 text-center">
                    <div class="box-border-bg" data-aos="fade-up" data-aos-delay="100">
                        <a href="#">
                          <img src="{{ asset ('img/icons/donate.png') }}" alt="" class="icon-lg">
                          <h4 class="link-title mt-3">Donate Now</h4>
                        </a>
                    </div>
                </div> 
  
            </div>
          </div>
      </div>
      </div>
  </section>


  

  @endsection
@push('script')
<script src="{{ asset('js/select2.js')}}"></script>



<script>

  
</script>

@endpush
