@extends('layouts.admin')
@section('page_title', $level->label .'Clients')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href='{{ url("clients")}}'>Clients</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$level->label }} Client Register</li>
            <div class="ml-auto mr-0">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('clients.gradeprinter') }}" id="PrintReport">
                            {{csrf_field()}}
                            <input type="hidden" class="form-group" name="grade_id" value="{{ $level->id }}">
                            <input type="hidden" class="form-group" name="status" value="{{ $status }}">
                            <button class="btn btn-sm btn-danger" type="submit">Print View</button>

                          </form>
                    </div>
                    <div class="col-md-6">
                  <a href="{{ url('clients/manifest', $status) }}" class="btn btn-sm btn-primary"> All {{$status }} </a>
                </div>
                </div>
            </div>
        </ol>

    </nav>



    <div class="row">
        <div class="col-md-9 content_title">
            <h4>{{ $status ??''}}  {{$level->label }} Client</h4>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive-md">
              <table class="table w-100 ">
                    @include('ClientManagement::clients._minihead')
                    @foreach($clients as $client)
                    @include('ClientManagement::clients._minidata')
                    @endforeach
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
