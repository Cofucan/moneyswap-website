@extends('layouts.admin')
@section('page_title', $vacancy->vacancy_title )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/career.css') }}">

@endpush
@section('content')


    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-6">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('vacancies/manage')}}" class="s-text16">
                    Vacancy
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                {{  $vacancy->vacancy_title }}

                </span>            
            </div>
            <div class="col-md-6 col-sm-6">
                @include('vacancies._actions')
            </div>
        </div>
        
    <div class="row">
        <div class="col-md-7 content_title">
            <h4>  {{  $vacancy->vacancy_title }} Details ({{ $vacancy->status }})</h4>
        </div>
        
    </div>

    <div class="row">

            <div class="col-md-12 ">
                @if ($vacancy->status == 'Rejected')
                    @foreach ($vacancy->ActiveObjections as $objection)
                        @include('objections._form')
                    @endforeach
                @endif
                @include('vacancies.regdata')                                  
            </div>
    </div>
    
@endsection
