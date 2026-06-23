@section('page_title', 'Moments to Treasure')
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/gallery.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">

@endpush


@section('content')
 
 <section class="album-page">

 </section>


  <!--==========================
      What We Do Section
    ============================-->
            <!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Album</h2>
          <p> Moments we Treasure</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        @foreach($albums as $album)      
            
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset($album->cover)}}" class="img-fluid gallery-thumb img-100" alt="">
              <div class="portfolio-info">
                <p>{{$album->label}}</p>
                <a href="{{url('photos', $album)}}" class="preview-link" title=""><i class="bx bx-plus"></i></a>
              </div>
            </div>
          @endforeach
          
        </div>

      </div>
    </section><!-- End Portfolio Section -->


    
 <!-- ======= Cta Section ======= -->

 @include('partials.cta')



  @endsection
  @push('script')
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{{ asset ('plugins/fancybox/source/jquery.fancybox.pack.js')}}"></script>
  <script src="{{ asset ('plugins/fancybox/ljquery.mousewheel-3.0.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('plugins/fancybox/jquery.fancybox-1.3.4.pack.js')}}"  type="text/javascript"></script>
  <script src="{{ asset ('js/lightalbum.js')}}"  type="text/javascript"></script>

    <script>

        function showComment() {
            document.getElementById("Comment").style.display = "block";
        }

        function closeComment() {
            document.getElementById("Comment").style.display = "none";
        }

    </script>

  @endpush
