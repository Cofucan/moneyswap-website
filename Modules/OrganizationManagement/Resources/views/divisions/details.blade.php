@extends('layouts.newtheme')
@section('page_title', $division->label )
@push('style')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/skoojob.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/jobs.css') }}">
@endpush
@section('content')

@section('menu')
    @include('partials.candidate-header')
@endsection

<section id="page-hero" class="d-flex align-items-center">

  
</section>

    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                
                <div class="col-md-9">
                  <h3>{{  $division->label }}</h3>
                    <a href="{{url('/divisions')}}"> Job Functions</a>
                    <i class="fa fa-angle-double-right"></i>

                    

                    <a href="{{url('/divisions')}}" class="active"> {{ $division->label}}</a>
                </div>

                <div class="col-md-3">
                    <span>Share on </span><br>{!! $shared !!} 
                </div>
            </div>
        </div>
    </section>

<section class="explore-division">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row mb-4">
                    <div class="col-md-12 order-md-2">
                        <div id="content">
                            <p class="text-justify">
                                {!!  $division->overview !!}
                            </p>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 order-md-1">
                        <div id="image-holder">
                            <img src="{{asset ('icons/educators.jpg')}}" alt="Educators">  
                        </div>
                    </div> --}}
                </div>
                <h4 class="head-line mt-5">{{ $division->label }} Job Roles </h4>
                <ul class="mb-5">
                    <div class="row">
                    @foreach($division->Designations as $designation)
                        <div class="col-md-4">
                            <li> <a href="{{ route('designations.details', $designation->slug)}}">{{$designation->job_role }}</a> </li>
                        </div>
                    @endforeach

                    </div>
                </ul>
               
            </div>  
            <div class="col-md-3">
                
                @include('vacancies._verticalfeatured')
            </div>
        </div>
    </div>
</section>



<section class="start-hiring section-bg">
    <div class="container">
        <div class="row"> 
        <div class="col-md-8">
            
            <h4>Looking for Top educators or administrators in Your Area?</h4>
            <h6>Post your vacancies on the choice education platform in the country and receive applications in minutes </h6>
            </div>
            <div class="col-md-2 offset-md-2">
            <a href="{{ url('divisions') }}" class="btn btn-block btn-hiring">Start Hiring</a>
            </div>
        </div>
    </div>
</section>

   
 

 @endsection
@push('script')
<script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>

@endpush
