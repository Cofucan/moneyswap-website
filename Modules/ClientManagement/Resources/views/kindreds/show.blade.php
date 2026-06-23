@extends('layouts.admin')
@section('page_title',  $kindred->name. ' Details')
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/kindred.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<style>
    .myDiv{
        display:none;
    }
    #state_loading{
    visibility:hidden;
    }
    .card{
        overflow: hidden;
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('cohorts/manage') }}"> <i class="fa fa-list"></i> Clients Groups</a></li>
            @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3 || Auth::user()->Profile->role_id == 16 )
                <li class="breadcrumb-item"> <a href="{{ url ('clients')}}"> Clients </a></li>
            @elseif(Auth::user()->Profile->role_id == 5 )
                <li class="breadcrumb-item"> </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $kindred->name}}</li>
               @if($kindred->enabled == true )
            <div class="ml-auto mr-0">
            @include('ClientManagement::scholarships._newmodal')
            @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
                <a class="btn btn-warning btn-sm px-3" href="{{route('clients.edit', $kindred)}}">
                   Edit
                  </a>
            @endif
            </div>
            @endif
        </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="corner-ribbon">
                    {{$kindred->status}}
                </div>
                <div class="card-body">
                    {{-- <span class="strong"> Client Details </span> --}}
                    <div class="row ">
                        <div class="col-md-2 col-sm-3">
                            @if ($kindred->enabled ==true && (Auth::user()->Profile->role_id == '11' || Auth::user()->Profile->role_id == '16'))
                            <form action="{{ route('profiles.changephoto') }}" method="POST" enctype="multipart/form-data" >
                                {{csrf_field()}}
                                <input type="hidden" name="profile_id" value="{{ $kindred->profile_id }}">
                                <div class="input-group mb-3">
                                    <img src="{{ asset ($kindred->Profile->avatar) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                                    <input type="file" name="avatar" class="form-control center-block file-upload {{ $errors->has('avatar') ? ' is-invalid' : '' }}" required>
                                    <div class="input-group-append" id="button-addon4">
                                    <button type="submit" class="btn btn-sm btn-primary btn-block">
                                        {{ __('Change') }}
                                    </button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <img src="{{ asset ($kindred->Profile->passport) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail">
                            @endif
                        </div>
                        <div class="col-md-9 col-sm-9 kindred-info">

                           <table class="table table-bordered">
                            <tr>
                                <td width="50%"><b> Name:</b>  {{ $kindred->name }}</td>
                                <td width="50%"><b>Class:</b>  </td>
                            </tr>

                           <tr>
                            <td><b>Gender:</b>   {{ $kindred->Profile->gender }} </td>
                            <td><b>Admission No:</b> {{ $kindred->admission_no }}</td>
                            </tr>
                            <tr>
                            <td><b>Date Of Birth:</b>   {{ $kindred->Profile->birthday }}</td>
                            <td><b>Attendance Type:</b> {{$kindred->attendance_type}}</td>
                            </tr>
                            <tr>
                            <td><b>Telephone: </b> {{ $kindred->Agent->Profile->telephone ?? 'N/A'}} </td>
                            <td> <b>Email: </b> {{ $kindred->Agent->Profile->email ?? 'None'}}</td>
                            </tr>
                            <tr>
                            <td><b>Agent Contact: </b> {{ $kindred->sponsor_name}} </td>
                            <td> <b>Relationship: </b> {{ $kindred->relationship_type}}</td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- profile modal begins--}}
        <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('profiles.update',  $kindred->profile) }}" id="UpdateProfile">
                        {{csrf_field()}}
                        @method('PUT')

                        @include('profilemanagement::profiles._studentform')

                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        {{-- modal ends--}}
    </div>


        <div class="col-md-12" id="tab">
            @include('ClientManagement::clients._dashboard')
            {{-- <hr> --}}
            <div class="card mt-3">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-enrolment" role="tab" aria-controls="nav-enrolment" aria-selected="true">Enrolment History</a>
                        <a class="nav-item nav-link active" id="nav-bills-tab" data-toggle="tab" href="#nav-bills" role="tab" aria-controls="nav-bills" aria-selected="false">Invoices</a>
                        <a class="nav-item nav-link" id="nav-revenues-tab" data-toggle="tab" href="#nav-revenues" role="tab" aria-controls="nav-revenues" aria-selected="false">Revenue</a>
                        <a class="nav-item nav-link" id="profile_info-tab" data-toggle="tab" href="#profile_info" role="tab" aria-controls="profile_info" aria-selected="false">Address</a>
                        {{-- <a class="nav-item nav-link" id="student_info-tab" data-toggle="tab" href="#student_info" role="tab" aria-controls="student_info" aria-selected="false">Client</a> --}}

                    </div>
                </nav>
                <div class="card-body">
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                        {{-- enrolment-tab --}}
                        <div class="tab-pane fade show" id="nav-enrolment" role="tabpanel" aria-labelledby="nav-enrolment-tab">
                            <div class="row">
                                @if ((Auth::user()->Profile->role_id == 1 ||Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16) && (is_null($kindred->Enrolment)))
                                    <div class="col-md-3 offset-md-9">
                                        <a class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#schedule">
                                           Enrol
                                        </a>
                                    </div>
                                @endif

                                {{-- modal begins--}}
                                    <div class="modal fade" id="schedule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title text-center">Schedule Enrolment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('enrolments.store') }}" id="CreateEnrolment">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
                                                    <input type="hidden" name="orphan_id" value="{{ $kindred->id }}" class="form-control" />
                                                    <input type="hidden" name="batch_id" value="{{ $kindred->batch_id }}" class="form-control" />
                                                    <div class="form-row">
                                                        <div class="col-md-12 form-group">
                                                            <strong for="orphan_id"> Client:</strong>
                                                            {{ $kindred->name }}
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <strong for="orphan_id"> Level:</strong>
                                                            {{ $kindred->class }}
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Submit </button>
                                                    {{--  <button class="btn btn-primary" type="reset">Reset Form</button>  --}}
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- modal ends--}}

                            </div>
                            <div class="table-responsive">
                                    <table class="table w-100" id="table">
                                        <thead>
                                            <tr>
                                                <th >#</th>
                                                <th >Term</th>
                                                <th >Class </th>
                                                <th >Stream </th>
                                                <th >Subjects</th>
                                                <th >Effective Date</th>
                                                <th >Status</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kindred->Enrolments as $enrolment)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$enrolment->term }}</td>
                                                    <td>{{ $enrolment->class_label }}</td>
                                                    <td>{{ $enrolment->academic_group }}</td>
                                                    <td>{{$enrolment->EnrolmentSubjects->count()}}</td>
                                                    <td>{{$enrolment->Approved_date}}</td>
                                                    <td>{{$enrolment->status}}</td>
                                                    <td>
                                                    @if($enrolment->status <> 'Scheduled')
                                                    <a class="btn btn-secondary btn-sm" target="_blank"  href="{{ route('enrolments.show', $enrolment) }}">Details</a>
                                                    @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>

                        </div>

                        {{-- kindred info-tab --}}
                        <div class="tab-pane fade" id="profile_info" role="tabpanel" aria-labelledby="profile_info-tab">
                            <div class="row mt-3 pl-3 pr-3">


                                <div class="col-md-6">
                                    <span class="strong">Agent Contacts</span>
                                    <p class="mt-3"> <b>Contact:</b> {{ $kindred->sponsor_name }}</p>


                                </div>
                            </div>

                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <div class="section-head">
                                        <div class="pull-left">
                                            <div class="kindred-info ml-3">
                                                <span class="strong"> Address</span>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            @if (Auth::user()->Profile->role_id == 16 || Auth::user()->profile_id == $kindred->Agent->profile_id)
                                                <a class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#newaddress">
                                                    Add Address
                                                </a>
                                                {{--editmodal begins--}}
                                                <div class="modal fade" id="newaddress" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-center">Add Address</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('profileaddresses.store') }}" id="CreateProfileAddress">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="profile_id" value="{{$kindred->profile_id}}">

                                                                    @if ($kindred->Agent->Profile->ProfileAddresses->count() > 0)

                                                                    <div class="form-row mb-2">
                                                                      <div class="col-md-12 mb-3 form-group">
                                                                          <div class="custom-control custom-radio custom-control-inline">
                                                                              <input id="ExistingAddress" name="student_address" type="radio" value="Existing" class="custom-control-input">
                                                                              <label class="custom-control-label" for="ExistingAddress">Same as Agent Address</label>
                                                                          </div>
                                                                          <div class="custom-control custom-radio custom-control-inline">
                                                                              <input id="NewAddress" name="student_address" type="radio" value="New" class="custom-control-input">
                                                                              <label class="custom-control-label" for="NewAddress">New Address</label>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                          <div id="showNew" class="myDiv2">
                                                                             @include('profilemanagement::profileaddresses._form')
                                                                          </div>
                                                                          <div id="showExisting" class="myDiv2">
                                                                            <div class="form-group">
                                                                                <label for="address_id"> Address </label>
                                                                                <select name="address_id" class="custom-select d-block w-100 select2" id="address_id">
                                                                                    @foreach($kindred->Agent->Profile->ProfileAddresses as $profaddress)
                                                                                        <option value="{{$profaddress->address_id}}"> {{$profaddress->Address}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('address_id'))
                                                                                            <span class="invalid-feedback">
                                                                                            <strong>{{ $errors->first('address_id') }}</strong>
                                                                                            </span>
                                                                                @endif
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <input type="hidden" name="student_address" value="New">
                                                                     @include('profilemanagement::profileaddresses._form')
                                                                @endif

                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-success" type="submit">Save </button>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                            @endif
                                        </div>
                                    </div>
                                    <table class="table">
                                        @foreach ($kindred->Profile->ProfileAddresses as $profaddress)
                                        @include('profilemanagement::profileaddresses._data')
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            @if(!is_null($kindred->Coupon))
                            <hr>
                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <span class="strong">Scholarship Details</span>
                                    <table class="table table-borderless mt-2">
                                        <tr>
                                            <th>Scholarship </th>
                                            <td> {{$kindred->Coupon->discount_amount}}</td>
                                        </tr>
                                       <tr>
                                            <th>Term Limit </th>
                                            <td> {{$kindred->Coupon->limits ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>{{$kindred->Coupon->status}}</td>
                                        </tr>
                                        <tr>
                                            <th>Narration</th>
                                            <td>{{$kindred->Coupon->label}}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- kindred info-tab --}}
                        <div class="tab-pane fade" id="nav-revenues" role="tabpanel" aria-labelledby="nav-medicals-tab">


                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <span class="strong">Revenue History</span>
                                </div>

                                <div class="col-md-12 p-r-10">
                                    @if ($kindred->Revenue->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table w-100" id="table">
                                            <thead>
                                                @include('revenuemanagement::revenues._minihead')
                                            </thead>
                                            <tbody>
                                                @foreach($kindred->Revenue as $revenue)
                                                    @include('revenuemanagement::revenues._minidata')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                       <p class="text-danger">No records to display</p>
                                    @endif
                                </div>


                            </div>


                        </div>

                        {{-- bills-tab --}}
                        <div class="tab-pane fade show active" id="nav-bills" role="tabpanel" aria-labelledby="nav-bills-tab">
                            <div class="table-responsive">
                                <table class="table w-100" id="table">
                                    <thead>
                                        @include('invoicemanagement::invoices._thead')
                                    </thead>
                                    <tbody>
                                        @foreach($kindred->Invoices as $invoice)
                                            @include('invoicemanagement::invoices._tdata')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- kindred info-tab --}}
                        <div class="tab-pane fade" id="nav-medicals" role="tabpanel" aria-labelledby="nav-medicals-tab">
                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <span class="strong">Vitals</span>
                                </div>
                                <div class="col-md-4">
                                    @if(Auth::user()->Profile->role_id == '16' || $kindred->guardian_profile_id == Auth::user()->profile_id )
                                        @if (!empty($kindred->Profile->Vital))

                                        <a href="#edit-vital" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-vital"> <i class="fa fa-edit"></i> Update Record</a>
                                        @include('profilemanagement::vitals._formedit')
                                        @else
                                        <a href="#new-vital" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-vital">   <i class="fa fa-plus"></i> Enter Record </a>
                                        @include('profilemanagement::vitals._form')
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-10 p-r-10">
                                    @if (!empty($kindred->Profile->Vital))
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Blood Group:</strong> {{ $kindred->Profile->Vital->blood_group }}</td>
                                            <td><strong>Genotype: </strong> {{ $kindred->Profile->Vital->genotype }} </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Height:</strong> {{ $kindred->Profile->Vital->height }}ft</td>
                                            <td><strong>Weight:</strong> {{ $kindred->Profile->Vital->weight }}kg</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Complexion: </strong>{{ $kindred->Profile->Vital->complexion}} </td>
                                            <td><strong>Tribal marks: </strong>
                                                @if ($kindred->Profile->Vital->tribal_marks == true)
                                                    Yes
                                                @else
                                                    No
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Eye Colour:</strong> {{ $kindred->Profile->Vital->eye_colour }}</td>
                                            <td><strong>Hair Colour:</strong> {{ $kindred->Profile->Vital->hair_colour }}</td>
                                        </tr>
                                    </table>
                                    @else
                                       <p class="text-danger">No vitals entered yet</p>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-8">
                                    <span class="strong">Medical Conditions</span>
                                </div>
                                <div class="col-md-4">
                                    @if(Auth::user()->Profile->role_id == '16' || $kindred->guardian_profile_id == Auth::user()->profile_id )

                                        {{-- <a href="#new-sickness" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-sickness">   Add New Medical Condition </a> --}}
                                        {{-- @include('healthmanagement::medicalconditions._form') --}}

                                    @endif
                                </div>
                                <div class="col-md-12 p-r-10">
                                    @if ($kindred->Profile->MedicalConditions->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ailment</th>
                                                    <th>Severity</th>
                                                    <th>Status</th>
                                                    <th width="40%">Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kindred->Profile->MedicalConditions as $sickness)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $sickness->Ailment->name }}</td>
                                                        <td>{{ $sickness->severity }}</td>
                                                        <td>{{ $sickness->status }}</td>
                                                        <td>{{ $sickness->comment }}</td>
                                                        <td>
                                                            <div class="row no-gutters">
                                                            <div class="col-md-5">
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-sickness{{$sickness->id}}" href="#edit{{$sickness->id}}"> Edit</a>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <form action="{{ route('medicalconditions.destroy',$sickness->id) }}" method="post"
                                                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                </tr>
                                                @include('healthmanagement::medicalconditions._formedit')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                       <p class="text-danger">No Medical Conditions</p>
                                    @endif
                                </div>


                            </div>

                            <hr>

                            <div class="row mt-3 pl-3 pr-3">
                                <div class="col-md-9 col-sm-7">
                                    <span class="strong">Medical Contacts</span>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    {{-- @if(Auth::user()->Profile->role_id == '16' || $kindred->guardian_profile_id == Auth::user()->profile_id )

                                        <a href="#new-medicalcontact" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-medicalcontact">   Add New Medical Contact</a>
                                        @include('healthmanagement::medicalcontacts._form')

                                    @endif --}}
                                </div>
                                <div class="col-md-12 p-r-10">
                                    @if ($kindred->Profile->MedicalContacts->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Hospital</th>
                                                    <th>Attendant</th>
                                                    <th>Telephone</th>
                                                    <th>Email</th>
                                                    {{-- <th width="40%">Location</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kindred->Profile->MedicalContacts as $medicalcontact)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $medicalcontact->legal_name }}</td>
                                                        <td>{{ $medicalcontact->contact_name }}</td>
                                                        <td>
                                                            {{ !empty($medicalcontact->Profile->DefaultPhone->contact_value) ? $medicalcontact->Profile->DefaultPhone->contact_value : 'None'}}
                                                            <a data-toggle="modal" class="pull-right" data-target="#phone{{ $medicalcontact->id }}" href="#logo1">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td>{{ $medicalcontact->Contact->email }}</td>
                                                        {{-- <td>{{ $medicalcontact->Profile->Organization->Outlet->address ?? 'N/A'}}</td> --}}
                                                        <td>
                                                            <div class="row no-gutters">
                                                            {{-- <div class="col-md-3">
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-contact{{$medicalcontact->id}}" href="#edit{{$medicalcontact->id}}"> Edit</a>
                                                            </div> --}}
                                                            <div class="col-md-1">
                                                                <form action="{{ route('medicalcontacts.destroy',$medicalcontact->id) }}" method="post"
                                                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                </tr>
                                                {{-- Update Telephone modal begins--}}
                                                   @include('healthmanagement::medicalcontacts.contactmodal')
                                                {{-- modal ends--}}
                                                {{-- @include('medicalconditions._formedit') --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                       <p class="text-danger">No Medical Contact </p>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>

    </div>





@endsection

@push('scripts')

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

   <script>
      jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });

    jQuery(document).ready(function($) {
            $('input[name="value_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                minDate: moment().subtract(3, 'day'),
                maxDate: moment(),
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
        jQuery(document).ready(function($){


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });
        });
        jQuery(document).ready(function($) {
        $('.select2').select2();
        });
</script>

        <script>
            CKEDITOR.replace("details",
                {
                    height: 100,
                    // Define the toolbar streams as it is a more accessible solution.
                 toolbarGroups: [{
                  "name": "basicstyles",
                  "streams": ["basicstyles"]
                },
                {
                  "name": "links",
                  "streams": ["links"]
                },
                {
                  "name": "paragraph",
                  "streams": ["list", "blocks"]
                },
                {
                  "name": "document",
                  "streams": ["mode"]
                },
                {
                  "name": "insert",
                  "streams": ["insert"]
                },
                {
                  "name": "styles",
                  "streams": ["styles"]
                },
                {
                  "name": "about",
                  "streams": ["about"]
                }
              ],
              // Remove the redundant buttons from toolbar streams defined above.
              removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
                });
        </script>

<script type="text/javascript">
    $('#country').on('change',function(){
    var country = $(this).val();
    if(country){
      $.ajax({
        type:"GET",
        url:"{{url('countries/get-state-list')}}?country="+country,
        beforeSend: function()
        {
          $('#state_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#state").empty();

            $('#state_loading').css("visibility", "hidden");

            $.each(res,function(key,value)
            {
              $("#state").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#state").empty();
            }
          } });
    }else{
      $("#state").empty();
    }
  });
  </script>
 @endpush
