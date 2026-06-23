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
  <!-- <link href="https://fonts.googleapis.com/css?sponsor=Raleway:400,500,700|Roboto:400,900" rel="stylesheet"> -->

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset ('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{ asset ('css/util.css')}}" rel="stylesheet">
  <link href="{{ asset ('css/admission-print.css')}}" rel="stylesheet">
  <style>
   #live_loading{
   visibility:hidden;
   }
    </style>

</head>
<body id="body">
<header>
    <div class="container">

                <div class="row">
                    <div class="col-md-2">
                        <img src="{{asset ($portal->thumbnail) }}" alt="{{$portal->portal_name}}" class="">
                    </div>
                    <div class="col-md-7">
                        <h1>{{$portal->portal_name}}</h1>
                        <h4>{{$portal->slogan}}</h4>
                        <p> <i class="fa fa-map-marker"></i>: {{$portal->Address->address_prefix }} {{$portal->Address->address_no }} {{$portal->Address->street_name }}, {{$portal->Address->Neighbourhood->neighbourhood_name }},
                        {{$portal->Address->Neighbourhood->City->city_name }}, {{$portal->Address->Neighbourhood->City->State->state_name }} </p>
                        <div class="row">
                            <div class="col-md-6">
                                <p> <i class="fa fa-phone-square"></i>: {{$portal->portal_phonenumber}}</p>
                            </div>
                            <div class="col-md-6">
                                <p> <i class="fa fa-envelope-square"></i>: {{$portal->portal_email}} </p>
                            </div>

                            <div class="col-md-6">
                                <p> <i class="fa fa-globe"></i>: {{$portal->custom_url}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 application-id">
                        <img src="{{ asset( $vacancy->avatar )}}" class="avatar img-circle img-thumbnail " alt="{{  $vacancy->Person->vacancy_title }}">
                        <span class="text-center"> <b> 00000{{  $vacancy->id }} </b></span>
                    </div>
                </div>

    </div>
</header>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

  <!--==========================
      What We Do Section
    ============================-->
    <div class="container enquiry p-b-20 p-t-20">
          <div class="row">
                <div class="col-md-12 ">
                    <h3>Application Form</h3>

                    @include('vacancies.regdata')
                     <hr>

                </div>

                <div class="col-md-4 side">
                </div>

            </div>
        </div>
 <!-- Required JavaScript Libraries -->



 <script src="{{ asset ('plugins/stellar/stellar.min.js') }}"></script>
  <script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



  <!-- Template Javascript File -->


</body>
</html>

