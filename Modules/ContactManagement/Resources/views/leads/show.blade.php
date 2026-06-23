@extends('layouts.admin')
@section('page_title', 'Add new Lead')
@push('styles')
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
    .card{
      overflow: hidden
    }
    .small{
      font-size: 13px;
      color: #003399;
    }
    p{
        margin-bottom: 8px;
    }
  </style>
@endpush
@section('content')
  <nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
        <li class="breadcrumb-item"><a href="{{ url('leads/manage') }}"> leads </a></li>
        <li class="breadcrumb-item active" aria-current="page"> {{$lead->contact_name}}</li>
        <div class="ml-auto mr-0">
            <a class="btn btn-primary btn-sm" data-toggle="modal" href="#edit{{$lead->id}}" data-target="#edit{{ $lead->id}}">Upgrade Sales Cycle</a>
        </div>
    </ol>
    @include('contactmanagement::leads._modaledit')
  </nav>
    
  <div class="row mt-3">
    <div class="col-md-7">
        <div class="card">
            <div class="corner-ribbon">
                {{$lead->cycle}}
            </div>
            <div class="card-body">                    
                <p><b>Company Name:</b> {{$lead->company_name}}</p>
                <p><b>Contact Person:</b> {{$lead->contact_name}}</p>
                <p><b>Position:</b> {{$lead->position}}</p>
                <p> <i class="fa fa-envelope"></i> :{{$lead->Contact->email}}</p>
                <p> <i class="fa fa-phone"></i> : {{$lead->Contact->telephone}}</p> 
            </div>
        </div> 
    </div>
    
</div>


@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
 
<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>

@endpush
