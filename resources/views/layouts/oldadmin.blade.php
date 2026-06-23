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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset ('css/board.css') }}">
    <link href="{{ asset ('css/responsive.css')}}" rel="stylesheet">

    @stack('styles')
    @livewireStyles
</head>
<body id="body">
  <!-- #header -->

<header class="header_area">
  <div class="container-fluid">
    @guest
    @else
      <nav class="navbar navbar-icon-top navbar-expand-lg">

        <a class="navbar-brand logo_h" href="{{url('/')}}" >
          <img src="{{ asset($portal->logo) }}" alt="{{config('app.name')}}"/>
        </a>
        @if (Auth::user()->Profile->role_id == 5)
        {{-- <div class="lg-menu">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          </div> --}}
        @else
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        @endif

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="row w-100 mr-0">
            <div class="col-lg-9 col-sm-8 col-8 pr-0">
              @if ( Auth::user()->Profile->role_id == 1)
              @include('partials.sidemenu.admin')
              @elseif (Auth::user()->Profile->role_id == 2 )
              @include('partials.sidemenu.admin')
              @elseif ( Auth::user()->Profile->role_id == 5 )
              @include('partials.sidemenu.customer')
              @elseif ( Auth::user()->Profile->role_id == 6 )
              @include('partials.sidemenu.storemanager')
              @elseif ( Auth::user()->Profile->role_id == 4 )
              @include('partials.sidemenu.cashier')
              @elseif ( Auth::user()->Profile->role_id == 3 )
              @include('partials.sidemenu.manager')
              @endif
            </div>

            <div class="col-lg-3 col-sm-4 col-4 pr-0">
              
              <ul class="nav navbar-nav center_nav pull-left">
                <li class="nav-item dropleft ml-auto p-t-5"><a id="userInfo" href="{{config('app.url')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                  <img src="{{ asset(Auth::user()->Profile->profile_pic) }}" alt="{{ Auth::user()->Profile->first_name }}" style="max-width: 2.5rem; max-height: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
                  <div aria-labelledby="userInfo" class="dropdown-menu dropleft">
                    <a href="#" class="dropdown-item text-black">
                      <strong class="d-block text-uppercase headings-font-family">
                        Hi, {{ Auth::user()->Profile->first_name }}</strong>

                    </a>
                    <a href="{{ route('profiles.show', Auth::user()->Profile)}}" class="dropdown-item text-black">My Profile</a>

                    <a href="{{url('changepassword')}}" class="dropdown-item text-black">Change Password </a>
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-black">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>

            </div>
          </div>

        </div>
        @if (Auth::user()->Profile->role_id == 5)
        <div class="mobile-user-icon  mr-0">
          <div class="dropdown dropleft">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <img src="{{ asset (Auth::user()->Profile->profile_pic)}}" alt="{{ Auth::user()->Profile->full_name }}" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow">

            </a>

            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">
                <strong class="d-block text-uppercase headings-font-family">
                {{ Auth::user()->Profile->first_name }}</strong></a>
                @if(Auth::user()->Profile->role_id == 5)
                <a href="{{ route('profiles.show', Auth::user()->Profile->id)}}" class="dropdown-item">My Profile</a>
                @endif
                <a href="{{url('changepassword')}}" class="dropdown-item">Change Password </a>

                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-black">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </div>
          </div>
        </div>
        @endif

      </nav>
    @endguest

  </div>

</header>
@guest
@else
@if (Auth::user()->Profile->role_id == 5 )
<div class="mobile-menu">
  <nav class="nav mobile-nav">

    <a href="{{url ('home')}}" class="mobile-item">
    <i class="fa fa-home"> </i>
    <span class="mobile-text">Home</span>
    </a>

    <a href="{{url('shop')}}" class="mobile-item">
      <i class="fa fa-clipboard"> </i>
      <span class="mobile-text">Shop</span>
    </a>

    <a href="{{url('investments/home')}}" class="mobile-item">
      <i class="fa fa-shopping-cart"> </i>
      <span class="mobile-text">Investment</span>
    </a>

   
    <a href="{{url('/orders/home')}}" class="mobile-item">
      <i class="fa fa-shopping-cart"> </i>
      <span class="mobile-text">Orders</span>
    </a>
        
    <a href="{{url('invoices/home')}}" class="mobile-item">
      <i class="fa fa-file-text"> </i>
      <span class="mobile-text">invoices</span>
    </a>

    <a href="{{url('advices/home')}}" class="mobile-item">
      <i class="fa fa-money"> </i>
      <span class="mobile-text">Payments</span>
    </a> 
  </nav>
</div>
@endif
@endguest

<section class="dash-body">
<div class="container mt-5">
  @if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
      </button>
      <strong>{{ Session::get('success') }}</strong>
    </div>
  @endif

  @if ( Session::has('error') )
      <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
          </button>
          <strong>{{ Session::get('error') }}</strong>
      </div>
  @endif

@yield('content')

</div>
</section>



<footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100 d-lg-block d-sm-block d-none ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-sm-6 text-center text-md-left text-primary">
        <p class="mb-2 mb-md-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> {{ config('app.name') }}</p>
      </div>
      <div class="col-md-6 col-sm-6 text-center text-md-right text-gray-400 lg-menu">
        <p class="mb-0">Powered by <a href="https://skoorite.com" class="external text-gray-400">Systempace Tech</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
  </div>
</footer>
@livewireScripts
 <!-- Footer section -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/jquery.min.js')}}"></script>
 <script src="{{ asset('js/dashboard.js')}}"></script>
 {{-- <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script> --}}
 <script src="{{ asset('js/select2.js')}}"></script>
 <script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js" defer></script>

<script>
   jQuery(document).ready(function($) {
     $('.select2').select2();
     $('#table').DataTable();
     });
 </script>
  @stack('scripts')
 
</body>
</html>
