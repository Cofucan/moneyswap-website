@extends('layouts.admin')
@section('page_title', 'Manufactuers Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-8 col-sm-6">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Manage Brands
            </span>
        </div>
        <div class="col-md-4 col-sm-6">
            {{-- <a href="{{ url('brands/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a> --}}
            <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                <i class="fa fa-plus"></i> Add Brand
            </button>
             {{-- modal begins--}}
             <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-center">Add Brand </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
           
                            <form method="POST" action="{{ route('brands.store') }}" id="CreateManufacturer" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" value="3" id="industry_id" name="industry_id">
                                
                               @include('organizations._form')
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
	</div>
<div class="row">
    <div class="col-md-8 guideline_title">
     	<h3>Brand </h3>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12">

        <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Official Logo</th>
                    <th>Legal Name</th>
                    <th>Trading Name</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
            <tbody >
                @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td><img src="{{ asset ($brand->Organization->official_logo) }}" class="img-responsive" alt="Official Logo" height="70px" width="70px" /></td>
                    <td>{{$brand->Organization->legal_name}}</td>
                    <td>{{$brand->Organization->trading_name}}</td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{ $brand->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        {{-- modal begins--}}
                                            <div class="modal fade bd-example-modal-lg{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title text-center">Edit {{ $brand->Organization->legal_name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('organizations.update', $brand->organization_id) }}" method="POST"  id="Updateorganization" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                @method('PUT')
                                                                
                                                                @include('brands._formedit')
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
                            <div class="col-md-3">
                                <form action="{{ route('brands.destroy',$brand->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>

                    </td>
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
