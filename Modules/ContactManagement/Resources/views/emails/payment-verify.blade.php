<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> Revenue Receipt | confirmation</title>
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

  <link href="{{ asset ('css/util.css')}}" rel="stylesheet">
  <link href="{{ asset ('css/receipt.css')}}" rel="stylesheet">
  <style>
   #live_loading{
   visibility:hidden;
   }
    </style>

</head>
{{-- <body onload="window.print();"> --}}
<body>
        <section id="status-body">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-12 header">
                        <div class="row">
                        <div class="col-md-2">
                            <img src="{{asset ($portal->thumbnail) }}" alt="{{$portal->portal_name}}" class="pull-right">
                        </div>
                        <div class="col-md-10 text-left">
                            <h1>{{$portal->portal_name}}</h1>
                            <h4 >{{$portal->slogan}}</h4>
                            <p > <i class="fa fa-map-marker"></i>: {{$portal->Address->address_prefix }} {{$portal->Address->address_no }} {{$portal->Address->street_name }}, {{$portal->Address->Neighbourhood->neighbourhood_name }},
                                {{$portal->Address->Neighbourhood->City->city_name }}, {{$portal->Address->Neighbourhood->City->State->state_name }} </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p> <i class="fa fa-phone-square"></i>: {{$portal->portal_phonenumber}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p> <i class="fa fa-envelope-square"></i>: {{$portal->portal_email}} </p>
                                    </div>

                                    <div class="col-md-4">
                                        <p> <i class="fa fa-globe"></i>: {{$portal->custom_url}} </p>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 ">
                                <p> Dear profilename</p>
                        </div>
                        <div class="col-md-3 offset-md-2">
                                <div class="receipt-date mt-2">
                                <div class="row">
                                    <div class="col-md-5 ">
                                        <div class="title">
                                            <h5 > Date: </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-7"> </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3 receipt offset-md-4 mb-3">
                                <h4 class="text-center">Revenue Status</h4>
                            </div>
                    </div>


                    <!-- row begins-->
                    <div class="row">

                       <p>The revenue transaction was successful. Find below the details of the transaction. </p>

                        <div class="col-md-12 text-justify">
                                <p class="p-l-20"><b>Status:</b> Approved by Financial Institution. </p>
                                <p class="p-l-20"><b>Amount:</b> N7,200.00 (Fee: N109.64) </p>
                                <p class="p-l-20"><b>Response Code:</b> 00 </p>
                                <p class="p-l-20"><b>Transaction Ref No:</b> GTB|Web|3PWQ0001|WGH|110218112129|9PCCUJJM </p>
                        </div>
                        <!-- client info begins -->

                        <p>If you have any issues with this transaction, do not hesitate to send us a mail at billing@zuluinvestment.com stating the transaction reference number. </p>

                    </div>

                    <div class="row ">
                        <div class="col-md-11 generated text-center">
                            <p>Generated On: <u>{{ date('d/m/Y H:i:s') }}</u> with <b>SchoolMag</b></p>
                        </div>
                    </div>
                    <!-- row ends-->
                </div>
        </section>


  <!--==========================
      Intro Section
    ============================-->





</body>
</html>




