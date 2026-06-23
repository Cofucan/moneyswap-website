@extends('layouts.theme')
@section('page_title', 'Contact us')
@push('styles')
<link href="{{ asset ('css/signin.css') }}" rel="stylesheet">

@endpush
@section('content')

<section id="page-banner" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-md-1 col-sm-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 text-center" data-aos="fade-up" data-aos-delay="200">
          <h1 class="text-white">Stay Connected with us </h1>          
          <p>
          We are Available 24/7
          </p>
          
        </div>
        
      </div>


    </div>
  </section>

  <section class="section-padding section-bg-light cta d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <h3 class="text-uppercase text-center"></h3>
          <div class="row mt-5">           
            <div class="col-md-6 text-center">
              <i class="fa fa-phone-square fa-4x"></i>
              <h5 class="mt-2">+234(0) 812 345 6789</h5>
            </div>
            <div class="col-md-6 text-center">
              <i class="fa fa-envelope-square fa-4x"></i>
              <h5 class="mt-2">help@moneeswap.com</h5>
            </div>
          </div>
          <div class="card mt-5">
            <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group">
                <label for="">Full Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email Address" required>
                  </div>
                  @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="">Telephone</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-phone"></i></div>
                    </div>
                    <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Mobile Number" required>
                  </div>
                    @if ($errors->has('telephone'))
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('telephone') }}</strong>
                      </span>
                    @endif
                </div>
              </div>
            
              <div class="mb-3 form-group">
                <label for="">Your Enquiry</label>
                <textarea class="form-control" name="enquiry_body" id="enquiry_body" rows="4" placeholder=" Information Required"></textarea>
                @if ($errors->has('enquiry_body'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('enquiry_body') }}</strong>
                </span>
                @endif
              </div>    
              
              <hr>
              
              <button class="btn btn-danger btn-lg btn-block"> submit

              </button>


             
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  
@endsection
