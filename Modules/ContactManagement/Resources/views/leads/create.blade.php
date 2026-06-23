@extends('layouts.admin')
@section('page_title', 'Add new Lead')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
  .myDiv{
      display:none;
  }  
</style>
@endpush
@section('content')
  <nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
        <li class="breadcrumb-item"><a href="{{ url('leads/manage') }}"> leads </a></li>
        <li class="breadcrumb-item active" aria-current="page"> New</li>
       
    </ol>
  </nav>
    
  <div class="row">   
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Add New Lead Form </h4>
      <form method="POST" action="{{ route('leads.store') }}" id="CreateLead">
            {{csrf_field()}}
          @include('contactmanagement::lead._form')

          <hr class="mb-4">         
          <button class="btn btn-success px-4" type="submit">Save</button>
          
        </form>
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
