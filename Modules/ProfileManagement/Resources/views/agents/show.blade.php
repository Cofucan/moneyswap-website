@extends('layouts.admin')
@section('page_title', $agent->Profile->name.' Dashboard')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/client.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"> <a href="{{ url('agents/manage') }}"> Parents</a></li>
        <li class="breadcrumb-item active" aria-current="page"> {{$agent->representative}}</li>
        <div class="ml-auto mr-0">
            @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
            <a class="btn btn-success btn-sm px-3" data-toggle="modal" data-target="#new-telephone">
                Add Telephone
            </a>
            <a class="btn btn-primary btn-sm px-3" href="{{ url('clients/create')}}">
                Add Client
            </a>
            @endif
        </div>
    </ol>
</nav>

<!-- dashboard -->
<div class="row m-t-20 m-b-20">
    <div class="col-md-12">
        <h3> {{$agent->name}} Agent</h3>
    </div>
    <div class="col-md-6 order-md-1">
        <div class="row mb-3">
            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4>{{ number_format($agent->Invoices->sum('balance'),2)}}</h4>
                        <h5>Amount Due</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-reply"></i>
                    </div>
					<a href="{{ url('/agent/invoices', $agent)}}" class="small-box-footer">View bills</a>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h4>{{ number_format($agent->profile->PaymentsValue(),2)}}</h4>
                        <h5>Revenue</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
					<a href="{{ url('/agent/revenues', $agent)}}" class="small-box-footer">Transaction History</a>
                </div>
            </div>

        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h5> Ward(s)</h5>
                </div>

            </div>

            <div class="box-body">
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
    <div class="col-md-6 order-md-2">

            <div class="box-body ">
                <div class="row">

                    <div class="col-md-12">

                        <table class="table table-borderless">
                            <tr>
                                <td colspan="2"><strong>Representative : </strong>{{ $agent->representative }}
                                   @include('profilemanagement::agents._editprofile')
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Occupation : </strong>{{ $agent->occupation ?? 'N/A'}}</td>
                                <td><strong>Annual Income : </strong>{{ $agent->income }}
                                    @include('profilemanagement::agents._editmodal')
                                </td>
                            </tr>
                            <tr>

                            </tr>
                            <tr>
                                <td colspan="2"><strong>Email: </strong>{{ $agent->email ?? 'N/A'}}</td>
                            </tr>

                        </table>

                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-9">
                       <h5>Telephone</h5>
                    </div>
                    <div class="col-md-3">
                      {{--editmodal begins--}}
                      <div class="modal fade" id="new-telephone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title text-center">Add Telephome</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('telephones.store') }}" id="Updatetelephone">
                                        {{csrf_field()}}
                                        <input type="hidden" name="profile_id" value="{{$agent->profile_id}}">
                                        <input type="hidden" name="phoneable_type" value="profile">
                                        @include('contactmanagement::telephones._form')

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
                    <div class="col-md-12">


                        <table class="table">

                            <tbody>
                            @foreach ($agent->profile->telephones as $telephone)
                                <tr>
                                    <td>{{$telephone->phone_number}} ({{$telephone->phone_tag}})</td>
                                    <td>
                                    @if(Auth::user()->Profile->role_id == 1 || Auth::user()->Profile->role_id == 3  || Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 16 )
                                        <div class="row">
                                        <div class="col-md-6 col-6">
                                            <a data-toggle="modal" class="btn btn-primary btn-sm" data-target="#telephone-info{{$telephone->id}}" href="#telephone-info{{$telephone->id}}">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <form action="{{ route('telephones.destroy',$telephone->id) }}" method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                {{ csrf_field() }}
                                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                        </div>
                                    @endif
                                    </td>
                                </tr>
                              @include('contactmanagement::telephones._editmodal')
                            @endforeach
                            </tbody>


                        </table>

                    </div>
                </div>
            </div>
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
