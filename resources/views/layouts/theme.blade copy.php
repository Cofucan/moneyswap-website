<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('page_title') | {{$portal->company_name}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($portal->favicon) }}" rel="icon">
  <link href="{{ asset($portal->favicon) }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
  <link href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
  <!-- Vendor CSS Files -->
  <link href="{{ asset('lib/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/main.css')}}" rel="stylesheet">

    @stack('styles')
    @livewireStyles
</head>

<body>

 <!-- Preloader Start -->
 <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{asset ($portal->Organization->favicon) }}" alt="">
                </div>
            </div>
        </div>
    </div>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
      <span><i class="bi bi-envelope-fill"></i><a href="mailto:{{$portal->email}}" class="mr-3">{{$portal->email}} | </a></span>
       
          <i class="bi bi-phone-fill phone-icon "></i> 
          <a href="tel:{{$portal->telephone}}" >{{$portal->telephone}} </a> 
          @foreach($portal->Organization->outlets as $outlet)
          @if($loop->iteration > 0)
          , 
          @endif
          <a href="tel:{{$outlet->telephone}}">
           {{$outlet->telephone}}</a>
          @endforeach
        </div>
      <div class="social-links d-none d-md-block">
      @foreach ($portal->Organization->SocialHandles as $socialhandle)
      <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" class="{{ $socialhandle->SocialPlatform->platform_name }}"><i class="bi bi-{{ $socialhandle->SocialPlatform->platform_name }}"></i></a>

        @endforeach
       
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <a href="{{url('/')}}" class="logo"><img src="{{asset($portal->logo)}}" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{url('/')}}">Home</a></li>
          <!-- <li class="dropdown"><a href="{{url('/page/about')}}"><span>Who We are</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{url('/page/why-us')}}">Why us</a></li>
              <li><a href="{{url('/page/about')}}">About us</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link scrollto" href="{{url('/page/about')}}">About Us</a></li>
          <li><a class="nav-link scrollto" href="{{url('/expertises')}}">What We Do</a></li>
          
          <li><a class="nav-link scrollto" href="{{url('/contactus')}}">Contact us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="{{url('briefs/create')}}" class="get-started-btn scrollto">Request a Quote</a> 
    </div>
  </header><!-- End Header -->


  @yield('content')
  <!-- Footer -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>About Us</h4>
              <ul>
                  <li><i class="bx bx-chevron-right"></i> <a href="{{ url('page/about') }}">Our Story</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="{{ url('expertise') }}">What We Do</a></li>
                  <li><i class="bx bx-chevron-right"></i> <a href="{{ url('contactus') }}">Contact</a></li>
              </ul>

          </div>
          

          {{--<div class="col-lg-2 col-md-6 col-6 footer-links">
            <h4>Who We Serve</h4>
            <ul>
                   @foreach ($servedindustries as $industry)
                    <li><i class="bx bx-chevron-right"></i> <a href="{{ url('industries') }}">{{ $industry->label }}</a></li>
                    <!-- <li><i class="bx bx-chevron-right"></i> <a href="{{ url('industry', $industry->slug) }}">{{ $industry->label }}</a></li> -->
                  
                    @endforeach
              
            </ul>
          </div>--}}

          <div class="col-lg-6 col-md-6 footer-links">
            <h4>What we do</h4>
            <ul class="row">
              @foreach ($expertises as $expertise)
               <li class="col-md-6 col-6"><i class="bx bx-chevron-right"></i> <a href="{{ url('expertise', $expertise->slug) }}">{{ $expertise->label }}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-3">
            <div class="footer-info">
              
              <p> <strong>Address:</strong> <br>
              {{$portal->address }}
              <br>
                <span class="mt-3"><strong>Phone:</strong> {{$portal->telephone}}</span><br>
                <span class="mt-3"><strong>Email:</strong> {{$portal->email}}</span><br>
              </p>
              <div class="social-links mt-3">
                @foreach ($portal->Organization->SocialHandles as $socialhandle)
                  <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" class="{{$socialhandle->handle_name}}"><i class="bx bxl-{{ $socialhandle->SocialPlatform->platform_name }}"></i></a>
                @endforeach
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>{{ $portal->company_name }}</span></strong>  <script>document.write(new Date().getFullYear());</script>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i> 
  </a>
    @livewireScripts
     <!-- Vendor JS Files -->
  <script src="{{ asset('lib/aos/aos.js') }}" defer></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('lib/glightbox/js/glightbox.min.js') }}" defer></script>
  <script src="{{ asset('lib/isotope-layout/isotope.pkgd.min.js') }}" defer></script>
  <script src="{{ asset('lib/swiper/swiper-bundle.min.js') }}" defer></script>

  <!-- Vendor JS Files -->


  <!-- Template Main JS File -->
  <script src="{{ asset('js/asher.js') }}" defer></script>    
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/custom.js')}}" defer></script>
    @stack('scripts')
</body>
</html>
