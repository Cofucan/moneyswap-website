@section('page_title', 'company')
@extends('layouts.theme')
@push('styles')
<!-- Main Stylesheet File -->
<link href="{{ asset ('css/realtycompanyUi.css') }}" rel="stylesheet">
{!! $map['js'] !!}
@endpush
@section('content')
  
    <section id="map">
     
    {!! $map['html'] !!}
           
    </section><!-- #communitys -->
   

<section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-12 contact-header text-center">
             <h2>We are at your Reach</h2>
            <hr>
          </div>
          <div class="col-lg-6 mx-auto">
                  
            <div class="row contact-details">
              <div class="col-md-1">
                    <i class="fa fa-map-marker fa-3x  mb-3 sr-contact-1"></i>
              </div>
              <div class="col-md-8">
                <h4>Office Address:</h4>
                <p>Suit H165, Ikota Shopping Complex, VGC-Lekki, Lagos</p>
              </div>
              <div class="col-md-3">

              </div>
            </div>

            <div class="row contact-details">
              <div class="col-md-1">
                    <i class="fa fa-phone-square fa-3x  mb-3 sr-contact-1"></i>
              </div>
              <div class="col-md-8">
                <h4>Contact</h4>
                <p>Mobile: +234-803-436-9153 <br> Office: +234-(0)903-875-4854</p>
              </div>
              <div class="col-md-3">

              </div>
            </div>

            <div class="row contact-details">
              <div class="col-md-1">
                    <i class="fa fa-envelope-square fa-3x  mb-3 sr-contact-1"></i>
              </div>
              <div class="col-md-8">
                <h4> E-mail Address:</h4>
                <p>info@evanwilliams.com.ng</p>
              </div>
              <div class="col-md-3">

              </div>
            </div>
          </div> 
          <div class="col-lg-6 mx-auto">
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input type="email" name="sender_email" class="form-control" id="sender_email" placeholder="Your Email Address" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-phone"></i></div>
                    </div>
                    <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Mobile Number" required>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-building-o"></i></div>
                  </div>
                  <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company Name">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <textarea class="form-control" name="enquiry_message" id="enquiry_message" rows="4" placeholder="Description"></textarea>
                </div>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-success btn-block">Send Message</button></div>
            </form>
          </div>
        </div>
        
      </div>
    </section>
@endsection