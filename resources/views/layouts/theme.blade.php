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

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">



  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet">

    @stack('styles')
    @livewireStyles
</head>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">

    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto">
        <img src="{{asset($portal->logo)}}" alt="">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('howitworks')}}">How it works</a></li>
          <li><a href="{{url('faqs')}}">FAQ</a></li>
          <li><a href="{{url('pricing')}}">Pricing</a></li>
          <li><a href="{{url('page/about')}}">About Us</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-sign-white" href="{{url('login')}}">Signin</a>
      <a class="btn-sign-red" href="{{url('register')}}">Signup</a>

    </div>
  </header>



  <main class="main">

  @yield('content')

  </main>

  <footer id="footer" class="footer">

    <div class="footer-newsletter">
        @include('partials.cta')
    </div>

    <div class="container-fluid footer-top">
      <div class="row gy-4">
        <div class="col-lg-3 px-5 col-md-6 ">
          <div class="footer-about">
          <a href="{{url('/')}}" class="d-flex align-items-center brand">
            <img src="{{asset($portal->logo)}}" alt="">
          </a>
          </div>

          <div class="social-links d-flex mt-3">
          @foreach ($portal->Organization->SocialHandles as $socialhandle)
      <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}"><i class="bi bi-{{ $socialhandle->SocialPlatform->platform_name }}"></i></a>

        @endforeach

          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-4 footer-links">
          <h4>MoneySwap</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{url('page/about')}}">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{url('howitworks')}}">How it Works</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ url('our-teams') }}">Our Team</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ url('contactus') }}">Contact Us</a></li>
          </ul>
        </div>


        <div class="col-lg-2 col-md-3 col-4 footer-links">
          <h4>Legal</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ url('page/terms') }}">Terms of Service</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ url('page/complaint') }}">AML compliant</a></li>
          </ul>
        </div>



        <div class="col-lg-2 col-md-3 col-4 footer-links">
          <h4>Resources</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{url('posts')}}">Blog</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Use Cases</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{url('pricing')}}">Pricing</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{url('faqs')}}">FAQ</a></li>
          </ul>
        </div>

        <div class="col-lg-3  px-5 col-md-3 col-12 footer-links">
        <p class="text-left">Download the App <br> Perform transactions on the go </p>
          <div class="d-flex  justify-content-center footer-btn mt-2">
              <a href="//play.google.com/store/apps/details?id=com.africa.money_swap" class="">
                <img src="{{asset('img/google-play.png')}}" alt=""class="download-btn" >
              </a>
              <br>
              <a href="//play.google.com/store/apps/details?id=com.africa.money_swap" class="ml-3">
                <img src="{{asset('img/appstore.png')}}" alt="" class="download-btn">
              </a>
            </div>
        </div>
      </div>
    </div>

    <div class="container copyright  mt-4">
      <div class="row">
        <div class="col-md-8">
          <div class="credits">
              <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $portal->company_name }} <script>document.write(new Date().getFullYear());</script>.</strong></p>
              <p class="mt-2">"Moneyswap" and the Moneyswap logo are registered trademarks. Moneyswap is not a bank but performs all banking transactions through its licensed partners.</p>
          </div>
        </div>
        <div class="col-md-4 mt-lg-0 mt-3">

        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  @livewireScripts

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}" defer></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}" defer></script>



  <!-- Template Main JS File -->
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/custom.js')}}" defer></script>
    @stack('scripts')

</body>


</html>
