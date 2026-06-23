@section('page_title', $page->headline)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/co-curricular.css')}}" rel="stylesheet">
@endpush


@section('content')

 <section id="page-image">
    <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->headline }}">
 </section>


  <!--==========================
      What We Do Section
    ============================-->
    <section id="co-curricular">
        <div class="container">
          <div class="row">
            <div class="col-md-2 side-menu">
            <div class="page-menu">
                <div class="header">
                    <h5>Useful Links <i class="fa fa-list-ul"></i></h5>
                </div>

                  {{--   <ul>
                        <li><a href="#gallery">About Us</a></li>
                        <li><a href="#gallery">Our Staff</a></li>
                        <li><a href="{{ url('/management') }}">Our Management</a></li>
                        <li><a href="{{ url('/calendar') }}" class="active">Directorate</a></li>
                        <li><a href="{{ url('/calendar') }}">School Calendar</a></li>
                        <li><a href="#gallery">School Policies</a></li>
                    </ul> --}}
                    <hr>
                </div>
            </div>

            <div class="col-md-10 co-curricular">
               
                <h2 class="text-center">{{ $page->headline }}</h2>
                {!! $page->body !!}
                <hr>

                <div class="row mt-30">
                @foreach ($facilities as $facility)
                    <div class="col-md-4 col-sm-6">
                        <div class="box8">
                            <img src="{{ asset ($facility->thumbnail) }}" alt="{{$facility->facility_name}}">
                            <h3 class="title">{{$facility->facility_name}}</h3>
                            <div class="box-content">
                                        {!! $facility->facility_description!!}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

      @include('partials.admission')


  @endsection
  @push('script')
  <script src="{{ asset ('plugins/fancybox/ljquery.mousewheel-3.0.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('plugins/fancybox/jquery.fancybox-1.3.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('js/lightgallery.js')}}"  type="text/javascript"></script>

  @endpush
