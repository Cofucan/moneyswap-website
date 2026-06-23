@section('page_title', $page->content_title)
@extends('layouts.theme')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset ('css/craftsmen.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset ('css/util.css') }}">
@endpush
@section('content')

 	
  <section class="page-image">
      <img src="{{ asset ($page->display_image) }}" alt="{{$page->content_title}}"  >
  </section>
  
  <section class="howto">
    <div class="container">
      <div class="row">       
        <div class="col-md-12">
          <h3 class="text-center main">{{$page->content_title}}</h3>
          @foreach ($howitworks as $howitwork)
          @if(($loop->iteration % 2) == 0)
            <div class="row" id="item">
              <div class="col-md-5 offset-md-1">
                <h4>{{$loop->iteration}}. {{$howitwork->label}}</h4>
                <p class="text-justify"> {{$howitwork->overview}} </p>
              </div>
              <div class="col-md-4">
                @php
                  $extension = strtolower(pathinfo((string) $howitwork->display_image, PATHINFO_EXTENSION));
                  $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
                @endphp
                @if($isVideo)
                  <video class="w-100" controls loop muted playsinline>
                    <source src="{{ asset($howitwork->display_image) }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
                  </video>
                @else
                  <img src="{{asset($howitwork->display_image)}}" alt="" class="w-100">
                @endif
              </div>
            </div>  
          
          @else  
            <div class="row" id="item">
              <div class="col-md-5 order-md-2">
                <h4>{{$loop->iteration}}. {{$howitwork->label}}</h4>
                <p class="text-justify">{{$howitwork->overview}} </p>
              </div>
              <div class="col-md-4 offset-md-1 order-md-1">
                @php
                  $extension = strtolower(pathinfo((string) $howitwork->display_image, PATHINFO_EXTENSION));
                  $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
                @endphp
                @if($isVideo)
                  <video class="w-100" controls loop muted playsinline>
                    <source src="{{ asset($howitwork->display_image) }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
                  </video>
                @else
                  <img src="{{asset($howitwork->display_image)}}" alt="" class="w-100">
                @endif
              </div>
            </div>
           
          @endif
          @endforeach

          {{-- @foreach ($howitworks as $howitwork)
          <div class="row" id="item">
            <div class="col-md-5 offset-md-1">
              <h4>{{$loop->iteration}}. {{$howitwork->label}}</h4>
              <p class="text-justify"> {{$howitwork->overview}} </p>
            </div>
            <div class="col-md-5">
              <img src="{{asset($howitwork->display_image)}}" alt="">
            </div>
          </div>
          @endforeach --}}
          {{-- <div class="row" id="item">
            <div class="col-md-5 offset-md-1">
              <h4>1. Register & create your free profile</h4>
              <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting 
                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s.</p>
            </div>
            <div class="col-md-5">
              <img src="{{asset('images/client.jpg')}}" alt="">
            </div>
          </div> --}}
          {{-- @foreach ($howitworks as $howitwork)
          <div class="row" id="item">
            <div class="col-md-5 order-md-2">
              <h4>{{$loop->iteration}}. {{$howitwork->label}}</h4>
              <p class="text-justify">{{$howitwork->overview}} </p>
            </div>
            <div class="col-md-4 offset-md-1 order-md-1">
              <img src="{{asset($howitwork->display_image)}}" alt="">
            </div>
          </div>
          @endforeach --}}
          {{-- <div class="row" id="item">
            <div class="col-md-5 order-md-2">
              <h4>2.Request for a Service</h4>
              <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting 
                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s.</p>
            </div>
            <div class="col-md-4 offset-md-1 order-md-1">
              <img src="{{asset('images/request.jpg')}}" alt="">
            </div>
          </div> --}}
          {{-- <div class="row" id="item">
            <div class="col-md-5 offset-md-1">
              <h4>3. Connect with a craftsman</h4>
              <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting 
                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                It has survived not only five centuries, but also the leap into electronic typesetting, 
                remaining essentially unchanged. It was popularised in the 1960s.</p>
            </div>
            <div class="col-md-5">
              <img src="{{asset('images/connect-craftsman.jpg')}}" alt="">
            </div>
          </div> --}}
          
        </div>
     
        
      </div>
    </div>
  </section>

  <section class="section-bg">
    <div class="container">
      <div class="col-md-12 text-center">
        <h2>Take the next Step</h2>
        <a href="{{url('/register')}}" class="btn btn-success mb-2">Sign Up</a>
        <a href="{{url('/login')}}" class="btn btn-danger mb-2">Login</a>
      </div>
    </div>
  </section>


  @endsection
