@extends('layouts.volunteers')
@section('page_title', 'Volunteer Plan')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/pricing.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')
<section id="invest" class="d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-sm-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1 class="text-white mb-4">Let your money work for you</h1>          
        <h2 class="text-white">Invest securely with guaranteed monthly returns up to 22% ROI on your capital </h2>
        @guest
        <div class="d-lg-flex">
          <a href="{{ route('register') }}" class="btn-get-started scrollto">Invest Now</a>     
             
        </div>
        @endguest
      </div>
      <div class="col-lg-5 col-sm-6 order-sm-2 order-1 order-lg-2 invest-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="{{asset ('icons/reality.png')}}" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
 
</section>

<section class="price section-padding bg-light-blue">
  <div class="container">
    <div class="row"> 
      <div class="col-md-8 offset-md-2">
        <div class="main_title">
          <h2><span>Make simple, safe and profitable Volunteer</span></h2>
          <p>Irrespective of your risk appetite, GMC provides you with various plans to suit your 
            volunteer need and our team work hard to protect your hard earned money</p>
        </div>
      </div>              
      <div class="col-md-3 col-sm-6 mt-3">
          <div class="card price-card">
            <div class="card-header text-center">
                <h4  class="mt-3 text-uppercase">Basic</h4> 
                <h5>N100,000 - 490,000</h5>                      
            </div>
            <div class="card-body">
          
                <ul class="no-bullet">                
                  <li>15% - 18% ROI monthly</li> 
                  
                  <li>N1,500 Administrative Cost</li>
                
                  <li>No Extra Cost</li>
                </ul>
            </div>
            <div class="text-center mb-3 mt-3">
            
              <form action="{{ route('volunteers.store') }}" method="post"
                onsubmit="return confirm('Click ok to Continue?');">
                {{csrf_field()}}
            
                <input type="hidden" id="type" name="type" value="New" >
                
                <button class="btn btn-success" type="submit">Buy Now</button>
              </form>
        
            </div>
          </div>
      </div>
      <div class="col-md-3 col-sm-6 mt-3">
        <div class="card price-card">
          <div class="card-header text-center">
              <h4  class="mt-3 text-uppercase">Gold</h4> 
              <h5>N500,000 - 990,000</h5>                      
          </div>
          <div class="card-body">
        
              <ul class="no-bullet">                
                <li>16% - 19% ROI monthly</li> 
                
                <li>N1,500 Administrative Cost</li>
              
                <li>No Extra Cost</li>
              </ul>
          </div>
          <div class="text-center mb-3 mt-3">
          
            <form action="{{ route('volunteers.store') }}" method="post"
              onsubmit="return confirm('Click ok to Continue?');">
              {{csrf_field()}}
          
              <input type="hidden" id="type" name="type" value="New" >
              
              <button class="btn btn-success" type="submit">Buy Now</button>
            </form>
      
          </div>
        </div>
      </div>              
      <div class="col-md-3 col-sm-6 mt-3">
          <div class="card price-card">
            <div class="card-header text-center">
                <h4  class="mt-3 text-uppercase">Silver</h4> 
                <h5>N1,000,000 - 4,900,000</h5>                      
            </div>
            <div class="card-body">
          
                <ul class="no-bullet">                
                  <li>17% - 20% ROI monthly</li> 
                  
                  <li>N1,500 Administrative Cost</li>
                
                  <li>No Extra Cost</li>
                </ul>
            </div>
            <div class="text-center mb-3 mt-3">
            
              <form action="{{ route('volunteers.store') }}" method="post"
                onsubmit="return confirm('Click ok to Continue?');">
                {{csrf_field()}}
            
                <input type="hidden" id="type" name="type" value="New" >
                
                <button class="btn btn-success" type="submit">Buy Now</button>
              </form>
        
            </div>
          </div>
      </div>
      <div class="col-md-3 col-sm-6 mt-3">
        <div class="card price-card">
          <div class="card-header text-center">
              <h4  class="mt-3 text-uppercase">Diamond</h4> 
              <h5>N5,000,000 - Above</h5>                      
          </div>
          <div class="card-body">
        
              <ul class="no-bullet">                
                <li>18% - 22% ROI monthly</li> 
                
                <li>N1,500 Administrative Cost</li>
              
                <li>No Extra Cost</li>
              </ul>
          </div>
          <div class="text-center mb-3 mt-3">
          
            <form action="{{ route('volunteers.store') }}" method="post"
              onsubmit="return confirm('Click ok to Continue?');">
              {{csrf_field()}}
          
              <input type="hidden" id="type" name="type" value="New" >
              
              <button class="btn btn-success" type="submit">Buy Now</button>
            </form>
      
          </div>
        </div>
      </div>
    
    </div>
  </div>
