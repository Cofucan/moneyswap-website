@extends('layouts.admin')
@section('pagetitle', 'Add City')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content') 
<div class="container-fluid">
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          

          
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Create Contact List <small>Use the form below to enter a new record</small></h4>
          <form action="{{ url('cities') }}" method="POST"  id="CreateCity" novalidate>
          {{csrf_field()}}

             
              <label>
                <p class="label-txt">ENTER YOUR EMAIL</p>
                <input type="text" class="input">
                <div class="line-box">
                  <div class="line"></div>
                </div>
              </label>
              <label>
                <p class="label-txt">ENTER YOUR NAME</p>
                <input type="text" class="input">
                <div class="line-box">
                  <div class="line"></div>
                </div>
              </label>
              <label>
                <p class="label-txt">ENTER YOUR PASSWORD</p>
                <input type="text" class="input">
                <div class="line-box">
                  <div class="line"></div>
                </div>
              </label>
             
            
            

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Submit </button>
            <button class="btn btn-primary" type="reset">Reset</button>
            
          </form>
        </div>  
</div>
</div>

@endsection
@push('scripts')
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script>
     $(document).ready(function(){

$('input').focus(function(){
  $(this).parent().find(".label-txt").addClass('label-active');
});

$("input").focusout(function(){
  if ($(this).val() == '') {
    $(this).parent().find(".label-txt").removeClass('label-active');
  };
});

});
    </script>

@endpush

