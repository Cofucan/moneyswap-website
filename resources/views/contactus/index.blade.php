@extends('layouts.theme')
@section('page_title', $page->headline)
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
@endpush
@section('content')
   
  <!-- Hero Section End -->

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 text-center">
                  <div class="breadcrumb_text">
                      <h2>{{ $page->headline }}</h2>
                      <div class="breadcrumb_option">
                          <a href="{{ url('/') }}">Home</a>
                          <span>Contact Us</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- Contact Form Begin -->
  <div class="contact-form">
      <div class="container">
          <div class="row">              
              <div class="col-lg-6">
                <div class="contact_form_title">
                    <h2>Leave Message</h2>
                </div>
                @include('partials.alert')
                <form method="POST" action="{{ route('enquiries.store') }}" id="CreateEnquiry" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" name="enquiryable_type" class="form-control" id="contactus" >
                  <input type="hidden" name="portal_email" class="form-control" value="{{ $portal->email }}" >
                  @include('enquiries._form')
                    <hr>
                  <div class="text-center"><button type="submit" class="btn btn-block site-btn">Send Message</button></div>
                </form>
              </div>
              <div class="col-lg-6">
                 <!-- Map Begin -->
                  <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3647231293753!2d3.3864408151913934!3d6.601516124081923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b92fad8185f63%3A0x5836008baaf3ac2c!2s505%20Ikorodu%20Rd%2C%20Ikosi%20Ketu%20105102%2C%20Lagos!5e0!3m2!1sen!2sng!4v1648568205160!5m2!1sen!2sng" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    {{-- <div class="map-inside">
                        <i class="fa fa-pin"></i>
                        <div class="inside-widget">
                            <h4>Nigeria</h4>
                            <ul>
                                <li>Phone: {{ $portal->telephone }}</li>
                                <li>Add:  @foreach ($outlets as $outlet)
                                  {{$outlet->address }}
                                  @endforeach</li>
                            </ul>
                        </div>
                    </div> --}}
                  </div>
                <!-- Map End -->
              </div>
          </div>
      </div>
  </div>
  <!-- Contact Form End -->

  <!-- Contact Section Begin -->
  <section class="contact">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact_widget">
                      <span class="fa fa-phone"></span>
                      <h4>Phone</h4>
                      <p>{{ $portal->email }}</p>
                  </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-6 text-center">
                  <div class="contact_widget">
                      <span class="fa fa-map-marker"></span>
                      <h4>Address</h4>
                      @foreach ($outlets as $outlet)
                      <p>{{$outlet->address }}</p>
                      @endforeach
                  </div>
              </div>             
              <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact_widget">
                      <span class="fa fa-envelope"></span>
                      <h4>Email</h4>
                      <p>{{$portal->telephone}}</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Contact Section End -->

 


  @endsection
