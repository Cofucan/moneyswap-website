@extends('layouts.blank')
@section('page_title',  $volunteer->reference_code)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/pricing.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
  .myDiv{
      display:none;
  } 
  .price-card p:last-child{
    margin-bottom: 0px;
  }

</style>
@endpush
@section('content')

<section class="price section-padding bg-light-blue">
  <div class="container">
    <div class="row"> 
                 
      <div class="col-md-10 col-sm-12 mt-3">
          <div class="card price-card">            
            <div class="card-body">
              <div class="main_title">
                <h2><span>{{ $portal->Organization->trading_name }}</span></h2>
                @include('partials.alert')
                <h3>Volunteer Details ({{ $volunteer->reference_code }})</h3>
              </div>
              <div class="corner-ribbon">
                {{$volunteer->status}}
              </div>
              <div class="row">
                <div class="col-md-3 col-sm-3 order-sm-2 order-md-2">
                  <img src="{{ asset ($volunteer->Member->Person->passport_photo )}}" alt="Person Picture" class="avatar img-circle img-thumbnail">
                </div>
                <div class="col-md-9 col-sm-9 order-sm-1 order-md-1">
                  <p><strong>Investor: </strong> {{ $volunteer->Member->Person->full_name }}</p>
                  <p><strong>Volunteer Plan:</strong> {{ $volunteer->InvestmentPlan->Package->name }}</p>
                  <p><strong>Amount Invested: </strong>{{ $volunteer->amount_invested }}</p>
                  <p><strong>Processing Fee:</strong> {{ number_format($volunteer->processing_fee,2) }}</p>
                  <p><strong>Total Amount Due:</strong> {{ $volunteer->Invoice->currency }} {{number_format($volunteer->Invoice->amount_due,2)}}</p>
                  <p><strong>Volunteer Duration:</strong> {{ $volunteer->InvestmentPlan->roi }}</p>
                  <p><strong>Monthly Returns:</strong> {{ $volunteer->roi}}</p>
                  <p><strong>Date Submitted:</strong> {{ $volunteer->InvestmentPlan->created_at}}</p>
                </div>
              </div>
             
            </div>
              @if ($volunteer->status == 'Pending')
              <div class="row">
                <div class="col-md-12 p-l-20">
                  <hr>
                  <h5>Instructions:</h5>
                  {!! $page->content_body !!} 
                </div>
                <div class="col-md-6 p-l-30">
                  <p> <strong>Bank Account Details</strong></p>
                  <div class="text-left">
                  @include('bankaccounts._show')
                  </div>
                </div>
                <div class="col-md-6">
                  <p> <strong>Bitcoin Wallet</strong></p>
                  <div class="row wallet">
                    <div class="col-md-3">
                    <img src="{{asset('images/icons/bitcoin-qrcode.jpg')}}" alt="QR-Code" height="100px">
                    </div>
                    <div class="col-md-9">
                      <p class="text-left text-danger"><strong> Make transfer to our  wallet with the code</strong></p>
                      <h6 class="mt-3 text-left">1Kp5xPCr3uaBfGhPdPChcecUDkzEYG5Rq1</h6>
                    </div>                   
                  </div> 

                </div>
              </div>
              {{-- <a class="btn btn-success" href="{{ route('invoices.show', $volunteer->Invoice->id) }}" target="_blank">View Invoice </a> --}}
              {{-- <a class="btn btn-danger" href="#bankaccount"  data-toggle="modal" data-target="#bankaccount">Pay Here </a> --}}
              {{-- <a class="btn btn-danger" href="{{ route('invoices.preview', $volunteer->Invoice->id) }}" target="_blank">Pay Here </a> --}}
        
            </div>
              @endif
          </div>
      </div>
      <div class="col-md-4 offset-md-1">
        
      </div>
    </div>
  </div>
</section>
   
@include('bankaccounts._modal')

@endsection

@push('scripts')
<script>

  jQuery(document).ready(function($){      
      $('input[type="radio"]').click(function(){
              var demovalue = $(this).val();
              $("div.myDiv").hide();
              $("#show"+demovalue).show();
          });
  });

</script>


@endpush