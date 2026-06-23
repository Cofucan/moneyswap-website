
@extends('layouts.theme')
@section('page_title', $announcement->subject)
@push('style')
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/announcement.css')}}" rel="stylesheet">
{{--  <link href="{{ asset ('css/util.css') }}" rel="stylesheet">  --}}
@endpush


@section('content')

<!-- <section class="page-image">
    <img src="{{ asset('img/news.jpg')}}">
</section> -->


  <!--==========================
      What We Do Section
    ============================-->
    <section id="page-content ">
        <div class="container ">
         <div class="bread-crumb flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">

            <a href="{{ url ('events')}}" class="s-text16">
            Announcements
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
            {{ $announcement->subject  }}
            </span>
        </div>
          <div class="row">


            <div class="col-md-9 col-8 m-t-20">

                <div class="announcement-details">
                    <img src="{{ asset ($announcement->display_media) }}" class="img-responsive" alt="properties">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <h4> {{  $announcement->subject }} </h4>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <span><i class="fa fa-calendar">: {{$announcement->date_published }} </i>   | <i class="fa fa-comments">{{ $announcement->Comments->count() }} comment</i></span>
                        </div>
                    </div>
                    <hr>

                     <div class="description">
                        {!! $announcement->body !!}

                    </div>
                        <div class="col-md-5 col-sm-6 col-6"> <span>Share on </span><br>{!! $shared !!} </div>
                        </div>


                        <div class="description">
                        <hr class="announcement-line">
                            <ul>
                                @foreach($announcement->comments as $comment)
                                <li>{{ $comment->body }}</li>
                                @endforeach
                            </ul>
                        </div>

            </div>

            <div class="col-md-3 p-l-20 m-t-15 col-4 col-sm-3 side-menu">

                <div class="header">
                    <h5>Quick Links <i class="fa fa-list-ul"></i></h5>
                </div>
                <div class="quick-links">
                    <ul>
                        <li><a href="{{ url('/') }}">Events Calendar</a></li>
                        <li><a href="{{ url('/page/about') }}" class="active">Latest News</a></li>
                        <li><a href="{{ url('/realtyinventories') }}">Gallery</a></li>
                        <li><a href="{{ url('/estates') }}">Activities</a></li>
                    </ul>
                </div>

                @include('calendarmanagement::events.pages_sidebar')


            </div>
          </div>
        </div>
    </section>

@include('partials.admission')

  @endsection
  @push('script')

  @endpush
