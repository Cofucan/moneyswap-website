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

                <a href="{{ url ('volunteers/home')}}" class="s-text16">
                   Investments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>                

                <span class="s-text17">
                    {{ $status ?? 'All'}} Investments
                </span>
            </div>
            <div class="col-md-4">
                    
            </div>
        </div>
    @include('volunteers.metrics')

    <div class="row">
      <div class="col-md-8 content_title">
        <h3> {{ $status ?? 'All'}} Investments</h3>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive"> 
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            
                            <th>Investor</th>
                            <th>Plan</th>
                            <th>Amount Invested</th>
                            <th>Returns Paid</th>
                            <th>Status</th>
                            <th  width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volunteers as $volunteer)
                        <tr>
                            <td>{{$loop->iteration}}</td>  
                            <td>{{$volunteer->Member->Person->candidate_name}}</td>
                            <td>{{$volunteer->InvestmentPlan->Package->name}} - ({{ $volunteer->InvestmentPlan->duration }})</td>
                            <td>{{ $volunteer->amount_invested }}</td>
                            <td>{{number_format($volunteer->ReceivedReturns->sum('received_amount')  ) }}</td>
                            {{-- <td>{{number_format($volunteer->Invoice->amount_paid) }}</td> --}}
                            <td>{{$volunteer->status}}</td>
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('volunteers.show', $volunteer->reference_code) }}"><i class="fa fa-eye"></i> </a>                                                                               
                                        <a class="btn btn-primary btn-sm" href="{{ route('invoices.show', $volunteer->Invoice->id) }}">Invoice </a>                                                                               
                                    </div>
                                    <div class="col-md-5">                                       
                                        @include('volunteers._action')                                         
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <form action="{{ route('volunteers.destroy',$volunteer->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </div> --}}
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
