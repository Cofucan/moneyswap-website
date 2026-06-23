@extends('layouts.theme')
@push('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/board.css') }}" rel="stylesheet">
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

<section class="login-body d-flex align-items-center ">
    <div class="container d-flex align-items-center px-3 py-2 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column">
                <div class="card card2 set-bg page-banner" data-setbg="{{ asset('img/background/donate-now.jpg') }}">
                    <div class="my-auto mx-md-5 px-md-5 right text-white">
                        <h3 class="text-white mb-5">{{ $page->headline }}</h3>
                        {!! $page->body !!}
                    </div>
                </div>
                <div class="card card1">
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-10 my-2">
                            @include('partials.alert')
                            <h4 class="text-center title-lg mb-2">Send Request</h4>
                            <hr>
                            <form method="POST" action="{{ route('beneficiaries.store') }}" class="form">
                                @csrf
                                
                                @include('humanresources::beneficiaries._form')
                                <div class="row justify-content-center my-3 px-3">
                                    <button class="btn-block btn-color"> Submit</button> 
                                </div>

                            </form>
    
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
