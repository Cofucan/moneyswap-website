@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Clients
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Status
                </span>
            </div>
            <div class="col-md-4">

                    <a href="{{ url('clients/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a>
                </div>
        </div>
    <div class="row">
    <div class="col-md-8 content_title">
            <h3> Clients </h3>	<small>The list of clients</small>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th>Photographh</th>
                            <th>Client Name</th>
                            <th>ScoringScheme Level</th>
                            <th>Client Type</th>
                            <th>Enrolment Status</th>
                            <th  width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img class="img-responsive thumbnail_img" src="{{  asset($client->Profile->avatar) }}" width="80px" height="80px"/></td>
                            <td>{{$client->Profile->name}}</td>
                            <td>{{$client->enrolments_count}}</td>
                            <td>{{$client->bills_count}}</td>
                            <td>{{$client->enrolment_type}}</td>

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
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>

 @endpush
