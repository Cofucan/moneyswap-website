@extends('layouts.admin')
@section('page_title','Countries')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
<div class="container">
        <nav aria-label ="breadcrumb" class="navbar-light">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{url ('home')}}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Countries</li>
                <div class="ml-auto mr-0">
                    <a class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#new" href="#new">
                        <i class="fa fa-plus"></i> Add Country
</a>
                </div>
            </ol>
        </nav>
    <div class="row mt-4">
        <div class="col-md-8 content_title">
            <h3> Countries </h3>
        </div>


            {{-- modal begins--}}
            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-center">Add Country</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('countries.store') }}" id="CreateCountry" >
                            {{csrf_field()}}

                                @include('countries._form')

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
                        <th> Country</th>
                        <th> Tel. Code</th>
                        <th> Status </th>

                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr >
                        <td>{{$loop->iteration}}</td>
                        <td>{{$country->label}}({{ $country->code }})</td>
                        <td> {{$country->dialling_code}}</td>
                        <td>
                            @if($country->published == '1')
                            <span class="enable">Published</span>
                            @else
                            <span class="disable">Not Published </span>
                            @endif
                        </td>
                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-9">
                                    {{-- <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{$country->id}}" href="#edit{{$country->id}}">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    <a href="{{ route('countries.show', $country->id) }}" class="btn btn-primary btn-sm">Details</a>
                                    @if($country->published == true)
                                        <a class="btn btn-warning btn-sm" href="{{ url('countries/toggle', $country->id)}}">Unpublish</a>
                                        @else
                                        <a class="btn btn-success btn-sm" href="{{ url('countries/toggle', $country->id)}}">Publish</a>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('countries.destroy',$country->id) }}" method="post"
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
                        <div class="modal fade" id="edit{{$country->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title text-center">Edit {{$country->label}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('countries.update', $country->id) }}" id="UpdateDesignation" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            @method('PUT')
                                            <input type="hidden" name="country_id" id="country_id" value="{{$country->id}}">
                                            @include('countries._formedit')

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
