@extends('layouts.admin')
@section('page_title', 'Add Next of Kin')
@section('content_title', 'Add Payment Plan')
@section('subtitle', 'Please provide data for all required fields')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
<!-- custom style -->
<link rel="stylesheet" href="{{ asset('css/realtytrack-form.css') }}">
@endpush
@section('content')
    <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Information</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>          
    </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Next of Kins</h4>
          <form method="POST" action="{{ route('nextofkins.store') }}" id="CreateNextOfKin">
              {{csrf_field()}}
              <input type="hidden" class="form-control" id="member_id" name="member_id" value="{{Auth::user()->Person->member->id ?? 1}}" >
            
                @include('nextofkins._form')

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            
          </form>
        </div>
@endsection
@push('scripts')
<!-- Select2 -->
<script src="{{ asset("/js/select2.full.min.js")}}"></script>
<script>
      $(document).ready(function(){
          $('#payment_plan_id').select2();
       });
    </script>

@endpush