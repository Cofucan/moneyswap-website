@extends('layouts.admin')
@section('page_title', $member->Profile->Organization->organization_name )
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
            <li class="breadcrumb-item"> <a href="{{ url('members/manage') }}"> Members</a></li>                
            <li class="breadcrumb-item active" aria-current="page"> {{$member->Profile->full_name}}</li>
        </ol>
    </nav>
    {{-- <div class="row">
        <div class="col-md-7 organization_name">
            <h3> {{$member->Profile->full_name}}</h3>
        </div>
        
    </div> --}}

    <div class="row details mt-4 ">
       
       
        <div class="col-xs-10 col-sm-12 col-md-12">
            <div class="col-md-12 mt-4" id="tab">
                <div class="card">
                     {{-- <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="false">Personal Data</a>
                           <a class="nav-item nav-link" id="subscriptions-tab" data-toggle="tab" href="#subscriptions" role="tab" aria-controls="subscriptions" aria-selected="false">Payments </a>
                            
                        </div>
                    </nav> --}}

                    <div class="card-body">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            {{-- transactions-tab --}} 
                                <div class="tab-pane fade" id="subscriptions" role="tabpanel" aria-labelledby="subscriptions-tab">
                                    <div class="row mt-4 mb-5">
                                        <div class="col-md-12">
                                            <h5 class="pull-left">Payment Details</h5>                                        
                                            
                                            <table class="table table-borderless form-table">
                                                <tr>
                                                    <th>Name:  </th>
                                                    <td>{{ $member->full_name }}</td>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth:  </th>
                                                    <td> {{ $member->Profile->birthday }}
                                                    <a href="#updateinfo" class="pull-right" data-target="#updateinfo" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                            
                                                </td>
                                                </tr>
                                                <tr>
                                                    <th>Occupation: </th>
                                                    <td> {{ $member->occupation }} </td>
                                                </tr>
                                                <tr>
                                                    <th>Telephone:</th>
                                                    <td>  {{ $member->Profile->telephone }} <a href="#updateinfo" class="pull-right"><i class="fa fa-edit"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Email: </th>
                                                    <td>  {{ $member->Profile->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address: </th>
                                                    <td>  {{ $member->Profile->address }} </td>
                                                </tr>
            
                                                <tr>
                                                    <th>Membership Status:</th>
                                                    <td>  {{ $member->status }}</td>
                                                </tr>                                                
                                               
                                            </table>
                                        </div>
                                    </div>
                                </div> 

                            {{-- client info-tab --}}
                            <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        {{-- <h5 class="pull-left">member Info</h5>                                         --}}
                                        
                                        <table class="table table-borderless form-table">
                                            <tr>
                                                <th>Name:  </th>
                                                <td>{{ $member->full_name }}</td>
                                            </td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:  </th>
                                                <td> {{ $member->Profile->birthday }}
                                                <a href="#updateinfo" class="pull-right" data-target="#updateinfo" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        
                                            </td>
                                            </tr>
                                            <tr>
                                                <th>Occupation: </th>
                                                <td> {{ $member->occupation }} </td>
                                            </tr>
                                            <tr>
                                                <th>Telephone:</th>
                                                <td>  {{ $member->Profile->telephone }} <a href="#updateinfo" class="pull-right"><i class="fa fa-edit"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th>Email: </th>
                                                <td>  {{ $member->Profile->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address: </th>
                                                <td>  {{ $member->Profile->address }} </td>
                                            </tr>
        
                                            <tr>
                                                <th>Membership Status:</th>
                                                <td>  {{ $member->status }}</td>
                                            </tr>                                                
                                           
                                        </table>
                                    </div>
                                </div>

                            </div>                            
            
                        </div>
                    </div>
                </div>
    
    
              </div>
    
            
        </div>
    </div>

@endsection
