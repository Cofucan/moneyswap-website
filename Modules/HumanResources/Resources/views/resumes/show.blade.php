@extends('layouts.admin')
 @section('page_title', $resume->Profile->full_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
{{-- <link rel="stylesheet" href="{{ asset ('css/client.css') }}"> --}}
<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
<link rel="stylesheet" href="{{ asset ('css/career.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    #live_loading{
    visibility:hidden;
    }
    #city_loading{
    visibility:hidden;
    } 
    #sponsor_loading{
        visibility: hidden;
    }
    #qualification_loading{
    visibility:hidden;
    }
  </style>
  
@endpush
@section('content')

    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    My Resume
                </span>
            </div>
               @include('resumes._actions')
               <div class="col-md-1 col-sm-3 col-4">
                    <a href="{{ route('resumes.preview', $resume->reference_code) }}" class="btn btn-sm btn-primary"> Preview</a>
              </div> 
                        
        </div>

        <div class="row mb-4">
            <div class="col-md-9">
                {{-- <h5>{{  $resume->Vacancy->label }} - {{ $resume->status}}</h5> --}}
                <div class="job-text">
                                <div class="corner-ribbon">
                                    {{$resume->status}} 
                                </div>
                    <div class="row" id="job-header">
                        <div class="col-md-3 col-sm-4">
                                <form action="{{ route('people.changephoto') }}" method="POST" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <input type="hidden" name="person_id" value="{{ $resume->Profile_id }}">
                                    <div class="input-group mb-3"> 
                                        <img src="{{ asset ($resume->Profile->passport_photo) }}" alt="Profile Picture" class="avatar img-circle img-thumbnail" >
                                        <input type="file" name="passport_photo" class="form-control center-block file-upload {{ $errors->has('passport_photo') ? ' is-invalid' : '' }}" required>
                                        <div class="input-group-append" id="button-addon4">
                                        <button type="submit" class="btn btn-sm btn-primary btn-block">
                                            Save
                                        </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div class="col-md-9 col-sm-8">
                            <div class="row" id="applicants-data">
                                <div class="col-md-7">
                                    <h6>Status:  {{$resume->status }} <small> Click the publish button when you are done editing. </small></h6>
                                    <h5>{{ $resume->Profile->full_name }} <small>( {{ $resume->qualification }})</small>
                                    </h5>
                                </div>
                                <div class="col-md-2 mb-2">
                                  
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-12"> 
                                    <hr>
                                    <div class="row no-gutters">                                        
                                        <div class="col-md-2">  
                                            <div class="pull-right mr-3">                         
                                                {{-- modal begins--}}
                                                <div class="modal fade" id="paymentadvice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title text-center">Edit Bio Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('people.update', $resume->Profile_id) }}" id="EditPerson">
                                                            {{csrf_field()}}
                                                            @method('PUT')
                                                                @include('people._employeeform')
                                                            <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit"> Update </button>
                        
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                            </div>
                                        </div>
                                       
                                        {{-- <div class="col-md-6 col-sm-4">
                                           @include('specializations.addtoresume')
                                        </div> --}}
                                    </div>
                                </div>   
                                <div class="col-md-12">                                    
                                    <div class="row">
                                        <div class="col-md-4">                                     
                                            <p > <b> Gender: </b> {{  $resume->Profile->gender }}</p>                      
                                        </div>
                                        <div class="col-md-4"> 
                                            <p> <b> Marital Status: </b>{{  $resume->Profile->marital_status }}</p>                                    
                                            {{-- <p> <b> Place of Birth: </b>{{  $resume->Profile->birthplace }}</p>  --}}
                                        </div>
                                        <div class="col-md-4">
                                            <p> <b> Date of Birth:</b> {{  $resume->Profile->birthday }}</p> 
                                        </div>
                                    </div>
                                    <div class="row">                            
                                        <div class="col-md-4">
                                            <p><b>Preferred Role:</b> {{ $resume->Designation->job_role  }} </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Exp. Years:</b> {{ $resume->experience_years }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><b>Preferred City:</b> {{ $resume->City->city_name }}</p>
                                            {{-- <p><b>Availability:</b>@if ($resume->published == 0)
                                                Not Available @else Available
                                            @endif</p> --}}
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <hr>
                                    <strong>Career Objecive:</strong>   {!!$resume->career_objective!!}
                                  
                                </div>
                            </div>
                                 {{-- modal begins--}}
                                 <div class="modal fade" id="editresume" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center">Edit Resume</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('resumes.update', $resume->id) }}" id="UpdateResume">
                                                {{csrf_field()}}
                                                @method('PUT')
                                                    @include('resumes._formedit')
                                                <div class="modal-footer">
                                                <button class="btn btn-success" type="submit"> Update </button>                        
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- modal ends--}}                         
                        </div>
                    </div>
                </div>
                <div id="tabs" class="mt-3">  
                   
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#summary" role="tab" aria-controls="summary">Career Summary</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#employment" role="tab" aria-controls="employment">Employments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#educationa" role="tab" aria-controls="educationa">Education</a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#certificate" role="tab" aria-controls="certificate">Certification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#home" role="tab" aria-controls="home" data-target="#home">Personal Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#skillsets" role="tab" aria-controls="skillsets">Skill</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#specializations" role="tab" aria-controls="specializations">Specialization</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#contact-details" role="tab" aria-controls="contact-details">Contacts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#cover-letter" role="tab" aria-controls="cover-letter">Cover Letter</a>
                        </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane" id="home" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong ">Personal Information </span>
                                                </div>
                            
                                                <div class="pull-right mr-3">
                                                    @if(Session::get('profile_id') == $resume->profile_id)
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#paymentadvice">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    @endif


                                                </div>
                        
                                            </div>
                                            <div class="col-md-12 employ">
                                                <div class="row p-l-20">
                                                    <div class="col-md-6">                                    
                                                        <p> <b> Gender: </b> {{  $resume->Profile->gender }}</p>
                                                        <p> <b> Date of Birth:</b> {{  $resume->Profile->birthday }}</p>
                                                        <p> <b> Marital Status: </b>{{  $resume->Profile->marital_status }}</p>                                 
                                                    </div>
                                                    <div class="col-md-6">                                   
                                                        <p> <b> Place of Birth: </b>{{  $resume->Profile->birthplace }}</p>
                                                        <p> <b> Religion: </b>{{  $resume->Profile->religion }}</p>
                                                        <p> <b> Primary Language: </b>{{  $resume->Profile->primary_language }}</p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <b> About Me: </b>{!!  $resume->Profile->bio !!}
                                                    </div>
                                                </div>
                                            </div>                                           
                                            
                                        </div> 
                                    </div>
                                </div>
                               
                              
                            </div>
                            <div class="tab-pane" id="summary" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-3 offset-md-9 section-head bg-light">          
                                            <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#editresume">
                                                <i class="fa fa-edit"></i> Edit Resume
                                            </button>                                          
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tr>                                           
                                                <td> <span><strong>Job Title:</strong> {{$resume->Designation->job_role}} </span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><strong>Career Objecive:</strong> <br>  {!!$resume->career_objective!!} </td>
                                            </tr>
                                        </table> 
                                    </div>                             
                                    
                                </div>  
                            </div>
                            <div class="tab-pane" id="cover-letter" role="tabpanel">

                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong ">Cover Letter </span>
                                                </div>
                            
                                                <div class="pull-right mr-3">
                                                    @if ($resume->Profile->Coverletters->count() == 0 && Session::get('profile_id') == $resume->profile_id)
                                                    <a href="{{url('coverletters/create')}}" class="btn btn-success btn-sm"> Add Cover Letter</a>
                                                    @endif
                                                </div> 
                        
                                            </div>
                                            <div class="col-md-12 employ">
                                                @if (!empty($resume->Profile->CoverLetter))
                                                @foreach ($resume->Profile->CoverLetters as $coverletter)                                            
                                                <div class="card mb-2">                                        
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <h5>{{ $coverletter->headline}} </h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                 @if (Session::get('profile_id') == $resume->profile_id) 
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-letter">
                                                                    <i class="fa fa-edit"></i> Edit Cover Letter
                                                                </button>
                                                                 @endif 
                                                               {{--  modal begins--}}
                                                                <div class="modal fade" id="edit-letter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title text-center">Update Cover Letter</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form method="POST" action="{{ route('coverletters.update', $coverletter->id) }}" id="UpdateResume">
                                                                                {{csrf_field()}}
                                                                                @method('PUT')
                                                                                    @include('coverletters._formedit')
                                                                                <div class="modal-footer">
                                                                                <button class="btn btn-success" type="submit"> Update </button>                        
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                           {{--  modal ends--}}
                                                            </div>
                                                        </div>
                                                                                    
                                                    </div>
                                                    <div class="card-body">
                                                        {!! $coverletter->letter !!}
                                                    </div>                                   
                                                </div>      
                                                @endforeach                                      
                                            @endif
                                            </div>                                           
                                            
                                        </div> 
                                    </div>
                                </div>                                 
                            </div>
                            <div class="tab-pane" id="educationa" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters ">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong">Education</span>
                                                </div>
                                                <div class="pull-right">
                                                    @if (Session::get('profile_id') == $resume->profile_id)
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#qualification-create">
                                                        Add Academic Qualification
                                                    </button>                                                   
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                {{-- modal begins--}}
                                                <div class="modal fade" id="qualification-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-center">Add Qualification</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('educations.store') }}" id="CreateEducation" enctype="multipart/form-data">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" class="form-control" value="{{$resume->profile_id}}" name="profile_id">
                                                                    @include('educations._form')
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-success" type="submit"> Add Qualification </button>
                                
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                            </div>
                        
                                            <div class="col-md-12">
                                                <table class="table table-borderless">
                                                    @foreach($resume->Profile->Educations as $education)
                                                        @include('educations.record')

                                                        {{-- @include('educations.editmodal') --}}
                                                    @endforeach                                           
                                                </table> 
                                            </div>                                        
                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="employment" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong ">Employment </span>
                                                </div>
                            
                                                <div class="pull-right mr-3">
                                                    @if(Session::get('profile_id') == $resume->profile_id)
                                                    <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#employment-modal">
                                                        Add Work Experience
                                                    </button>
                                                    @endif

                                                    {{-- modal begins--}}
                                                    <div class="modal fade" id="employment-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title text-center">Where you have worked </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{ route('employments.store') }}" id="CreateEmployment" enctype="multipart/form-data">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" class="form-control" value="{{$resume->profile_id}}" name="profile_id">
                                                                        @include('employments._form')

                                                                        <div class="modal-footer">
                                                                        <button class="btn btn-success" type="submit"> Add Experience </button>                        
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- modal ends--}}

                                                </div>
                        
                                            </div>
                                            <div class="col-md-12 employ">
                                             

                                                    @foreach($resume->Profile->Employments as $employment)
                                                        @include('employments.record')
                                                        @include('employments.editmodal')
                                                    @endforeach                                           
                                            
                                            </div>
                                            
                                            
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            {{-- Certification --}}
                            <div class="tab-pane" id="certificate" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong">Certifcations</span>
                                                </div>
                                                <div class="pull-right">
                                                    @if (Session::get('profile_id') == $resume->profile_id)
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#certifcation-create">
                                                        Add Certification
                                                    </button>                                                   
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                {{-- modal begins--}}
                                                <div class="modal fade" id="certifcation-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title text-center">Add Certifcation</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('certifications.store') }}" id="CreateEducation" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                <input type="hidden" class="form-control" value="{{$resume->profile_id}}" name="profile_id">
                                                                @include('certifications._form')
                                                            <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit"> Add Certificate </button>
                        
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                            </div>
                        
                                            <div class="col-md-12">
                                                <table class="table table-borderless">
                                                    @foreach($resume->Profile->Certifications as $certification)
                                                        @include('certifications.record')

                                                        @include('certifications.editmodal')
                                                    @endforeach                                           
                                                </table> 
                                            </div>                                        
                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="skillsets" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters ">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong">Skills</span>
                                                </div>
                                                <div class="pull-right">
                                                    @if (Session::get('profile_id') == $resume->profile_id)
                                                    <button type="button" class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#skillnew">
                                                        Add Skill
                                                    </button>                                                        
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- modal begins--}}
                                            <div class="modal fade" id="skillnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title text-center">Add skill</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('skillsets.store') }}" id="CreateSkillset" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <input type="hidden" class="form-control" value="{{$resume->profile_id}}" name="profile_id">
                                                            @include('skillsets._form')
                                                        <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit"> Add Skill </button>
                    
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            {{-- modal ends--}}
                        
                                            <div class="col-md-12">
                                                <table class="table table-borderless">                                              
                                                    @foreach($resume->Profile->Skillsets as $skillset)
                                                        <tr>
                                                            <td width="80%"> <b>{{ $skillset->Skill->label }} - <small>{{$skillset->proficiency}}</small>  </b>                           
                                                            
                                                            </td>
                                                            @if (Session::get('profile_id') == $resume->profile_id)
                                                            <td> 
                                                                <div class="form-row">
                                                                   
                                                                    <div class="col-md-6 mb-2">
                                                                        <form action="{{ route('skillsets.destroy',$skillset->id) }}" method="post"
                                                                            onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            {{ csrf_field() }}
                                                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @endif
                                                        </tr>                                                        
                                                    @endforeach                                           
                                                </table> 
                                            </div>                                        
                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="specializations" role="tabpanel">
                                <div class="row">                
                                    <div class="col-md-12 registration">
                                        <div class="row no-gutters ">
                                            <div class="col-md-12 section-head">
                                                <div class="pull-left client-info ml-3">
                                                    <span class="strong">Specializations</span>
                                                </div>
                                                <div class="pull-right">
                                                    @if (Session::get('profile_id') == $resume->profile_id)
                                                        <button type="button" class="btn btn-yellow-outline btn-sm" data-toggle="modal" data-target="#milestone">
                                                            Add Specialization
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="modal fade" id="milestone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title text-center">Specializations</h5><hr>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <p class="text-danger"> Areas of specialization that match your profile type </p>                     
                                                    <form method="POST" action="{{ route('resumes.mapspecialties') }}" id="CreateProspects" >
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                                                        <div class="form-row">
                                                        @foreach($specializations as $key => $specialization)
                                                        <div class="col-md-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="specialties[]" value="{{$key}}" @if(old('specialization_id')) checked @endif>
                                                            <label class="form-check-label" for="specialization_id">   {{$specialization}}  </label>
                                                        </div>
                                                        @endforeach
                                                        </div>                     
                                    
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Save </button>
                                                            <button class="btn btn-primary" type="reset">Reset</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </div> 
                        
                                            <div class="col-md-12">
                                                
                                            
                                                <div class="row p-l-30">
                                                    @foreach ($resume->Specializations as $spec)
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="row">
                                                            <div class="pull-left mt-1"> {{ $spec->specialty }} </div>
                                                            <div class="pull-right">
                                                                @if (Session::get('profile_id') == $resume->profile_id)
                                                                <form action="{{ route('resumes.detachspecialties',$spec->id) }}" method="post"
                                                                    onsubmit="return confirm('Are you sure you want to remove the program from the selected designation?');">
                                                                    <input type="hidden" name="resume_id" value="{{ $resume->id}}"   id="resume_id" />
                                                                    <input type="hidden" name="specialization_id" value="{{ $spec->id}}"   id="specialization_id" />                       
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" name="Delete" class="btn btn-white btn-sm text-danger"> <i class="fa fa-trash"></i></button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>                                                   
                                                        
                                                    @endforeach                                           
                                                </div> 
                                            </div>                                        
                                            
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="contact-details" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="section-head mb-2">
                                            <div class="pull-left">
                                                <div class="client-info ml-3">
                                                    <span class="strong">Contacts</span>
                                                </div>                                           
                                            </div>
                                            <div class="pull-right">
                                                @if (Session::get('profile_id') == $resume->profile_id)
                                                 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new-contact">
                                                    Add New Contact
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        {{--editmodal begins--}}
                                        <div class="modal fade" id="new-contact" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title text-center">Add Contact</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('contacts.store') }}" id="UpdateCOntact">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="profile_id" value="{{$resume->profile_id}}">
                                                            @include('contacts._form')
                                
                                                            <div class="modal-footer">
                                                                <button class="btn btn-success" type="submit">Save </button>
                                                                <button class="btn btn-primary" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal ends--}}
                                        
                                        <table class="table mt-3 mb-3">
                                           
                                            @foreach ($resume->Profile->Contacts as $contact)
                                                <tr>
                                                <td > @if ($contact->contact_type == 'Phone')
                                                        <i class="fa fa-phone"></i>: 
                                                        @elseif($contact->contact_type == 'Email')
                                                        <i class="fa fa-envelope"></i>
                                                    @endif {{$contact->contact_value}} <small>({{$contact->contact_tag}})</small>
                                                </td>  
                                                @if (Session::get('profile_id') == $resume->profile_id)                                             
                                                <td>
                                                    <div class="row">
                                                    <div class="col-md-3 col-sm-6">
                                                        <a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#contact-info{{$contact->id}}" href="#contact-info{{$contact->id}}">
                                                            <i class="fa fa-edit"></i> 
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <form action="{{ route('contacts.destroy',$contact->id) }}" method="post"
                                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            {{ csrf_field() }}
                                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </td>
                                                @endif
                                                </tr>
                                            {{--editmodal begins--}}
                                                <div class="modal fade" id="contact-info{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title text-center">Update Contact</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('contacts.update', $contact->id) }}" id="UpdateCOntact">
                                                                    {{csrf_field()}}
                                                                    @method('PUT')
                                                                    <input type="hidden" name="profile_id" value="{{$resume->profile_id}}">
                                                                    @include('contacts._formedit')
                                        
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-success" type="submit">Save </button>
                                                                
                                                                    </div>
                                                                </form>
                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- modal ends--}}
                                            @endforeach
                                            
                                            
                                        </table>
                            
                                    </div>
                                    <div class="col-md-12">
                                        <div class="section-head">
                                            <div class="pull-left">
                                                <div class="client-info ml-3">
                                                    <span class="strong"> Address</span>
                                                </div>                                           
                                            </div>
                                            <div class="pull-right">
                                                @if (Session::get('profile_id') == $resume->profile_id)
                                                <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#address-modal">
                                                    Add Address
                                                </button> 
                                                @endif 
                                            </div>
                                        </div>
                                        <table class="table">
                                            @foreach ($resume->Profile->Addresses as $address)
                                                <tr>
                                                    <td>{{$address->address_type}}</td>
                                                    <td>{{$address->full_address}}</td>
                                                    @if (Session::get('profile_id') == $resume->profile_id)
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-3 col-6">
                                                                <a data-toggle="modal" class="btn btn-sm btn-warning" data-target="#address{{$address->id}}" href="#contact-info{{$contact->id}}">
                                                                    <i class="fa fa-edit"></i> 
                                                                </a>
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <form action="{{ route('addresses.destroy',$address->id) }}" method="post"
                                                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>  
                                                    @endif  
                                                </tr>
                                                    {{--editmodal begins--}}
                                                <div class="modal fade" id="address{{$address->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title text-center">Update Address</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('addresses.update', $address->id) }}" id="UpdateCOntact">
                                                                    {{csrf_field()}}
                                                                    @method('PUT')

                                                                    @include('addresses._formedit')
                                        
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-success" type="submit">Save </button>
                                                                
                                                                    </div>
                                                                </form>
                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="section-head">
                                            <div class="pull-left">
                                                <span class="strong"> Social Handles</span>
                                            </div>
                                            <div class="pull-right">
                                                @if (Session::get('profile_id') == $resume->profile_id)
                                                <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#social-modal">
                                                    Add
                                                </button>  
                                                @endif
                                            </div>
                                            {{-- modal begins--}}
                                                <div class="modal fade" id="social-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title text-center">Create new Social Handle</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('socials.store') }}" id="CreateSocial" > 
                                                                {{csrf_field()}}
                                                                    <input type="hidden" name="profile_id" id="profile_id" value="{{ $resume->profile_id}}">             
                                                                    @include('socials._form')

                                                                    <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit">Save </button>
                                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal ends--}}
                                        </div>
                                        <table class="table">
                                            @foreach ($resume->Profile->socials as $social)
                                            <tr>                                                
                                                <td width="80%"> <a href="{{ $social->SocialPlatform->url }}/{{$social->handle_name}}" target="_blank"><i class="fa fa-{{ $social->SocialPlatform->icon }}"></i> {{$social->handle_name}}  </a> </td>
                                                @if (Session::get('profile_id') == $resume->profile_id)
                                                <td width="15%">
                                                    <div class="row">
                                                    
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$social->id}}">
                                                                <i class="fa fa-edit"></i>                                           
                                                            </button>
                                                            
                                                        </div>
                                                        <div class="col-md-3">
                                                            <form action="{{ route('socials.destroy',$social->id) }}" method="post"
                                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                {{ csrf_field() }}
                                                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endif                                
                                            </tr>
                                                {{-- modal begins--}}
                                                <div class="modal fade bd-example-modal-lg{{$social->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title text-center">Update {{$social->SocialPlatform->platform_name}} handle</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form method="POST" action="{{ route('socials.update', $social->id) }}" id="UpdateDesignation" enctype="multipart/form-data"> 
                                                                    {{csrf_field()}}  
                                                                    @method('PUT')
                                                                    <input type="hidden" name="social_handle_id" id="social_handle_id" value="{{$social->id}}">             
                                                                    <input type="hidden" name="profile_id" id="profile_id" value="{{$resume->profile_id}}">             
                                                                    @include('socials._formedit')
                                        
                                                                    <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit">Save </button>
                                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- modal ends--}}
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        
                </div>  
            </div>
            <div class="col-md-3">
                {{-- <div class="menu-left mb-4">
                    <h5>Actions</h5>
                    <hr>    
                    <a href="{{ route('resumes.print', $resume->id) }}" class="btn btn-sm btn-block btn-warning mb-3"> Print</a>                       
                    <a href="{{ route('resumes.preview', $resume->id) }}" class="btn btn-sm btn-success btn-block"> Preview</a>                      
                     
                </div> --}}
            </div>
        </div>

     
 
  
       
