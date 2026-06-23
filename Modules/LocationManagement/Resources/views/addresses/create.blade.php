@extends('layouts.admin')
@section('page_title', 'Add Address')

@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('addresses/manage')}}" class="s-text16">
            Addresses
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
           Add address
        </span>
    </div>

<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>



        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add address</h4>
          @include('locationmanagement::addresses._form')
          </div>
</div>

@endsection

