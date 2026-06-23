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

                <span class="s-text17">
                    Subscriptions
                </span>
            </div>
        </div>

        @include('donors.metrics')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive"> 
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            
                            <th> Member</th>
                            <th>Referral Code</th>
                            <th>Date Submitted</th>  
                            <th>Amount Due</th>                       
                            <th>Amount Paid</th>
                            <th>Status</th>
                            <th  width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donors as $donor)
                        <tr>
                            <td>{{$loop->iteration}}</td>  
                            <td>{{$donor->Member->Person->candidate_name}}</td>
                            <td>{{$donor->Member->referral_code}}</td>
                            <td>{{$donor->created_at}}</td> 
                            <td><a href="{{ route('invoices.show', $donor->Invoice->id) }}">{{ $donor->Invoice->currency }} {{number_format($donor->Invoice->amount_due,2)}}</a> </td>                                             
                            <td>{{number_format($donor->Invoice->amount_paid) }}</td>
                            <td>{{$donor->status}}</td>
                            <td>
                                <div class="row no-gutters">                                    
                                    <div class="col-md-5">
                                      @include('donors._action')                                       
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
