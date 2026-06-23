@extends('layouts.gradebook')
@section('page_title', $agent->Profile->full_name)
@push('styles')
<link href="{{ asset('css/receipt.css') }}" rel="stylesheet">
<link href="{{ asset('css/board.css') }}" rel="stylesheet">
<link href="{{ asset('css/customselect.css') }}" rel="stylesheet">
<style>
    .myDiv{
        display:none;
    }
    .form-card h6{
      font-size: 16px;
      font-weight: bold;
      color: #003399;
    }
    .form-card p{
      font-size: 15px;
      margin-bottom: 10px;
    }
</style>
@endpush
@section('content')

    <div class="container mt-lg-5">
      @include('partials.basicheader')

      <div class="row">
        <div class="col-md-11 offset-md-1">
            <hr>
            <div class="text-center">
                <h5>{{$agent->Profile->full_name}} </h5>
                <h5> <i class="fa fa-phone"></i>
                     @foreach ($agent->profile->telephones as $telephone)
                    {{$telephone->phone_number}}
                    @if($loop->last)
                    @break
                    @endif
                    ,
                    @endforeach
                </h5>
            </div>
            <div class="row mt-4 mb-5">
            @foreach ($agent->Clients as $client)
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>{{$client->name}} </h6>

                                <div class="row">
                                    <div class="col-md-5 col-5">
                                    <img src="{{asset ($client->Profile->passport)}}" class="w-100"/>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        <p><b>Amount Due: </b> {{ $client->amount_owed }}</p>
                                        <h6><b>Acct No.: 0015100057</b></h6>
                                        <p><b>Act Name:</b> {{$client->name}}  </p>
                                        <p><b>Bank:</b> Fidelity Bank</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>
      </div>
    </div>

  @endsection
@push('scripts')
<script>
  jQuery(document).ready(function($){
      $('input[name="transaction_method_id"]').click(function(){
      var demovalue = $(this).val();
      $("div.myDiv").hide();
      $("#show"+demovalue).show();
      });
  });
</script>

@endpush
