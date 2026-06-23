@extends('layouts.admin')
@section('page_title', ' Prices Catalog' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Price</li>
        <div class="ml-auto mr-0">
            <a class="btn btn-success btn-sm px-3" data-toggle="modal" data-target="#new">Add Price</a>

        </div>
    </ol>
    {{-- modal begins--}}
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Add Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('prices.store') }}" id="CreatePrice" enctype="multipart/form-data">
                        {{csrf_field()}}

                            @include('catalogmanagement::prices._form')

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- modal ends--}}
    </nav>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
     	    <h3>Prices </h3>
             <div class="table-responsive-sm">
                <table class="table table-striped table-hover w-100" id="table">
                    <thead>
                        <tr style="background-color: #F7F7F7">
                            <th>S/N </th>
                            <th>Product / Service</th>
                            <th>Feature</th>
                            <th>Category</th>
                            <th>Cost Price</th>
                            <th>Status</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($prices as $price)
                        <tr>
                            @include('catalogmanagement::prices.datatable')
                        </tr>
                        @endforeach
                    </tbody>            
                </table>
             </div>
        </div>
    </div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

 @endpush
