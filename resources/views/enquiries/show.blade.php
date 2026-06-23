@extends('layouts.admin')
 @section('page_title', $enquiry->enquiry_title)
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

                <a href="{{ url ('enquiries')}}" class="s-text16">
                    Enquiries
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{ $enquiry->enquiry_title }}
                </span>
            </div>
        
            {{-- <div class="col-md-4 ">

                <a href="{{ url('enquiries/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                <a class="btn btn-primary btn-sm" href="{{ route('enquiries.edit',$enquiry->id) }}"><i class="fa fa-edit"></i> Edit</a>
            
            </div> --}}
        </div>
      <div class="row mt-3">
        <div class="col-md-8 content_title">
            
        </div>
        
      </div>

      <div class="row mt-4">
          <div class="col-xs-6 col-sm-6 col-md-8">
              <div class="form-group">
                  <strong>Contact Name:</strong>
                 {{ $enquiry->contact_name }}
              </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Email  :</strong>
                {{ $enquiry->email }}
            </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            
            <div class="form-group">
              <strong>Telephone  :</strong>
              {{ $enquiry->telephone }}
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
            <h5 class="mb-2">  <strong>{{ $enquiry->enquiry_title }}</strong> </h5>	
              <div class="form-group">
                  {{-- <strong>Message :</strong><br> --}}
                  {!! $enquiry->enquiry_body !!}
              </div>
          </div>       

         
      </div>
   
    
@endsection