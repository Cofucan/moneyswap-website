@extends('layouts.admin')
 @section('page_title', $advice->Invoice->invoice_title )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <a href="{{ url ('home')}}" class="s-text16">
                        <i class="fa fa-home"></i> Dashboard
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>
                    <a href="{{ url ('advices/manage', Session::get('profile_id'))}}" class="s-text16">
                       Payment Advices
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>
                    <span class="s-text17">
                    {{ $advice->Invoice->invoice_title  }}
                    </span>
                </div>

            </div>
        </div>
        <div class="row">


        </div>

    <div class="row p-t-10">
        <div class="col-md-10 mb-3 content_title">
            {{--  <p>The advice transaction was successful. Find below the details of the transaction. </p>  --}}
        </div>

        <div class="col-12 col-sm-6 col-md-5 p-b-10">
            <div class="form-group">
                <strong>Reference Code :</strong>
                <span class="pull-right">{{ $advice->reference_code }}</span>
            </div>

            <div class="form-group text-success">
                <strong>Amount Due:
                <span class="pull-right">{{ $advice->currency }} {{ number_format($advice->amount, 2)}}</span></strong>
            </div>

            <div class="form-group text-primary">
                <strong>Transaction Fee:
                <span class="pull-right">{{ $advice->currency }} {{ number_format($advice->transaction_fee, 2)}}</span></strong>
            </div>

            <div class="form-group text-danger">
                <strong> Amount charged:
                <span class="pull-right">{{ $advice->currency }} {{ number_format($advice->amount_charged, 2)}}</span></strong>
            </div>

            <div class="form-group">
                <strong>Payment Email :</strong>
                <span class="pull-right">{{ $advice->email }}</span>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 offset-md-2 p-b-10">
            <div class="form-group">
                <strong>Status:</strong>
                <span class="pull-right"> {{ $advice->status }} </span>
                @if ( Auth::user()->profile->role_id == 4 )
                @include('paymentmanagement::advices._action')
                @endif
            </div>

            <div class="form-group">
                <strong>Invoice.:</strong>
                <span class="pull-right"> {{ $advice->Invoice->ref_code }} </span>
            </div>

            <div class="form-group">
                <strong>Date Paid:</strong>
                <span class="pull-right">{{ $advice->value_date  }}</span>
            </div>

            <div class="form-group">
                <strong>Payment Type:</strong>
                <span class="pull-right">{{ $advice->payment_type  }}</span>
            </div>

            <div class="form-group">
                <strong>Payer Telephone :</strong>
                <span class="pull-right">{{ $advice->telephone }}</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group school-image">
                <strong>Remarks:</strong>
                {!! $advice->remarks  !!}
            </div>
        </div>

        {{-- <div class="col-xs-12 col-sm-12 col-md-4">

            <div class="form-group school-image">
                <strong></strong>
                <img src="{{asset ($advice->reference_document)}}" alt="Referenc Document">
            </div>
        </div> --}}

    </div>
</div>



@endsection
