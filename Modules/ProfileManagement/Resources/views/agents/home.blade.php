@extends('layouts.admin')
@section('page_title', $agent->Profile->name.'Dashboard')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<!-- dashboard -->
<div class="row m-t-20 m-b-20">
    <div class="col-md-6 order-md-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h5> Client Enrolled</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ url('agents/preview', $agent)}}" class="btn btn-sm btn-warning"> View All</a>
                </div>
            </div>

            <div class="box-body px-3 py-4">
                    <div class="row">
                        @foreach ($agent->Clients as $client)
                            <div class="col-md-3 mb-4">
                                @include('clientmanagement::clients._single')
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 order-md-1">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ number_format($agent->profile->PaymentsValue(),2)}}</h3>
                        <h5>Revenue</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-red   ">
                    <div class="inner">
                        <h3>{{ number_format($agent->Invoices->sum('balance'),2)}}</h3>
                        <h5>Oustanding Fee</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-reply"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$agent->Clients->count() }}</h3>
                        <h5>My Kids</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->





            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>00</h3>
                        <h5>Applications</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                 <div class="pull-left">
                    <h5> Pending Invoices</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ url('invoices.manage')}}" class="btn btn-sm btn-warning"> View All</a>
                </div>
            </div>
            <div class="box-body ">
                @if ($agent->PendingInvoices->count() > 0)
                <table class="table table-striped w-100">
                    <thead >
                        @include('invoicemanagement::invoices._minihead')
                    </thead>
                    <tbody>
                            @foreach ($agent->PendingInvoices as $invoice)
                                @include('invoicemanagement::invoices._minidata')
                                @if($loop->iteration == 3)
                                @break
                                @endif
                            @endforeach
                    </tbody>
                </table>
                @else
                <p>No Invoice Pending</p>
                @endif

            </div>

        </div>
        <div class="box box-primary mt-3">
            <div class="box-header with-border">
                 <div class="pull-left">
                    <h5> Recent Revenue</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ url('invoices.manage')}}" class="btn btn-sm btn-warning"> View All</a>
                </div>
            </div>
            <div class="box-body ">
                @if ($agent->Profile->Revenue->count() > 0)
                <table class="table table-striped w-100">
                    <thead >
                        @include('revenuemanagement::revenues._minihead')
                    </thead>
                    <tbody>
                            @foreach ($agent->Profile->Revenue as $revenue)
                                @include('revenuemanagement::revenues._minidata')
                                @if($loop->iteration == 3)
                                @break
                                @endif
                            @endforeach
                    </tbody>
                </table>
                @endif

            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h5 > Notifications</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ url('announcements')}}" class="btn btn-sm btn-warning"> View All</a>
                </div>
            </div>
            <div class="box-body">
                @include('communicationmanagement::announcements._announcement')
            </div>
        </div>
    @if ($upcomingevents->count() > 0)
        <div class="box box-primary mt-3">
            <div class="box-header">
                <div class="pull-left">
                    <h5>Upcoming Events</h5>
                </div>
                <div class="pull-right">
                            <a href="{{ url('events') }}" class="btn btn-sm btn-warning"> View All</a>
                </div>
            </div>
            <div class="box-body ">
                <div class="table-responsive">
                    @include('contentmanagement::events._event-info')
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
<!-- ./sidemenu -->

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>

 @endpush
