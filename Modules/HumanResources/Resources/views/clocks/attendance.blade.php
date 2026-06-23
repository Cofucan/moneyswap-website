@extends('layouts.admin')
@section('page_title','Employee Attendance Sheet ')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('employees/manage') }}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">  Attendance</li>
            <div class="ml-auto mr-0">
                @if (Auth::user()->Profile->role_id == 3 || Auth::user()->Profile->role_id == 3)
                <a data-toggle="modal" class="btn btn-sm btn-success px-3" data-target="#newscholarship" href="#newscholarship">
                   Offer Scholarship
                </a>
                {{-- modal begins--}}
                <div class="modal fade" id="newscholarship" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Add Scholarships</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('clocks.storescholarships') }}" id="AddScholarship">
                                    {{csrf_field()}}

                                   @include('ClientManagement::clocks._scholarshipform')

                                    <div class="modal-footer">
                                    <button class="btn btn-success" type="submit">Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal ends--}}
                @endif
                <a  class="btn btn-sm btn-secondary px-3" href="{{ url('coupons/manage') }}">
                    Discounts
                </a>

            </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 content_title">
            <h3> Employee Name  from to day</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Day </th>
                            <th >Time In</th>
                            <th >Time Out </th>
                            <th >Remarks</th>
                            <th >Total Hours</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clocks as $clock)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{route('clocks.show', $clock)}}">{{$clock->work_day}}</a></td>
                            <td>{{$clock->time_in}}</td>
                            <td>{{ $clock->time_out}} </td>
                            <td>{{$clock->duration}}</td>
                            <td>{{ $clock->status}}</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-10">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('coupons.show', $clock->Coupon) }}">Details </a>
                                        @if (Auth::user()->Profile->role_id == 3)
                                            @if($clock->Coupon->enabled == true)
                                            <a class="btn btn-success btn-sm" href="{{ url('coupons/toggle', $clock->Coupon)}}">Disable</a>
                                            @else
                                            <a class="btn btn-warning btn-sm" href="{{ url('coupons/toggle', $clock->Coupon)}}">Enable</a>
                                            @endif
                                            <a data-toggle="modal" class="btn btn-sm btn-primary" data-target="#edit{{ $clock->Coupon->id }}" href="#edit{{ $clock->Coupon->id }}">
                                                Edit
                                            </a>
                                            {{-- modal begins--}}
                                                <div class="modal fade" id="edit{{ $clock->coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title text-center">Edit {{ $clock->coupon->code }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('coupons.update', $clock->Coupon) }}" id="CreateEvent">
                                                                    {{csrf_field()}}
                                                                    @method('PUT')

                                                                <div class="form-group">
                                                                    <strong>Code:</strong> {{ $clock->Coupon->code }}
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="discount">Discount </label>
                                                                    <div class="input-group">
                                                                        <input type="number" name="discount_value" value="{{ $clock->Coupon->discount_value }}" class="form-control"  id="discount_value" />
                                                                        <div class="input-group-append">
                                                                        <div class="input-group-text">{{ $clock->Coupon->discount_type }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-success" type="submit">Save </button>

                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            {{-- modal ends--}}
                                        @endif
                                    </div>

                                </div>
                            </td>
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