</section>

<section class="calculate section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 d-flex flex-column justify-content-center">
        <h2 class="text-uppercase invest-color mb-3">Do the Math</h2>
        <h3>See how much your capital can yield monthly when you invest in GMC-CFI</h3>
      </div>
      <div class="col-md-5 offset-md-1 col-sm-6">      
        <div class="card calculator-card">
          <div class="card-body">
            <form action="">
              <div class="form-row">
                <div class="col-md-6 col-sm-6 mb-3 form-group">
                  <input id="invest_amount" type="text" value="{{ old ('invest_amount')}}" class="form-control{{ $errors->has('invest_amount') ? ' is-invalid' : '' }}" name="invest_amount" placeholder="If you Invest">
                </div>

                <div class="col-md-6 col-sm-6 form-group">
                  <select name="section_id" class="custom select select2" id="monthly">
                    <option>For  </option>                 
                    <option value="3"> 3 months</option>
                    <option value="6"> 6 months</option>
                    <option value="12"> 12 months</option>                   
                  </select>
                </div>
              </div>
              <div class="form-group mb-3">
                <div class="input-group">
                    <input type="text" name="monthly_ref" value="{{old ('monthly_ref') }}" class="form-control{{ $errors->has('monthly_ref') ? ' is-invalid' : '' }}" id="monthly_ref" placeholder="We'll Pay You">
                    <div class="input-group-append">
                      <div class="input-group-text">Monthly</div>
                    </div>
                </div>
              </div>
              <div class="mb-3 form-group">
                <input id="total_earnings" type="text" value="" class="form-control{{ $errors->has('total_earning') ? ' is-invalid' : '' }}" name="total_earning" placeholder="Total returns excluding capital">
              </div>
              <hr>
              {{-- <button class="btn btn-lg btn-block btn-danger">Invest Now</button> --}}
            </form>
            <a class="btn btn-lg btn-block btn-danger" href="{{ route('volunteers.start') }}">Invest Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-8">
        <h2>Have questions?</h2>
        <h4>Check our FAQ or contact us through any of the convenient channels on our page</h4>
      </div>
      <div class="col-md-3 offset-md-1 offset-sm-1 col-sm-2">
        <a href="{{ url('faqs') }}" class="btn btn-warning btn-block mb-3">FAQs</a>
        <a href="{{ url('contactus') }}" class="btn btn-danger btn-block">Contact Us</a>
      </div>
    </div>
  </div>
</section>

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
        <div class="single-testimonial">
          <div class="testimonial-caption ">
            <div class="testimonial-top-cap"> 
              <p>As a proof of your volunteer, a confirmation notice will be sent to you within 3 working days of your volunteer.</p>
            </div>
            <div class="testimonial-founder d-flex align-items-center">
              <div class="founder-text">
                <span>Mr. Balogun Wasiu</span>
              </div>
            </div>
          </div>                        
        </div>
        <div class="single-testimonial">
          <div class="testimonial-caption ">
            <div class="testimonial-top-cap"> 
              <p>As a proof of your volunteer, a confirmation notice will be sent to you within 3 working days of your volunteer.</p>
            </div>
            <div class="testimonial-founder d-flex align-items-center">
              <div class="founder-text">
                <span>Mr. Balogun Wasiu</span>
              </div>
            </div>
          </div>                        
        </div>
        <div class="single-testimonial">
          <div class="testimonial-caption ">
            <div class="testimonial-top-cap"> 
              <p>As a proof of your volunteer, a confirmation notice will be sent to you within 3 working days of your volunteer.</p>
            </div>
            <div class="testimonial-founder d-flex align-items-center">
              <div class="founder-text">
                <span>Mr. Balogun Wasiu</span>
              </div>
            </div>
          </div>                        
        </div>
        <div class="single-testimonial">
          <div class="testimonial-caption ">
            <div class="testimonial-top-cap"> 
              <p>As a proof of your volunteer, a confirmation notice will be sent to you within 3 working days of your volunteer.</p>
            </div>
            <div class="testimonial-founder d-flex align-items-center">
              <div class="founder-text">
                <span>Mr. Balogun Wasiu</span>
              </div>
            </div>
          </div>                        
        </div> 
        
      </div>
 
  </div>
</section>



@endsection

@push('scripts')
  <script src="{{ asset('js/script.js')}}"></script>
  <script src="{{ asset('js/select2.js')}}"></script>
  <script>
    jQuery(document).ready(function($) {
      $('.select2').select2();
      });
  </script>
  {{-- <script src="{{ asset ('plugins/nice-select/js/jquery.nice-select.min.js') }}"></script> --}}

@endpush