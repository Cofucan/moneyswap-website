@extends('layouts.theme')
@push('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('css/board.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('css/customselect.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/donate.css') }}">
<style>
    .myDiv{
        display:none;
    }
    #live_loading{
        visibility:hidden;
    }
    .body-text{
        line-height: 30px;
    }
    .title-lg{
        color: #003399;
        font-weight: 700;
        text-transform: uppercase;
    }
</style>
@endpush

@section('content')

    <section class=" section-padding d-flex align-items-center ">
        <div class="container d-flex align-items-center mx-auto">
            <div class="card card0">
                <div class="d-flex flex-lg-row flex-column">
                    <div class="card card2 set-bg page-banner" data-setbg="{{ asset('img/background/donate-now.jpg') }}">
                        <div class="my-auto mx-md-5 px-md-5 right text-white">
                            <h3 class="text-white mb-4">Request Submitted</h3>
                            <h5 class="body-text text-white mb-5">Your request has been submitted successfully, We will get back to your shortly</h5>
                        </div>
                    </div>
                    <div class="card card1">
                        <div class="row justify-content-center">
                            <div class="col-md-9 col-10 my-2">
                                @include('partials.alert')
                                
                                <p><b>Name:</b> {{ $beneficiary->full_name }}</p>                  
                                <p><b>Location:</b> {{ $beneficiary->location }}</p>                  
                                <p><b>Telephone:</b> {{ $beneficiary->telephone }}</p>                  
                                <p><b>Email:</b> {{ $beneficiary->email ?? 'N/A' }}</p>                  
                                <p><b>Purpose:</b> {{ $beneficiary->service }}</p>    
                                <hr>
                                {!! $beneficiary->remarks !!} 
        
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('js/theme2/jquery-migrate-3.0.1.min.js')}}" defer></script>
<script src="{{ asset('js/theme2/popper.min.js')}}" defer></script>
<script src="{{ asset('js/theme2/jquery.waypoints.min.js')}}" defer></script>
<script src="{{ asset('js/theme2/jquery.stellar.min.js')}}" defer></script>
<script src="{{ asset('js/theme2/main.js')}}" defer></script>
<script src="{{ asset('js/select2.js')}}"></script>
@endpush
