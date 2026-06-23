@section('page_title', 'Get Involved')
@extends('layouts.theme')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/util.css') }}">
@endpush
@section('content')

 	
<section class="set-bg page-banner" data-setbg="{{ asset($page->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  <h2>{{$page->headline}}</h2> 
            
          </div>
      </div>
  </div>
</section>

<section class="section-padding"></section>   

@foreach($howitworks as $howitwork)
  @if ($loop->index % 2 == 0)
    <section class="about">
      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-md-1">
                  <div class="row">
                  <div class="col-lg-6">
                      @php
                        $extension = strtolower(pathinfo((string) $howitwork->display_image, PATHINFO_EXTENSION));
                        $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
                      @endphp
                      @if($isVideo)
                        <video class="img-fluid" controls loop muted playsinline>
                          <source src="{{ asset($howitwork->display_image) }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
                        </video>
                      @else
                        <img src="{{asset ($howitwork->display_image)}}" class="img-fluid" alt="">
                      @endif
                  </div>
                  <div class="col-lg-6 pt-4 pt-lg-0 d-flex flex-column justify-content-center">
                  <h4>{{ $howitwork->label }}  </h4>
                      <p class="text-justify">{!! $howitwork->overview !!}</p>
                      <div class="row">

                      <div class="col-md-6">
                          @if(!empty($howitwork->button_url))
                          <a href="{{ url($howitwork->button_url)}}" class="btn primary-btn px-3 mt-lg-4">{{ $howitwork->button_text }}</a>
                          @endif
                      </div>
                      </div>
                  </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  @else
    <section class="section-bg about">
      <div class="container">
          <div class="row">

              <div class="col-md-10 offset-md-1 px-3 py-3">
                  <div class="row" >
                  <div class="col-lg-6 order-lg-2 order-md-2 order-1">
                      @php
                        $extension = strtolower(pathinfo((string) $howitwork->display_image, PATHINFO_EXTENSION));
                        $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
                      @endphp
                      @if($isVideo)
                        <video class="img-fluid" controls loop muted playsinline>
                          <source src="{{ asset($howitwork->display_image) }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
                        </video>
                      @else
                        <img src="{{asset ($howitwork->display_image)}}" class="img-fluid" alt="">
                      @endif
                  </div>
                  <div class="col-lg-6 pt-lg-0 d-flex flex-column justify-content-center order-lg-1 order-md-1 order-2" id="content">
                      <h4>{{ $howitwork->label }}  </h4>
                      <p class="text-justify">{!! $howitwork->overview !!}</p>
                      <div class="row">
                        <div class="col-md-6">
                            @if(!empty($howitwork->button_url))
                            <a href="{{ url($howitwork->button_url)}}" class="btn primary-btn btn-lg px-3 ">{{ $howitwork->button_text }}</a>
                            @endif
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  @endif
@endforeach

<section class="section-padding"></section> 

@endsection
