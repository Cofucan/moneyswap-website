@extends('layouts.admin')
@section('pagetitle', 'Add City')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush
@section('content') 
<div class="container">
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          
        </div>
        <div class="col-md-7 order-md-1">
          <h4 class="mb-3">Create Platform </h4>
          <form action="{{ url('cities') }}" method="POST"  class="seminor-login-form" id="CreateCity" novalidate>
          {{csrf_field()}}       

            <div class="form-group has-feedback">
              <label class="control-label" for="name">Name <span class="requiredfield">*</span></label>
                <input type="text" class="form-control{{ $errors->has('list_name') ? ' is-invalid' : '' }}" id="name" name="name"  required>
                                        
                @if ($errors->has('name '))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group has-feedback">
              <label class="control-label" for="name">Display Icon<span class="requiredfield">*</span></label>
              <input type="file" class="form-control{{ $errors->has('display_icon') ? ' is-invalid' : '' }}" id="display_icon" name="display_icon"  required>
                                      
              @if ($errors->has('display_icon'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('display_icon') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group has-feedback">
              <label class="control-label" for="target_url">Target URL<span class="requiredfield">*</span></label>
              <input type="url" class="form-control{{ $errors->has('target_url') ? ' is-invalid' : '' }}" id="target_url" name="target_url"  required>
                                      
              @if ($errors->has('name '))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          
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

