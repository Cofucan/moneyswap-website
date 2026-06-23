
@extends('layouts.newtheme')
@section('page_title',$page->headline )

@push('style')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/skoojob.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/jobs.css') }}">
{{--  <link rel="stylesheet" href="{{ asset ('css/employer.css') }}">     --}}
@endpush

@section('menu')
   @include('partials.candidate-header') 
@endsection

@section('content')


<section id="division-hero" class="d-flex align-items-center">

  <div class="container"> 
    <div class="row">
    <div class="col-md-9 offset-md-1">
    <div class="division-title">
        <h1>{{ $page->headline }}</h1>
        <h2 class="text-white">{!! $page->body !!} </h2>
      </div>  

      </div>
    </div>  
  </div>

</section>


<section class="">
  <div class="container-fluid division-tools">
    
    <div class="section-title">
      <h2>Education Level</h2>
    </div>
    <div class="row" id="division-tools">  
     <div class="col-md-1"></div>
      @foreach($programs as $program)        
        <div class="col-md-2 col-sm-6 text-center">
          @include('programs.horizontal')
        </div>           
      @endforeach           
    </div>
  </div>
</section>

<section class="">
  <div class="container">    
    <div class="section-title">
      <h2>Job Functions</h2>
    </div>
    <div class="row" id="division-tools">  
      @foreach($divisions as $division)        
        <div class="col-md-4 col-sm-6 text-center">
          @include('divisions.horizontal')
        </div>           
      @endforeach           
    </div>
  </div>
</section>


@include('candidates.cta')
  
@endsection
  
@push('scripts')

@endpush

