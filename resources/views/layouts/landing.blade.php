<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') | {{config('app.name')}}</title>

    <link href="{{ asset($portal->favicon) }}" rel="icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?sponsor=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/theme/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/theme/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/theme/style.css') }}">
    @stack('styles')
    @livewireStyles
</head>
<body>

    <div id="app">

      <div id="preloder">
        <div class="loader"></div>
      </div>
      <!-- Humberger Begin -->
    <div class="humberger_menu_overlay"></div>
    <div class="humberger_menu_wrapper">
        <div class="humberger_menu_logo">
            <a href="#"><img src="{{ $portal->logo }}" alt=""></a>
        </div>
        <div class="humberger_menu_cart">
            <div class="hero_search_phone_icon">
                <i class="fa fa-phone"></i>
            </div>
            <div class="hero_search_phone_text">
                <h6 class="mt-2">{{ $portal->telephone }}</h6>
                {{-- <span>support 24/7 time</span> --}}
            </div>
        </div>
        <div class="humberger_menu_widget">

            <div class="header_top_right_auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger_menu_nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/') }}">Shop Online</a>  </li>
                <li><a href="{{ url('agro-investments') }}">Agro-Investment</a></li>
                <li><a href="{{ url('/') }}">How to Pay</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header_top_right_social">
            @foreach ($portal->Organization->SocialHandles as $socialhandle)
            <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" class="{{ $socialhandle->SocialPlatform->platform_name }}"  target="_blank"><i class="fa fa-{{ $socialhandle->SocialPlatform->icon }}"></i></a>
            @endforeach
        </div>
        <div class="humberger_menu_contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{$portal->email}}</li>
                <li>{{$portal->Organization->slogan}}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <header class="header">
        <div class="header_top">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6">
                      <div class="header_top_left">
                          <ul>
                              <li><i class="fa fa-envelope"></i> {{$portal->email}}</li>
                              <li>{{$portal->Organization->slogan}}</li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="header_top_right">
                          <div class="header_top_right_social">
                              @foreach ($portal->Organization->SocialHandles as $socialhandle)
                              <a href="{{ $socialhandle->SocialPlatform->url }}/{{$socialhandle->handle_name}}" class="{{ $socialhandle->SocialPlatform->platform_name }}"  target="_blank"><i class="fa fa-{{ $socialhandle->SocialPlatform->icon }}"></i></a>
                              @endforeach

                          </div>
                          {{-- <div class="header_top_right_language">
                              <img src="img/language.png" alt="">
                              <div>English</div>
                              <span class="fa fa-chevron-down"></span>
                              <ul>
                                  <li><a href="#">Spanis</a></li>
                                  <li><a href="#">English</a></li>
                              </ul>
                          </div> --}}
                          <div class="header_top_right_auth">
                            @guest
                            <a href="{{ url('/login') }}" > <i class="fa fa-user"></i> My Account</a>
                            @else
                            <a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a>
                            @endguest
                              {{-- <a href="#"><i class="fa fa-user"></i> Login</a> --}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="container bg-white">
          <div class="row">
              <div class="col-lg-2">
                  <div class="header_logo">
                      <a href="{{ url('/') }}" ><img src="{{ $portal->logo }}" alt=""></a>
                  </div>
              </div>
              <div class="col-lg-7">
                  <nav class="header_menu">
                      <ul>
                          <li class="active"><a href="{{ url('/') }}">Home</a></li>
                          {{-- <li><a href="./shop-grid.html">Shop</a></li> --}}
                          <li><a href="#">Shop Online</a>
                              {{-- <ul class="header_menu">
                                  <li><a href="{{ url('shop') }}">Store</a></li>
                                  <li><a href="{{ url('categories') }}">Shop by Categories</a></li>

                              </ul> --}}
                          </li>
                          <li><a href="{{ url('agro-investments') }}">Agro-Investment</a></li>
                          <li><a href="{{ url('/') }}">How to Pay</a></li>
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-3">
                <div class="hero_search_phone mt-lg-4">
                    <div class="hero_search_phone_icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="hero_search_phone_text">
                        <h6>{{ $portal->telephone }}</h6>
                        {{-- <span>support 24/7 time</span> --}}
                    </div>
                </div>
              </div>
          </div>
          <div class="humberger_open">
              <i class="fa fa-bars"></i>
          </div>
      </div>
    </header>

          @yield('content')



    @livewireScripts
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/theme/jquery.nice-select.min.js')}}" defer></script>
    <script src="{{ asset('js/theme/jquery-ui.min.js')}}" defer></script>
    <script src="{{ asset('js/theme/jquery.slicknav.js')}}" defer></script>
    <script src="{{ asset('js/theme/mixitup.min.js')}}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}" defer></script>
    <script src="{{ asset('lib/stickyjs/sticky.js')}}" defer></script>
    <script src="{{ asset('js/theme/main.js')}}" defer></script>

</body>
</html>
