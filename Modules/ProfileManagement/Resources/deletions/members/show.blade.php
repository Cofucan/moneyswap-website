@extends('layouts.admin')
@section('page_title', $member->full_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<style>
    .btn-link{
        color: #003399
    }
    .btn-link:hover{
        color: #003399 !important;
        background: #fff !important
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('members/manage') }}"> Team Members</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$member->full_name}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-7 organization_name">
            <h3> {{$member->full_name}}</h3>
        </div>

    </div>

    <div class="row details mt-4 ">


        <div class="col-xs-10 col-sm-12 col-md-12">
            <div class="col-md-12 mt-4" id="tab">
                <div class="card">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="false">Personal Data</a>
                            <a class="nav-item nav-link" id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="false">Clients</a>

                        </div>
                    </nav>

                    <div class="card-body">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                          
                            <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
                                <div class="row mt-4">
                                    
                                </div>

                                
                            </div>

                        </div>
                    </div>
                </div>


              </div>


        </div>
    </div>

@endsection
