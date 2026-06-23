@extends('layouts.admin')
@section('page_title', 'Edit Outlet')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')
<div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('outlets/manage')}}" class="s-text16">
        Outlets
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        Edit Outlet
    </span>
</div>

<div class="row">
    <div class="col-md-8">
        <h4 class="mb-3">Update Outlet</h4>
        <form action="{{ route('outlets.update', $outlet->id) }}" method="POST" id="UpdateOutlet">
            {{ csrf_field() }}
            @method('PUT')

            @include('organizationmanagement::outlets._formedit')

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save</button>
            <a class="btn btn-primary" href="{{ route('outlets.manage') }}">Cancel</a>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
  });
</script>
@endpush
