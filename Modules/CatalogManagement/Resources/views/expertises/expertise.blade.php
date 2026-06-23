@section('page_title', $expertise->label)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="set-bg page-banner" data-setbg="{{ asset ($expertise->display_image) }}">
  {{-- <div class="overlay"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 offset-md-2 text-center text-white text-uppercase">
              
                  <!-- <h2>{{$expertise->label }}</h2>  -->
            
          </div>
      </div>
  </div>
</section>
  <!--==========================
      What We Do Section
    ============================-->
    <section class="page-content mt-100">
        <div class="container">
          <div class="row">
            <div class="col-md-9 page-body">
            <div class="section-title">
                <h2 class="text-left">{{$expertise->label}}</h2>
             </div>
                        
            <div>
            <p class="text-justify">  {!! $expertise->overview !!}</p>
            </div>


            </div>
            <div class="col-md-3 col-sm-3" id="sidemenu">

                <div class="sidemenu-links">
                    <h4>Quick Links <i class="fa fa-list-ul"></i></h4>
                    <ul>
                 

                        <li><i class="bx bx-chevron-right"></i><a href="{{ url('/') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i><a href="{{ url('/expertises') }}" class="active">Expertise</a></li>
                        @foreach($expertises as $expertise)
                        <li><i class="bx bx-chevron-right"></i><a href="{{ url('expertise', $expertise->slug) }}">{{  $expertise->label }}</a></li>
                        @endforeach
                    </ul>
                </div>


            </div>
        </div>
    </section>
    
    @include('partials.cta')



  @endsection
  @push('script')
  <script src="{{ asset ('plugins/fancybox/ljquery.mousewheel-3.0.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('plugins/fancybox/jquery.fancybox-1.3.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('js/lightgallery.js')}}"  type="text/javascript"></script>

  @endpush