</div>

  {{-- modal begins--}}
  <div class="modal fade" id="address-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center"> Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addresses.store') }}" id="CreateAddress" >
                    {{csrf_field()}}
                <input type="hidden" name="profile_id" value="{{$resume->profile_id}}" />
              
                      @include('addresses._form')
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" >Save </button>                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}} 

@endsection
@push('scripts')
<script src="{{ asset ('plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript">
        $('#state').on('change',function(){
        var state = $(this).val();
        if(state){
        $.ajax({
        type:"GET",
        url:"{{url('states/get-city-list')}}?state="+state,
        beforeSend: function()
        {
          $('#city_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
      
            $("#city").empty();
      
            $('#city_loading').css("visibility", "hidden");
      
            $.each(res,function(key,value)
            {
              $("#city").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#city").empty();
            }
          } });
        }else{
        $("#city").empty();
        }
      });
    </script>

    
    <script type="text/javascript">
        $('#sponsor_state').on('change',function(){
        var sponsor_state = $(this).val();
        if(sponsor_state){
        $.ajax({
        type:"GET",
        url:"{{url('states/get-city-list')}}?state="+sponsor_state,
        beforeSend: function()
        {
        $('#sponsor_loading').css("visibility", "visible");
        },
        success:function(res){
        if(res){
    
            $("#sponsor_city").empty();
            $('#sponsor_loading').css("visibility", "hidden");
    
            $.each(res,function(key,value)
            {
            $("#sponsor_city").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
            $("#sponsor_city").empty();
            }
        } });
        }else{
        $("#sponsor_city").empty();
        }
        });
    </script>
     
    <script>
        jQuery(document).ready(function($) {

            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });

        
    </script>
    <script>
        jQuery(document).ready(function($) {

            $('input[name="started_at"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {

            $('input[name="completion_date"]').daterangepicker({
                showDropdowns: true,
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY-MM-DD'
                }
            });

            $('input[name="end_date"]').daterangepicker({
                showDropdowns: true,
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

    <script>
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
    </script>



<script>
    CKEDITOR.replace("letter",
      {
          height: 100,
          // Define the toolbar groups as it is a more accessible solution.
       toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles"]
      },
      {
        "name": "links",
        "groups": ["links"]
      },
      {
        "name": "paragraph",
        "groups": ["list", "blocks"]
      },
      {
        "name": "insert",
        "groups": ["insert"]
      },
      {
        "name": "about",
        "groups": ["about"]
      }
    ],
    // Remove the redundant buttons from toolbar groups defined above.
    removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
      });

      CKEDITOR.replace("career_objective",
      {
          height: 100,
          // Define the toolbar groups as it is a more accessible solution.
       toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles"]
      },
      {
        "name": "links",
        "groups": ["links"]
      },
      {
        "name": "paragraph",
        "groups": ["list", "blocks"]
      },
      {
        "name": "insert",
        "groups": ["insert"]
      },
      {
        "name": "about",
        "groups": ["about"]
      }
    ],
    // Remove the redundant buttons from toolbar groups defined above.
    removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
      });
</script>

    <script>

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

    </script>
<script type="text/javascript">

    $('#program').on('change',function()  {
    var program = $(this).val();
    if(program){
      $.ajax({
        type:"GET",
        url:"{{url('programs/get-qualifications-list')}}?program="+program,
        beforeSend: function()
        {
          $('#qualification_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
            $("#qualification").empty();
            $('#qualification_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#qualification").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#qualification").empty();
            }
          } });
    }else{
      $("#qualification").empty();
    }
  });
  </script>
 @endpush

