@section('page_title', $page->headline)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
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

    <div class="page-title mt-3" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="current">{{$page->headline}}</li>
          </ol>
        </nav>
      </div>
    </div>

    

<!-- Service Details Section -->
<section id="service-details" class="service-details section">

    <div class="container">

    <div class="row gy-4">


        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        <h3>{{$page->headline}}</h3>
        {!!$page->body!!}
        
        </div>

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="services-list">
            <a href="#" class="active">Legal</a>
            <a href="{{ url('page/terms') }}">Terms of Service</a>
            <a href="{{ url('page/privacy-policy') }}">Privacy Policy</a>
            <a href="{{ url('page/complaint') }}">AML compliant</a>
        </div>
        </div>

    </div>

    </div>

</section><!-- /Service Details Section -->

  

  @endsection

