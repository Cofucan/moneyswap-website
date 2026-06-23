@extends('layouts.admin')
 @section('page_title', $brief->brief_subject)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')
  
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('briefs/manage')}}" class="s-text16">
                    Service Requests
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{ $brief->brief_subject }}
                </span>
            </div>
        
            {{-- <div class="col-md-4 ">

                <a href="{{ url('briefs/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                <a class="btn btn-primary btn-sm" href="{{ route('briefs.edit',$brief->id) }}"><i class="fa fa-pencil"></i> Edit</a>
            
            </div> --}}
        </div>
      <div class="row mt-3">
        <div class="col-md-8 content_title">
            
        </div>
        
      </div>

      <div class="row mt-4">
          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Contact Name:</strong>
                {{ $brief->contact_name }}
            </div>
            
            <div class="form-group">
              <strong>Telephone  :</strong>
              {{ $brief->telephone }}
            </div>

            <div class="form-group">
              <strong>Email  :</strong>
              {{ $brief->email }}
            </div>

          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
              <strong>Status  :</strong>
              {{ $brief->status }}
            </div>            
            
            <div class="form-group">
              <strong>Service:</strong>
              {{ $brief->Expertise->expertise_title }}
            </div>
          </div>

          <div class="col-md-12">
            <hr>
          </div>      
            
            
         

          <div class="col-xs-12 col-sm-12 col-md-12">
            
            <h5 class="mb-2">  <strong>{{ $brief->brief_subject }}</strong> </h5>	
              <div class="form-group">
                  {{-- <strong>Message :</strong><br> --}}
                  {!! $brief->brief_details !!}
              </div>
          </div>       

         
      </div>
   
    
@endsection