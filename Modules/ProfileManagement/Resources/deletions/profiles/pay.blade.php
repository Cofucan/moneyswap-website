@extends('layouts.signin')

@section('content')

<section class="login-body d-flex align-items-center">
<div class="container px-3 py-4 mx-auto d-flex align-items-center">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            {{-- <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5">
                    <h3 class="text-white">{{$page->headline}}</h3>
                    <div class="text-white">
                    {!!$page->body!!}
                    </div>
                </div>
            </div> --}}
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-9 col-10">
                        <div class="row justify-content-center px-3 mb-3">
                            <a href="{{ url('/') }}">  <img id="logo" src="{{asset($portal->logo)}}"></a>
                        </div>
                        <h3 class="mt-4 mb-4 text-center heading">Make Payment</h3>
                        <div class="col-md-9 col-sm-9 order-sm-1 order-md-1">
                            <p><strong>Name: </strong> Member Name</p>
                            <p><strong>Investment Plan:</strong> {{ $investment->InvestmentPlan->Package->name }}</p>
                            <p><strong>Amount Invested: </strong>{{ $investment->amount_invested }}</p>
                            <p><strong>Processing Fee:</strong> {{ number_format($investment->processing_fee,2) }}</p>
                            <p><strong>Total Amount Due:</strong> {{ $investment->Invoice->currency }} {{number_format($investment->Invoice->amount_due,2)}}</p>
                            <p><strong>Investment Duration:</strong> {{ $investment->InvestmentPlan->roi }}</p>
                            <p><strong>Monthly Returns:</strong> {{ $investment->roi}}</p>
                            <p><strong>Date Submitted:</strong> {{ $investment->InvestmentPlan->created_at}}</p>
                          </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
</section>

@endsection