<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('page_title') | {{$portal->portal_name}}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="{{ asset('img/fav-icon.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?sponsor=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset ('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('plugins/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">

  <link href="{{ asset ('css/member-print.css')}}" rel="stylesheet">
  <style>
   #live_loading{
   visibility:hidden;
   }
    </style>

  @stack('style')

</head>
<body id="body"  onload="window.print();">
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset ('img/print/logo.jpg') }}" alt="Royal Regency Logo" class="">
            </div>
            <div class="col-md-9">
                <h1>Royal Regency Schools</h1>

                <p> <i class="fa fa-map-marker"></i>: 8/10 Wale Oyefisan Close, Off KC Bus-Stop, Addo-Badore Road, Ajah, Lagos</p>
                <div class="row">
                    <div class="col-md-5">
                        <p> <i class="fa fa-phone-square"></i>: 0802-307-1802, 0803-344-1599</p>
                    </div>
                    <div class="col-md-5">
                        <p> <i class="fa fa-envelope-square"></i>: info@royalregency.sch.ng </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="procedure">
    <div class="container">
        <h2>Member Procedure</h2>
        <div class="row">
            <ul>
                <li><b>STEP 1:</b> Obtain an application form (N30,000.00)or complete an on-line form</li>
                <li><b>STEP 2:</b> Submit completed application form with the required documents accordingly</li>
                <li><b>STEP 3:</b> Choose entrance examination centre and date to take the assessment.</li>
                <li><b>STEP 4:</b> An offer of provisional member is made to a successful client pending the revenue of the acceptance fees.</li>
                <li><b>STEP 5:</b> The acceptance fees has to be paid by the date indicated on the member/offer letter in order to secure or guarantee a place at SchoolMag.</li>
            </ul>
        </div>
    </div>
</section>

<section class="procedure">
    <div class="container">
        <h2>Requirements & Eligibility</h2>
        <h5>Creche</h5>
        <div class="row">
            <ul id="member_requirement">
                <li>Obtain an application form (N30,000.00)or complete an on-line form</li>
                <li>Submit completed application form with the required documents accordingly</li>
                <li>Choose entrance examination centre and date to take the assessment.</li>
                <li>An offer of provisional member is made to a successful client pending the revenue of the acceptance fees.</li>
                <li>The acceptance fees has to be paid by the date indicated on the member/offer letter in order to secure or guarantee a place at SchoolMag.</li>
            </ul>
        </div>
        <h5>Nursery</h5>
        <div class="row">
            <ul id="member_requirement">
                <li>Obtain an application form (N30,000.00)or complete an on-line form</li>
                <li>Submit completed application form with the required documents accordingly</li>
                <li>Choose entrance examination centre and date to take the assessment.</li>
                <li>An offer of provisional member is made to a successful client pending the revenue of the acceptance fees.</li>
                <li>The acceptance fees has to be paid by the date indicated on the member/offer letter in order to secure or guarantee a place at SchoolMag.</li>
            </ul>
        </div>
        <h5>Primary</h5>
        <div class="row">
            <ul id="member_requirement">
                <li>Obtain an application form (N30,000.00)or complete an on-line form</li>
                <li>Submit completed application form with the required documents accordingly</li>
                <li>Choose entrance examination centre and date to take the assessment.</li>
                <li>An offer of provisional member is made to a successful client pending the revenue of the acceptance fees.</li>
                <li>The acceptance fees has to be paid by the date indicated on the member/offer letter in order to secure or guarantee a place at SchoolMag.</li>
            </ul>
        </div>
        <h5>College</h5>
        <div class="row">
            <ul id="member_requirement">
                <li>Obtain an application form (N30,000.00)or complete an on-line form</li>
                <li>Submit completed application form with the required documents accordingly</li>
                <li>Choose entrance examination centre and date to take the assessment.</li>
                <li>An offer of provisional member is made to a successful client pending the revenue of the acceptance fees.</li>
                <li>The acceptance fees has to be paid by the date indicated on the member/offer letter in order to secure or guarantee a place at SchoolMag.</li>
            </ul>
        </div>
    </div>
</section>



  <!-- Required JavaScript Libraries -->
  <script src="{{ asset ('plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset ('plugins/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{ asset ('plugins/superfish/hoverIntent.js')}}"></script>
  <script src="{{ asset ('plugins/superfish/superfish.min.js')}}"></script>
  <script src="{{ asset ('plugins/tether/js/tether.min.js')}}"></script>
  <script src="{{ asset ('plugins/stellar/stellar.min.js') }}"></script>
  <script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset ('plugins/counterup/counterup.min.js')}}"></script>
  <script src="{{ asset ('plugins/waypoints/waypoints.min.js')}}"></script>
  <script src="{{ asset ('plugins/easing/easing.js')}}"></script>
  <script src="{{ asset ('plugins/stickyjs/sticky.js')}}"></script>
  <script src="{{ asset ('plugins/parallax/parallax.js')}}"></script>
  <script src="{{ asset ('plugins/lockfixed/lockfixed.min.js')}}"></script>

  <!-- Template Javascript File -->
  <script src="{{ asset('js/main.js')}}"></script>
  <script src="{{ asset('js/script.js')}}"></script>

</body>
</html>
