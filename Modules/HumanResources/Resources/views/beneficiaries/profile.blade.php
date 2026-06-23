@extends('layouts.admin')
 @section('page_title')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')


        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Stage
            </span>
        </div>

    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="box-white">
                <div class="text-center mb-3">
                    <h4 class="mb-2">Membership Stage:</h4>
                    <h3 class="mb-2">{{  $member->Milestone->milestone_name }}</h3>
                    <h5>Activated Referral: <strong>{{  $member->referrals }}</strong></h5>
                </div>
               
                
                <div class="row no-gutter mb-3" id="refer">
                    <div class="col-md-2 offset-md-1 col-sm-3 text-center">  
                        <img src="{{asset ('images/icons/tbc.jpg')}}" alt="The Billion Coin">
                    </div>
                    <div class="col-md-5 col-sm-6 mt-2 text-center">
                            <h5>Available Balance: <strong>NGN {{ number_format( $member->available_balance,2)}}</strong></h5>
                            <h5>Ledger Balance: <strong>NGN {{ number_format( $member->available_balance,2)}}</strong></h5>
                        <p class="mt-4">Refer a friend to increase your earnings</p>
                        <a href="{{url ('invitations/create')}}" class="btn btn-success btn-sm"> Refer a Friend</a>
                    </div>
                    <div class="col-md-2 col-sm-3 text-center">
                        <img src="{{asset ('images/icons/bonus.jpg')}}" alt="Bonus Bag">
                    </div>
                   
                </div>
                <div class="row mt-5">
                    <div class="col-md-3  col-sm-6">
                        <a href="{{url ('invitations/create')}}" class="btn btn-danger btn-block btn-sm"> Cashout</a>
                    </div>
                    <div class="col-md-2 offset-md-7">
                        <h4>{{  $member->shopping_count }} / {{$member->Milestone->noreferral_shopping_limit}}</h4>                                                
                        <h5>Shopping Count</h5>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>

        {{-- <div class="box-white">
            <div class="text-center mb-3">
                <h4 class="mb-2">Membership Stage:</h4>
                <h3 class="mb-2">{{  $member->Milestone->milestone_name }}</h3>
                <h5>Activated Referral: <strong>{{  $member->referrals }}</strong></h5>
            </div>
           
            
            <div class="row no-gutter mb-3" id="refer">
                <div class="col-md-2 offset-md-2 col-sm-3 text-center">  
                    <img src="{{asset ('images/icons/tbc.jpg')}}" alt="The Billion Coin">
                </div>
                <div class="col-md-4 col-sm-6 mt-2 text-center">
                    <p>Refer a friend to increase your stage and earn 10% on each level reached</p>
                    <a href="{{url ('invitations/create')}}" class="btn btn-success btn-sm"> Refer a Friend and Earn</a>
                </div>
                <div class="col-md-2 col-sm-3 text-center">
                    <img src="{{asset ('images/icons/bonus.jpg')}}" alt="Bonus Bag">
                </div>
               
            </div>
            <div class="row mt-5">
                <div class="col-md-2 offset-md-1 col-sm-6">
                    <h4>{{  $member->referrals }}</h4>
                    <h5>Total Referrals</h5>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>NGN {{ number_format( $member->available_balance,2)}}</h4>
                    <h5>Available Balance</h5>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>NGN {{ number_format( $member->available_balance,2)}}</h4>                                                
                    <h5>Ledger Balance</h5>
                </div>
                <div class="col-md-2 col-sm-6">
                    <h4>{{  $member->shopping_count }} / {{$member->Milestone->noreferral_shopping_limit}}</h4>                                                
                    <h5>Shopping Count</h5>
                </div>
            </div>
        </div> --}}




   


@endsection
