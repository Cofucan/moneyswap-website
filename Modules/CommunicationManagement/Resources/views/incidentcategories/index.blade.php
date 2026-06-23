@extends('layouts.admin')
@section('page_title','Incident Categories')
@push('styles')    
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<section>
    <div class="container">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incident Categories</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#new" href="#new">Add Incident Category</a>
                </div>
            </ol>
             {{-- modal begins--}}
             <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center">Add Incident Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('incidentcategories.store') }}" id="CreateIncidentCategory" >
                            {{csrf_field()}}

                                @include('incidentcategories._form')

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
        
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 col-xs-12 p-t-20">
                <h4>Incident Categories</h4>
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Category </th>
                                <th> Status </th>
        
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidentcategories as $incidentcategory)
                            <tr >
                                <td>{{$loop->iteration}}</td>
                                <td><b>{{$incidentcategory->label}} </b><br> {!! $incidentcategory->overview !!}</td>
                                <td>
                                    @if($incidentcategory->published == '1')
                                    <span class="enable">Published</span>
                                    @else
                                    <span class="disable">Not Published </span>
                                    @endif
                                </td>
        
                                <td>
                                    <div class="row no-gutters">
        
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{$incidentcategory->id}}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            @if($incidentcategory->published == true)
                                                <a class="btn btn-warning btn-sm" href="{{ url('incidentcategories/toggle', $incidentcategory->id)}}">Unpublish</a>
                                                @else
                                                <a class="btn btn-success btn-sm" href="{{ url('incidentcategories/toggle', $incidentcategory->id)}}">Publish</a>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <form action="{{ route('incidentcategories.destroy',$incidentcategory->id) }}" method="post"
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
                                <div class="modal fade" id="edit{{$incidentcategory->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$incidentcategory->label}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('incidentcategories.update', $incidentcategory->id) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="documenttype_id" id="documenttype_id" value="{{$incidentcategory->id}}">
                                                    @include('incidentcategories._formedit')
        
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
    </div>
</section>

@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
  @endpush