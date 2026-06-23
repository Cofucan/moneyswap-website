@section('page_title', $guideline->label)
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<link href="{{ asset ('css/schoolpolicies.css') }}" rel="stylesheet">
<style>
    .page-body ol{
        margin-bottom: 20px;
    }
    .page-body ol li{
        margin-left: 20px;
        padding-left: 10px;
    }
    .page-body p{
        font-size: 15px;
        line-height: 30px;
    }
</style>
@endpush

    @section('content')

    <section class="page-image">
        <img class="d-block w-100" src="{{ asset ($page->display_image) }}" alt="{{ $page->headline }}">
    </section>
    <section>
        <div class="container p-t-20 p-b-20">
          <div class="row">

                <div class="col-lg-9 page-body">

                <h3 class="title">{{$guideline->label}}</h3>

                    <hr>

                <div class="text-justify">
                    {!! $guideline->overview !!}

                </div>


                </div>

                <div class="col-md-3 m-t-15 side-menu">

                    <div class="side-menu-header">
                        <h5>School Policies <i class="fa fa-list-ul"></i></h5>
                    </div>
                    <div class="quick-links">
                        <ul>
                            <li><a href="{{url('/guidelines')}}">All policies</a></li>
                            @foreach ($guidelines as $guideline)
                                <li><a href="{{url('/guideline', $guideline->slug)}}">{{$guideline->label}}</a></li>
                            @endforeach

                        </ul>
                    </div>

                  


                </div>
        </div>
    </section>
@include('partials.admission')


  @endsection

