@extends('layouts.admin')
 @section('page_title', $itemcategory->label )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/tab.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>                
            <li class="breadcrumb-item"> <a href="{{ url('itemcategories') }}"> Item Categories</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> {{$itemcategory->label}}</li>            
            <div class="ml-auto mr-0">
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#additem">Add Item</a>	                  
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editcategory{{$itemcategory->id}}">Edit</a>
                @if($itemcategory->published == true)                 
                <a class="btn btn-warning btn-sm" href="{{ url('itemcategories/toggle', $itemcategory->id)}}">Unpublish</a>
                @else                        
                <a class="btn btn-success btn-sm" href="{{ url('itemcategories/toggle', $itemcategory->id)}}">Publish</a>
                @endif
            </div>
        </ol>
         {{-- new item modal begins--}}
         <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Add new Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"> Fields marked <b> * </b> are required </p>
                        <form method="POST" action="{{ route('items.store') }}" id="CreateItem">
                        {{csrf_field()}}

                            @include('catalogmanagement::items._form')

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- new item modal ends--}}

        {{-- edit modal begins--}}
        @include('catalogmanagement::itemcategories.editmodal')
        {{-- edit modal end--}}
        
    </nav>


    <div class="row details p-t-20">
        <div class="col-md-8 content_title">
            <h3> {{ $itemcategory->label }} </h3>

            @if (!empty($itemcategory->overview))
                <div class="form-group">
                    {!! $itemcategory->overview !!}
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
                    <h3 class="text-danger">{{ $itemcategory->expenses->count()}}</h3>
    
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
                    <h3 class="text-success">{{ number_format($itemcategory->expenses->sum('amount'),2)}}</h3>
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
                    <h3 class="text-primary">{{ number_format($itemcategory->expenses->sum('amount') ) }}</h3>
    
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
                       <h5>Items in {{$itemcategory->label}}</h5>
                   </div>
                    <div class="card-body">                       
                        <table class="table w-100" id="table">
                            <thead>
                                <tr style="background-color: #F7F7F7">
                                    <th>S/N </th>
                                    <th>Item Name</th>   
                                    <th>Cost</th>   
                                    <th>Status</th>         
                                    @if ( Auth::user()->Profile->role_id == 3)
                                    <th width="50%">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($itemcategory->Items as $item)
                                <tr>
                               @include('catalogmanagement::items.datatable')
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
