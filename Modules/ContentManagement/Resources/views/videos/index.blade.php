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
    <section id="categories" class="section-padding about">
        <div class="container">
            <div class="section-title mb-5">
                <h4 class="text-upppercase">Moments we treasure</h4>
              </div>
          <div class="row">
            <div class="col-md-12 category">
               
                <div class="row">
                    @foreach ($albums as $album)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                       @include('contentmanagement::albums.single')
                    </div>
                    @endforeach
                </div>

            </div>

            <!-- <div class="col-md-2 side-menu">
                <div class="page-menu">
                    <div class="header">
                        <h5>Useful Links <i class="fa fa-list-ul"></i></h5>
                    </div>
                    <ul>
                        <li><a href="#album">About Us</a></li>
                        <li><a href="#album">Our Staff</a></li>
                        <li><a href="{{ url('/management') }}">Our Management</a></li>
                        <li><a href="{{ url('/calendar') }}" class="active">Directorate</a></li>
                        <li><a href="{{ url('/calendar') }}">School Calendar</a></li>
                        <li><a href="#album">School Policies</a></li>
                    </ul>
                    <hr>
                </div> -->
            </div>
        </div>
    </section>


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
