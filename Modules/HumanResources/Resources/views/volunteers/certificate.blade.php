@extends('layouts.slip')
@section('page_title', 'Volunteer Certificate | ' .$volunteer->label   )
@push('styles')
<link href="{{ asset ('css/certificate.css') }}" rel="stylesheet">
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link href="{{ asset ('css/util.css')}}" rel="stylesheet">
<style>
  .pay_to tr{
    line-height: 25px;
  }
</style>
@endpush

@section('content')

<div class="container" >
    <div class="volunteer-body">
        <div class="header">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <img src="{{asset ($portal->Organization->favicon) }}" alt="{{$portal->Organization->legal_name}}">
                </div>
                <div class="col-md-9 col-sm-9">
                    <h1>{{$portal->Organization->legal_name}}</h1>                
                    <h5><i class="fa fa-globe"></i>: {{$portal->custom_url}} | <i class="fa fa-envelope-square"></i>: {{$portal->email}}</h5>
                        
                </div>
            </div>            
        </div>
        <div class="row" id="content">
            <div class="col-md-8 offset-md-2 text-center">
                <h2 class="title">Certificate of Volunteer</h2>
                <p class="portfolio">Portfolio No.: {{ $volunteer->portfolio_no }}</p>
                <h5 class="subtitle">This is to certify that </h5>
                <h3 class="name"> {{ $volunteer->Member->Person->full_name }}</h3>
                <h5 class="subtitle">in recognition of volunteers on </h5>
                <h2 class="package text-center">{{ $volunteer->InvestmentPlan->Package->name }} Package</h2>
                <h4 class="invest">of Cashflow Investments</h4>
                <div class="row mt-3">
                    <div class="col-md-6 col-sm-6">
                        <p><Strong>Commence At: </Strong> <u>{{ $volunteer->commencement }}</u></p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <p><Strong>End At: </Strong> <u>{{ $volunteer->maturity }}</u></p>
                    </div>
                    <div class="col-md-6 offset-md-3 signature text-center">
                        <img src="{{ asset('icons/signature.jpg') }}" alt="sign">
                        <p>GMC President</p>
                    </div>
                </div>

            </div>
            <div class="col-md-2" id="medal">
               
                <img src="{{ asset($volunteer->InvestmentPlan->Package->display_medal) }}" alt="" height=200px;>
            </div>
        </div>
    </div>
  
</div>

@endsection




