@extends('layouts.admin')
@section('page_title', 'Add Department')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')
<div class="container-fluid">

          <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('departments/manage')}}" class="s-text16">
                Department
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Add Department
            </span>
        </div>
<div class="row">
   <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Information</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        {{--  <div class="page-menu">
            <ul>
                <li><a href="{{url ('/')}}">First Term</a></li>
            </ul>
        </div>  --}}

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Department </h4>
            <form method="POST" action="{{ route('departments.store') }}" id="CreateArea">
                {{csrf_field()}}

                @include('departments._form')

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
               

            </form>
        </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    CKEDITOR.replace("description",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>

<script>


  function showDescription() {
      document.getElementById("Description").style.display = "block";
  }

  function closeDescription() {
      document.getElementById("Description").style.display = "none";
  }

</script>
@endpush
