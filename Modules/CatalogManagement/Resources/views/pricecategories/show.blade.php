@extends('layouts.admin')
 @section('page_title', $pricecategory->label )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/tab.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
            <li class="breadcrumb-item"> <a href="{{ url('pricecategories') }}"> Price Categories</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> {{$pricecategory->label}}</li>            
            <div class="ml-auto mr-0">
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#addprice">Add Price</a>	                  
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$pricecategory->id}}">Edit</a>
                @if($pricecategory->published == true)                 
                <a class="btn btn-warning btn-sm" href="{{ url('pricecategories/toggle', $pricecategory->id)}}">Unpublish</a>
                @else                        
                <a class="btn btn-success btn-sm" href="{{ url('pricecategories/toggle', $pricecategory->id)}}">Publish</a>
                @endif
            </div>
        </ol>
         {{-- new price modal begins--}}
         <div class="modal fade" id="addprice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Add new Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"> Fields marked <b> * </b> are required </p>
                        <form method="POST" action="{{ route('prices.store') }}" id="CreatePrice">
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
        {{-- new price modal ends--}}

        {{-- edit modal begins--}}
        @include('catalogmanagement::pricecategories.editmodal')
        {{-- edit modal end--}}
        
    </nav>


    <div class="row details p-t-20">
        <div class="col-md-8 content_title">
            <h3> {{ $pricecategory->label }} </h3>

            @if (!empty($pricecategory->overview))
                <div class="form-group">
                    {!! $pricecategory->overview !!}
                </div>
            @endif
        </div>
    </div>

    {{-- <div class="row mt-4 mb-4">
        <!-- ./col -->
        <div class="col-md-4  col-sm-6 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="text-danger">{{ $pricecategory->expenses->count()}}</h3>
    
                    <h5 class="text-danger">Expenses</h5>
                </div>
                <div class="icon">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <a href="#" class="small-box-footer">  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
        <div class="col-md-4 col-sm-6 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="text-success">{{ number_format($pricecategory->expenses->sum('amount'),2)}}</h3>
                    <h5 class="text-success">Total Expenses</h5>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
     
    
        <div class="col-md-4 col-sm-6 col-sm-6 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="text-primary">{{ number_format($pricecategory->expenses->sum('amount') ) }}</h3>
    
                    <h5 class="text-primary">Requisition</h5>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
      
    
    </div>  --}}

    <div class="row mt-4">

            <div class="col-md-11 col-sm-12 col-xs-12 table-responsive">
                <div class="card">
                   <div class="card-header">
                       <h5>Prices in {{$pricecategory->label}}</h5>
                   </div>
                    <div class="card-body">                       
                        <table class="table w-100" id="table">
                            <thead>
                                <tr style="background-color: #F7F7F7">
                                    <th>S/N </th>
                                    <th>Price Name</th>   
                                    <th>Cost</th>   
                                    <th>Status</th>         
                                    @if ( Auth::user()->Profile->role_id == 3)
                                    <th width="50%">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pricecategory->Prices as $price)
                                <tr>
                               @include('catalogmanagement::prices.datatable')
                                </tr>
                                @endforeach

                            </tbody>

                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
