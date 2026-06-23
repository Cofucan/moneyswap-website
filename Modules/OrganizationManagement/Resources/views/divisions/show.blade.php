@extends('layouts.admin')
 @section('page_title', $section->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')
    <section id="map" >
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3></h3>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            
          </div>
        </div>
      </div>
    </section>

    <section id="clients">
    <div class="container">
    <div class="row">
  <div class="col-md-6 content_title">
     	<h3>  {{ $section->label }} </h3>	
	</div>
  <div class="col-md-5">

	  <div class="page_button">
      <a href="{{ url('events/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
        <a href="{{ url('events/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
        <a class="btn btn-primary btn-sm" href="{{ route('events.edit',$section->id) }}"><i class="fa fa-edit"></i> Edit</a>
       
		
	  </div>
	</div>
</div>

    <div class="row">
        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Event Title :</strong>
                {{ $section->label }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Description:</strong>
                {{ strip_tags($division->overview)}}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
            <img src="{{ asset ($division->favicon) }}" alt="{{$division->label }}">
            </div>
        </div>      

    </div>
    </section><!-- #clients -->  
    
@endsection