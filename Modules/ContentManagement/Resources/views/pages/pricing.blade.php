@section('page_title', $page->headline)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="price-hero section grad-background ">

    <div class="container">
        <div class="row gy-4 justify-content-center text-center">
        <div class="col-lg-8" data-aos="zoom-out">
        <!-- <div class="col-lg-6 order-2 order-lg-1" data-aos="zoom-out"> -->
            <h1 class="mt-lg-5">{{$page->headline}}</h1>
            <p>{!! $page->body !!}</p>
        </div>
        </div>
        <div class="row gy-4">

            <div class="col-lg-4 col-md-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="item position-relative">
                <div class="icon"><i class="bi bi-shield-lock-fill icon"></i></div>
                <h4><a href="" class="stretched-link">Secure</a></h4>
                <p>Your funds are safe with our financial partners and accessible anytime in designated currencies .</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="item position-relative">
                <div class="icon"><i class="bi bi-rocket-takeoff-fill icon"></i></div>
                <h4><a href="" class="stretched-link">Fast</a></h4>
                <p>Yes, source your destination currencies within 24hours</p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-4 d-flex" data-aos="fade-up" data-aos-delay="400">
                <div class="item position-relative">
                <div class="icon"><i class="bi bi-bar-chart-line icon"></i></div>
                <h4><a href="" class="stretched-link">Best Rates</a></h4>
                <p>No middle man means you get the best rate from your peers and can even negotiate for better rate.</p>
                </div>
            </div><!-- End Service Item -->

            </div>

    </div>

</section><!-- /Hero Section -->

 <!-- Pricing Section -->
 <section id="pricing" class="pricing section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Fair prices, no hidden fees</h2>
  <p>No subscriptions, no monthly fees. You’ll always see the fee upfront, and only pay for what you use.</p>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4  justify-content-center ">

    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
      <div class="pricing-item">
        <table class="table">
            @foreach($prices as $price)
            <tr>
                <td>
                    <h5>{{$price->label}}</h5>
                    <p><i class="bi bi-check-circle"></i> <span>{{$price->overview}}</span></li></p>
                </td>
                <td class="price">
                    <h5>{{$price->price}}</h5>
                </td>
            </tr>
            @endforeach

        </table>

      </div>
    </div><!-- End Pricing Item -->

  </div>

</div>

</section><!-- /Pricing Section -->


  @endsection
