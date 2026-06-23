@extends('layouts.admin')
@section('page_title', 'Prices Index' )
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
            <a class="btn btn-primary px-3 btn-sm" href="{{ url('pricecategories') }}">Price Categories</a>
        </div>
    </ol>
    {{-- modal begins--}}
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Add Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('pricecategories.store') }}" id="CreatePriceCategory" enctype="multipart/form-data">
                        {{csrf_field()}}

                            {{-- @include('catalogmanagement::pricecategories._form') --}}

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
     	    <h3> Prices </h3>
             <table class="table w-100" id="table">
                <thead>
                    <tr style="background-color: #F7F7F7">
                        <th>S/N </th>
                        <th>Price Name</th>
                        <th>Category</th>
                        @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3)
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $price)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $price->label }}</td>
                        <td>{{ $price->category }}</td>
                        @if (Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3)
                        <td>
                            <div class="row">
                                    <div class="col-md-8">
                                        <a class="btn btn-primary btn-sm px-3" href="{{route('prices.show', $price) }}">Details</a>
                                        <a class="btn btn-secondary btn-sm px-3" href="#editprice{{ $price->id }}" data-toggle="modal" data-target="#editprice{{ $price->id }}">Edit</a>
                                        @if($price->published == true)
                                        <a class="btn btn-warning btn-sm px-3" href="{{ url('prices/toggle', $price)}}">Disable</a>
                                        @else
                                        <a class="btn btn-success btn-sm px-3" href="{{ url('prices/toggle', $price)}}">Enable</a>
                                        @endif

                                    </div>
                                    <div class="col-md-2">
                                        <form action="{{ route('prices.destroy',$price) }}" method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                {{ csrf_field() }}
                                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn px-3"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                    {{-- modal begins--}}
                                    <div class="modal fade" id="editprice{{ $price->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title text-center">Update Price</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('prices.update', $price) }}" method="POST"  id="UpdatePricePrice">
                                                        {{csrf_field()}}
                                                        @method('PUT')


                                                        <div class="form-group">
                                                            <strong>Cost Price</strong>
                                                            {{ $price->price }}
                                                        </div>

                                                            @include('catalogmanagement::prices._formedit')


                                                        <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit">Save </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- modal ends--}}
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                </tbody>

            </table>
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
