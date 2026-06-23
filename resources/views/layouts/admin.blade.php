<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('page_title') | {{ $portal->company_name }}</title>
    <meta name="description" content="SchoolMag">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <link rel="apple-touch-icon" href="{{asset ('img/portal-logo.jpg') }}">
    <link rel="shortcut icon" href="{{asset ('img/portal-logo.jpg') }}">
    <!-- Bootstrap CSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{asset('css/admin/orionicons.css')}}">
    <!-- theme stylesheet-->
    {{-- <link rel="stylesheet" href="{{asset ('css/admin-custom.css')}}"> --}}
    <link rel="stylesheet" href="{{asset ('css/admin/admin.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset ('css/util.css')}}">
    <link rel="stylesheet" href="{{asset ('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset ('css/admin/dashboard.css')}}">
    <link href="{{ asset ('css/admin.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset ('css/board.css') }}">

    @stack('styles')
    <style>
    #live_loading{
    visibility:hidden;
    }
    #requirement_title{
    visibility:hidden;
    }
     </style>

</head>


<body>
    @guest
        {{ session(['must_login' => 'Please Login to continue']) }}
        <script> window.location.href="{{ url('/login') }}"; </script>
    @else
        <!-- navbar-->
        <header class="header" id="header">
          <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
            <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead">
              <i class="fa fa-align-left"></i>
            </a>
            <a href="{{url ('/')}}" class="navbar-brand font-weight-bold text-uppercase text-base">
              {{ $portal->Organization->legal_name }}
            </a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
              <li class="nav-item dropdown ml-auto">
                <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" class="nav-link dropdown-toggle">
                  Need Help?
                </a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                  <a href="#" class="dropdown-item">
                    <strong class="d-block text-uppercase headings-font-sponsor">
                      Hi, {{  Auth::user()->Profile->first_name }}</strong><small>{{ Session::get('role')}}</small>
                  </a>

                  {{-- <div class="dropdown-divider"></div> --}}
                  <a href="{{ route('profiles.show', Auth::user()->profile)}}" class="dropdown-item">My Profile</a>
                  <a href="{{url('changepassword')}}" class="dropdown-item">Change Password </a>

                  {{-- <div class="dropdown-divider"></div> --}}
                  <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>

              <li class="nav-item dropdown ml-auto"><a id="userInfo" href="{{config('app.url')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="{{ asset (Auth::user()->Profile->profile_pic )}}" alt="{{  Auth::user()->Profile->first_name }}" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
                <div aria-labelledby="userInfo" class="dropdown-menu">
                  <a href="#" class="dropdown-item">
                    <strong class="d-block text-uppercase headings-font-sponsor">
                      Hi, {{  Auth::user()->Profile->first_name }}</strong><small>{{ Session::get('role')}}</small>
                  </a>

                  {{-- <div class="dropdown-divider"></div> --}}
                  <a href="{{ route('profiles.show', Auth::user()->Profile->id)}}" class="dropdown-item">My Profile</a>
                  <a href="{{url('changepassword')}}" class="dropdown-item">Change Password </a>

                  {{-- <div class="dropdown-divider"></div> --}}
                  <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </nav>
        </header>
        <div class="d-flex align-items-stretch">
          <div id="sidebar" class="sidebar py-3">
            @if (  Auth::user()->Profile->role_id == 1 )
            @include('partials.sidemenu.admin')
            @elseif ( Auth::user()->Profile->role_id == 2 )
            @include('partials.sidemenu.admin')
            @elseif ( Auth::user()->Profile->role_id == 3 )
            @include('partials.sidemenu.cashier')
            @elseif ( Auth::user()->Profile->role_id == 4 )
            @include('partials.sidemenu.moderator')
            @elseif ( Auth::user()->Profile->role_id == 5 )
            @include('partials.sidemenu.moderator')
            @elseif ( Auth::user()->Profile->role_id == 6 )
            @include('partials.sidemenu.moderator')
            @elseif ( Auth::user()->Profile->role_id == 8 )
            @include('partials.sidemenu.moderator')
            @elseif ( Auth::user()->Profile->role_id == 9 )
            @include('partials.sidemenu.sponsor')
            @elseif ( Auth::user()->Profile->role_id == 10 )
            @include('partials.sidemenu.customer')
            @endif
          </div>
          <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container px-xl-5 mt-5 mb-5">
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
            <footer class="footer bg-white shadow align-self-end py-3 mt-3 px-xl-5 w-100">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 text-center text-md-left text-primary">
                    <p class="mb-2 mb-md-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> {{ $portal->Organization->organization_name }}</p>
                  </div>
                  <div class="col-md-6 text-center text-md-right text-gray-400">
                    <p class="mb-0">Powered by <a href="https://appealbox.africa" class="external text-gray-400">AppealPlus</a></p>
                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                  </div>
                </div>
              </div>
            </footer>
          </div>
        </div>
@endguest



    <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
  <script src="{{ asset('js/admin/charts-home.js')}}"></script>
  <script src="{{ asset('js/admin/front.js')}}"></script>
  <script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('lib/stickyjs/sticky.js')}}" defer></script>
  <script src="{{ asset('js/select2.js')}}"></script>
    <script>
      jQuery(document).ready(function($) {
        $('.select2').select2();
        $(document).ready(function() {
        if ($.fn.DataTable && $('#table').length) {
          $('#table').DataTable();
        }
        } );
      });
    </script>
     @stack('scripts')
</body>
</html>
