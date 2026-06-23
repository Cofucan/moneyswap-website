@extends('layouts.admin')
@section('page_title','Document Types')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
<div class="container">
    <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
        <span class="s-text17">
            Document Types
        </span>
    </div>
    <div class="row mt-4">
        <div class="col-md-8 content_title">
            <h3> Document Types </h3>           
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#new">
                <i class="fa fa-plus"></i> Add Document Type
            </button>
        </div>
 
            {{-- modal begins--}}
            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center">Add Document Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('documenttypes.store') }}" id="CreateDocumentType" >
                            {{csrf_field()}}

                                @include('documenttypes._form')

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
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Document </th>
                        <th> Require Backview</th>
                        <th> Status </th>

                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documenttypes as $documenttype)
                    <tr >
                        <td>{{$loop->iteration}}</td>
                        <td><b>{{$documenttype->label}} </b><br> {!! $documenttype->overview !!}</td>
                        <td> 
                            @if($documenttype->require_backview == true)
                            <span class="enable">Yes</span>
                            @else
                            <span class="disable">No</span>
                            @endif
                        </td>
                        <td>
                            @if($documenttype->published == '1')
                            <span class="enable">Published</span>
                            @else
                            <span class="disable">Not Published </span>
                            @endif
                        </td>

                        <td>
                            <div class="row no-gutters">

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{$documenttype->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if($documenttype->published == true)                 
                                        <a class="btn btn-warning btn-sm" href="{{ url('documenttypes/toggle', $documenttype->id)}}">Unpublish</a>
                                        @else                        
                                        <a class="btn btn-success btn-sm" href="{{ url('documenttypes/toggle', $documenttype->id)}}">Publish</a>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('documenttypes.destroy',$documenttype->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        {{ csrf_field() }}
                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </td>


                    </tr>
                    
                    {{-- modal begins--}}
                        <div class="modal fade" id="edit{{$documenttype->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text-center">Edit {{$documenttype->label}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('documenttypes.update', $documenttype->id) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            @method('PUT')
                                            <input type="hidden" name="documenttype_id" id="documenttype_id" value="{{$documenttype->id}}">
                                            @include('documenttypes._formedit')

                                            <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Save </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- modal ends--}}
                    @endforeach
                </tbody>
            </table>
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

<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
