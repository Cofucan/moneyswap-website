@extends('layouts.theme')
@section('page_title', $page->headline)
@section('content')

 <section class="page-image" style="background-image: url({{ asset ($page->display_image)}});">
    <!-- <img src= "{{ asset ($page->display_image)}}" class="img-fluid" alt="{{$page->headline}} image" title="{{$page->headline}}"> -->
</section>

    <section class="about">
        <div class="container ">
            <div class="row">
                <div class="col-md-6">
                    <header class="program-header">
                        <h3>{{ $page->headline }}</h3>
                    </header>
                    <div class="text-justify">{!! $page->body!!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="main-image">
                        <img src= "{{ asset ($page->thumbnail)}}" class="img-fluid" alt="{{$page->headline}} image" title="{{$page->headline}}">
                    </div>
                    <div class="vision">
                        <h4>our Vision</h4>
                        <hr>
                        <p>...is to provide affordable, BUT HIGH QUALITY education in the communities of our location thereby raising future leaders in all sectors.</p>
                    </div>

                    <div class="vision">
                        <h4>Our mission</h4>
                        <hr>
                        <p>... is to ensure that no child suffers lack of quality education due to cost thereby bringing well- rounded education within reach of all as much as possible with the help of God.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

     <section class="admission">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <header class="program-header">
              <h3>core values</h3>
            </header>
            <div class="row">
                <div class="col-md-3 values">
                    <img src="{{ asset('img/discipline.png')}}">
                    <h4>Discipline</h4>
                </div>

                <div class="col-md-3 values">
                    <img src="{{ asset('img/diligence.png')}}">
                    <h4>Diligence</h4>
                </div>

                <div class="col-md-3 values">
                    <img src="{{ asset('img/leadership.png')}}">
                    <h4>Leadership</h4>
                </div>

                <div class="col-md-3 values">
                    <img src="{{ asset('img/integrity.png')}}">
                    <h4>Integrity</h4>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection
