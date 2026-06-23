@section('page_title', "Unified Portal")
@extends('layouts.theme')
@push('style')
<link href="{{ asset ('css/pages.css')}}" rel="stylesheet">
@endpush


@section('content')

<section id="page-image">
    <img class="d-block w-100" src="{{ asset ('img/parent-portal.jpg') }}" alt="parent Portal">
 </section>


  <!--==========================
      What We Do Section
    ============================-->

        <div class="container p-t-20 p-b-20">
            <div class="row">
                <div class="col-md-7 ">

                    <h4 class="line">Welcome to the Unified Portal</h4>
                    <p class="text-justify">
                            The unified portal provided a simplified dashboard to display announcements, upcoming events, clients levels, birthdays and other information all in one central secured location
                    </p>
                    <hr>
                    <span class="m-t-10">If you have not created an account as a parent, you can do so by clicking the 'create account' link below the login form. Please do not create an account with the name of a child</span>
                    <!-- <hr> -->

                    <hr>


                </div>
                <div class="col-md-4 offset-md-1 m-t-15 col-4 col-sm-3 side-menu">

                    <div class="card ">
                        <div class="card-header">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body p-l-10">
                        @include('auth._login')
                        </div>



                    </div>

                </div>
            </div>
        </div>


      @include('partials.admission')


  @endsection
  @push('script')


  @endpush
