@extends('layouts.admin')
@section('page_title', 'People')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush

@section('content')
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    People
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="{{ url('birthYears/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                <a href="{{ url('birthYears/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
                <a href=""><button class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></button></a>
            </div>
	</div>

<div class="row">
    <div class="col-md-8 content_title">
     	<h3> People </h3>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

        <table class="table">
            <thead>
                <tr>
                    <th>Adult?</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->adult == 1 ? 'Yes' : 'No' }}</td>
                        <td>{{ $result->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
    jQuery(document).ready(function($) {
        $('#table').DataTable();
    } );
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
 @endpush
