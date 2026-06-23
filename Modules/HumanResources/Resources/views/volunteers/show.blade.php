@extends('layouts.admin')
@section('page_title',  $volunteer->reference_code)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/pricing.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')

<div class="container-fluid">
  <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
     <div class="col-md-7 col-sm-12">
         <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
         </a>

         @if (Auth::user()->Person->Member->id == $volunteer->member_id)
          <a href="{{ url ('volunteers/manage')}}" class="s-text16">
              My Investments
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            @elseif(Auth::user()->profile->role_id == 1 || Auth::user()->profile->role_id == 3 || Auth::user()->profile->role_id == 4)
            <a href="{{ url ('volunteers/home')}}" class="s-text16">
              Investments
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
         @endif

         <span class="s-text16">
             {{ $volunteer->reference_code }}
         </span>
     </div>
    <div class="col-md-5 col-sm-12">


    </div>
 </div>
    <div class="row">
      <div class="col-md-8">
        <div class="box-padding card price-card">
          <div class="corner-ribbon">
            {{$volunteer->status}}
          </div>
          @if (Auth::user()->profile->role_id == 1 || Auth::user()->profile->role_id == 3 || Auth::user()->profile->role_id == 4)
              <h5><b>Investor:</b> {{ $volunteer->Member->Person->full_name }}</h5>
          @endif

          <div class="row">
            <div class="col-md-6 col-sm-6 mb-2">
              <span><strong>Volunteer Plan: {{ $volunteer->InvestmentPlan->Package->name }}</strong> </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Amount Invested: </b> {{ $volunteer->amount_invested }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Volunteer Duration:</b> {{ $volunteer->InvestmentPlan->duration }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Amount Charged:</b> {{ $volunteer->processing_fee }} </span>
            </div>
            <div class="col-md-6 col-sm-6  mb-2">
              <span><b>Expected Return: </b>  {{ number_format($volunteer->total_roi,2) }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Monthly Returns: </b> {{ $volunteer->payment_method}} {{ $volunteer->monthly_return }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Total Payment on Maturity: </b> {{ $volunteer->payment_method}} {{ $volunteer->total_returns }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Commence At: </b> {{ $volunteer->commence_at }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
              <span><b>Mature At:</b> {{ $volunteer->mature_at }} </span>
            </div>
            <div class="col-md-6 col-sm-6 mb-2">
               <a href="{{ route('invoices.show', $volunteer->Invoice->id) }}" class="btn btn-sm btn-primary mb-2"> View Invoice for payments</a>
                @if ($volunteer->status == 'Approved')
                <a class="btn btn-danger btn-sm" href="{{ route('volunteers.certificate', $volunteer->reference_code) }}" target="_blank">View Certificate</a>
                @elseif($volunteer->status =='Pending')
                @endif
            </div>
          </div>
        </div>
        @if ($volunteer->status <> 'Pending')
        <h5 class="mt-4">Monthly Returns Schedule</h5>
        <div class="mb-table d-lg-none">
          <div class="row">
            @foreach ($volunteer->InvestmentReturns as $return)
              <div class="col-sm-6 mb-3">
                <div class="card">
                  <div class="py-3 px-3">
                    <strong>Amount: {{ number_format($return->amount,2) }}</strong> <br>
                    <strong>Due At:</strong> {{ $return->due_at }} <br>
                    <strong>Amount Received: </strong> {{ number_format($return->received_amount,2) }} <br>
                    <strong>Status: </strong>{{ $return->status }} <br>
                    <div class="text-center">
                      @include('investmentreturns._action')
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="lg-table">
          <table class="table mt-2 table-responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Amount</th>
                <th>Due At</th>
                <th>Amount Received</th>
                <th>Acknowledge At</th>
                <th>status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($volunteer->InvestmentReturns as $return)
              <tr>
                <td>{{ $return->sequence_no }}</td>
                <td>{{ $volunteer->payment_method }} {{ number_format($return->amount,2) }}</td>
                <td>{{ $return->due_at }}</td>
                <td>{{ number_format($return->received_amount,2) }}</td>
                <td>  {{ $return->acknowledged_at }}</td>
                <td>{{ $return->status }}</td>
                <td>

                    @include('humanresources::investmentreturns._action')

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>


        @endif
      </div>
      <div class="col-md-4">
           @if ($volunteer->Member->MemberAccounts->count() > 0 && Auth::user()->profile->role_id == 1)
            <div class="box-padding card price-card">
              <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Details</th>



                    </tr>
                </thead>
                <tbody >
                    @foreach($volunteer->Member->Memberaccounts as $memberaccount)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td> <strong>{{$memberaccount->Bank->Organization->legal_name}} </strong><br>
                            {{$memberaccount->account_name}} <br>
                            {{$memberaccount->account_number}}
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            </div>

           @endif
      </div>

    </div>

@endsection

@push('scripts')
  <script src="{{ asset('js/script.js')}}"></script>
  <script src="{{ asset('js/select2.js')}}"></script>
  <script>
    jQuery(document).ready(function($) {
      $('.select2').select2();
      });
  </script>
  {{-- <script src="{{ asset ('plugins/nice-select/js/jquery.nice-select.min.js') }}"></script> --}}

@endpush
