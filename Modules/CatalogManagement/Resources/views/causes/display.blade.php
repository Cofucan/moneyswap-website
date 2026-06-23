@section('page_title', $cause->label)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
@endpush

@section('content')


<section class="page-image">
    <img src="{{ asset ($cause->display_media) }}" alt="{{$cause->label }}">
 </section>

  <!--==========================
      What We Do Section
    ============================-->
    <section class="page-content mt-100">
        <div class="container">
          <div class="row">
            <div class="col-md-9 page-body">
                <h2 class="text-center title">{{$cause->label}}</h2>
                <hr>
                <div class="expert text-justify">
                {!! $cause->overview !!}
                </div>

            <div class="container ">
          
                <div id="featured-services" class="featured-services">
                    <div class="container" data-aos="fade-up">

                    <div class="row mt-2">
                        @foreach ($cause->campaigns as $campaign)
                        <div class="col-md-4 col-lg-4 col-sm-6 d-flex align-items-stretch mb-5 mb-lg-0 text-left ftco-animate">
                        @include('appealmanagement::campaigns._single')
                        </div>
                        @endforeach
                    </div>

                    </div>
                </div>
            </div>



            </div>
            <div class="col-md-3 col-sm-3 side-menu">

                <div class="header">
                    <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        <li><a href="{{ url('/causes') }}" class="active">Cause</a></li>
                        @foreach($allcauses as $cause)
                        <li><a href="{{ url('cause', $cause->slug) }}">{{  $cause->label }}</a></li>
                        @endforeach
                    </ul>
                </div>


            </div>
        </div>
    </section>

     @include('appealmanagement::campaigns.cta')


  @endsection
  @push('script')
  <script src="{{ asset ('plugins/fancybox/ljquery.mousewheel-3.0.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('plugins/fancybox/jquery.fancybox-1.3.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('js/lightgallery.js')}}"  type="text/javascript"></script>

  @endpush
