
@extends('layouts.theme')
@section('page_title', 'Contact Us')
@push('styles')
<link href="{{ asset ('css/event.css')}}" rel="stylesheet">
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
<style>
  .contact-details p{
    margin-bottom: 0;
  }
</style>
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


  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  @foreach ($outlets as $outlet)
                  <h4>{{ $outlet->label }}</h4>
                  <p>{{$outlet->address }}</p>
                  @endforeach
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->


  @endsection
