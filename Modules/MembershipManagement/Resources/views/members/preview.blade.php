@section('page_title', $member->Profile->full_name)
@extends('layouts.theme')
@push('styles')
<link href="{{ asset ('css/util.css') }}" rel="stylesheet">
<link href="{{ asset ('css/board.css') }}" rel="stylesheet">
<link href="{{ asset ('css/pages.css') }}" rel="stylesheet">
<style>
    .table tr a:hover, .table tr a:active{
        color: #009 !important;
    }
</style>
@endpush

    @section('content')

    <section  class="d-flex align-items-center section-padding about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    @include('partials.alert')
                    <div class="about-content text-justify">
                        <p>Thank you for submitting your membership application online, Kindly review your details and proceed to payment.</p>
                    </div>      
                                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                              
                                <div class="col-md-10">
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
                                    
                                    <tr>
                                        <th>Membership Fee:</th>
                                        <td>  N40,000 </td>
                                    </tr>
                                </table>
                                </div>                            
                            </div> 
                        </div>
                        <div class="card-footer">
                            <div class="pull-right">
                                <a href="#" class="btn btn-primary">Proceed to Payment</a>
                            </div>
                        </div>
                        @include('membershipmanagement::members._editmodal')
                        @include('membershipmanagement::members._editaddress')
                    </div>
                </div>            
            </div>
        </div>
    </section>
   


  @endsection

