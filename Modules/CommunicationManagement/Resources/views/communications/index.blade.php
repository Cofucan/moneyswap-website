@extends('layouts.admin')
@section('page_title', 'Communications')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-12 col-sm-12">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            @if ( Auth::user()->profile->role_id == 1 )
                <a href="{{ url ('clients')}}" class="s-text16">
                    Clients
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>
            @elseif ( Auth::user()->profile->role_id == 5 )
                <a href="{{ url ('clients/home')}}" class="s-text16">
                    Clients
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>
            @endif


            <span class="s-text17">
                    {{ $client->Person->name }} Communication Log
            </span>
        </div>
        {{-- <div class="col-md-4 col-sm-6">

            <a href="{{ url('communications/manage') }}"><button class="btn btn-sm btn-primary">Manage <i class="fa fa-list"></i></button></a>
            <a href="{{ url('studentfeeitems/create') }}"><button class="btn btn-sm btn-success">Add Fee <i class="fa fa-plus"></i></button></a>
            <a class="btn btn-warning btn-sm" href="{{ route('communications.edit',$communication->id) }}">Edit <i class="fa fa-edit"></i> </a>
        </div> --}}
    </div>

<div class="row">
		        <div class="col-md-6 content_title mb-4">
		        	<h4> {{ $client->Person->name }} Logs </h4>

		        </div>


	      	</div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table">
                @foreach($client->Communications as $communication)
                    <div class="communication mt-2 col-md-12">
                        @include('communications._singlelog')
                    </div>
                @endforeach
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
