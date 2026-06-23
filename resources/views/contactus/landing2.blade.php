@section('page_title', 'company')
@extends('layouts.community_master')
@push('styles')
<!-- Main Stylesheet File -->
<link href="{{ asset ('css/realtycompanyUi.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section id="first">
      

      <div id="first-carousel" class="owl-carousel" >
        <div class="item" style="background-image: url('images/22.jpg');"></div>
        <div class="item" style="background-image: url('images/222.jpg');"></div>
        <div class="item" style="background-image: url('images/3 compressesd.jpg');"></div>
        <div class="item" style="background-image: url('images/gate.jpg');"></div>
        <div class="item" style="background-image: url('images/5.jpg');"></div>
      </div>
    </section><!-- #intro -->

  <!--==========================
      About Section
    ============================-->
    <section id="welcome" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h4>Welcome to the Realty world!</h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            sunt in culpa qui officia deserunt mollit anim id est laborum.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <a class=""><button class="btn btn-primary"> Learn More </button></a>
          </div>
        </div>
      </div>
    </section><!-- #about -->

    <section id="communities" class="wow fadeInUp">
      <div class="container">
        <div class="section-header text-center">
          <h3>Projects</h3>
          <hr>
        </div>
        <div class="owl-carousel communities-carousel">
          <div class="community-content">
            <img src="{{ asset ('images/estate.jpg') }}" alt="">
            <h4>Bourdillon Estate</h4>
            <h5>1,500 per units</h5>
          </div>

          <div class="community-content">
            <img src="{{ asset ('images/estate.jpg') }}" alt="">
            <h4 clas>Bourdillon Estate</h4>
            <h5>1,500 per units</h5>
          </div>

          <div class="community-content">
            <img src="{{ asset ('images/3.jpg') }}" alt="">
            <h4>Bourdillon Estate</h4>
            <h5>1,500 per units</h5>
          </div>

          <div class="community-content">
            <img src="{{ asset ('images/4.jpg') }}" alt="">
            <h4>Bourdillon Estate</h4>
            <h5>1,500 per units</h5>
          </div>

          <div class="community-content">
            <img src="{{ asset ('images/5.jpg') }}" alt="">
            <h4>Bourdillon Estate</h4>
            <h5>1,500 per units</h5>
          </div>
          
        </div>

      </div>
    </section><!-- #communitys -->

    
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset ('images/help-desk.png') }}">
                    </div>
                    <div class="col-md-9">
                        <h3 class="cta-title">LOOKING TO BUY HOME</h3>
                        <p class="cta-text"> Realty World- Your Best Source For Buying Or Renting Of Properties In Nigeria</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
            </div>
            
        </div>

      </div>
    </section>

    <!--==========================
      Testimonials Section
    ============================-->
    <section id="clients-talk" class="wow fadeInUp">
      <div class="container">
        <div class="section-header text-center">
          <h3>Testimonials</h3>
          <hr>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna  noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>
        <div class="owl-carousel testimonials-carousel">
            <div class="testimonial-item">
              <p>
                <img src="images/quote-sign-left.png" class="quote-sign-left" alt="">
                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                <img src="images/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <h3>Saul Goodman</h3>
              <h4>Ceo &amp; Founder</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="images/quote-sign-left.png" class="quote-sign-left" alt="">
                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                <img src="images/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <h3>Sara Wilsson</h3>
              <h4>Designer</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="images/quote-sign-left.png" class="quote-sign-left" alt="">
                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                <img src="images/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <h3>Jena Karlis</h3>
              <h4>Store Owner</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="images/quote-sign-left.png" class="quote-sign-left" alt="">
                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                <img src="images/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <h3>Matt Brandon</h3>
              <h4>Freelancer</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="images/quote-sign-left.png" class="quote-sign-left" alt="">
                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                <img src="images/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <h3>John Larson</h3>
              <h4>Entrepreneur</h4>
            </div>

        </div>

      </div>
    </section><!-- #testimonials -->
@endsection