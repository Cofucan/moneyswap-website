@extends('layouts.admin')
@section('page_title', 'Add Division')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')
<div class="container-fluid">
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing Divisions</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>
        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Division </h4>
            <form method="POST" action="{{ route('divisions.store') }}" id="CreateSector" enctype="multipart/form-data">
                {{csrf_field()}}               

                @include('divisions._form')

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Cancel</button>

            </form>
        </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    CKEDITOR.replace("overview",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>

@endpush
