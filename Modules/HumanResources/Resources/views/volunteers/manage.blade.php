@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    .invest-card{
        overflow: hidden;
    }
</style>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('volunteers')}}" class="s-text16">
                   Investments
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>                

                <span class="s-text17">
                   My Investments
                </span>
            </div>
            <div class="col-md-4">
                    {{-- <a href="{{ url('volunteers/create') }}" class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></a>
                    <a href="{{ url('volunteers/upload') }}" class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></a>
                    <a href="{{ url('volunteers/export') }}" class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></a> --}}
                </div>
        </div>
    <div class="row">
    <div class="col-md-8 content_title">
            <h3> My Investments</h3>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="mb-table d-lg-none">
                <div class="row">
                  @foreach ($volunteers as $volunteer)
                    <div class="col-sm-6 mb-3">
                      <div class="card invest-card">
                        <div class="corner-ribbon">
                            {{$volunteer->status}}
                          </div>
                        <div class="py-3 px-3">
                          <span><strong>{{$volunteer->InvestmentPlan->Package->name}} Volunteer Plan</strong></span> <br>
                          <small><strong>Duration: </strong> {{ $volunteer->InvestmentPlan->duration }}</small> <br>
                          <small><strong>Amount Invested: </strong> {{ $volunteer->amount_invested }}</small> <br>
                          <small><strong>Processing Fee: </strong> {{ number_format($volunteer->processing_fee) }}</small> <br>
                          <div class="row no-gutters mt-3">
                            <div class="col-4">                                        
                                <a class="btn btn-secondary btn-sm" href="{{ route('volunteers.show', $volunteer->reference_code) }}">Details </a>                                                                               
                            </div>
                            <div class="col-8">
                              <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#paymentadvice21">
                                Send Payment Notice
                              </button>  
                               {{-- modal begins--}}
                                <div class="modal fade" id="paymentadvice21" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-md modal-dialog-centered">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title text-center">Payment Notification</h4>
                                            
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <p class="mb-3"> Kindly fill the form below to notify us of any payment made but has not reflected on your profile <br>
                                                  {{-- <b class="text-red">NB: Do not add "," when adding amount</b> --}}
                                              </p>
                                              <form method="POST" action="{{ route('advices.store') }}" id="SendAdvice">
                                                {{csrf_field()}}
                                                <input type="hidden" name="payment_method" value="Offline" />
                                                <input type="hidden" name="adviceable_type" value="bank_account" />

                                                @include('advices._createform')
            
                                                
                                                <p class="text-danger">Include the invoice No in the payment description when doing transfer</p>
            
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit"> Send </button>
                                                    
                                                </div>
                                            </form>
                                    
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                            </div>                           
                        </div>
                        </div>
                    
                      </div>
                    </div>                            
                  @endforeach
                </div>
              </div>
              <div class="lg-table">
                    <div class="table-responsive"> 
                        <table class="table w-100" id="table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th>Volunteer Plan</th>
                                    <th>Amount Invested</th>
                                    <th>Duration</th>
                                    <th>Date Submitted</th>  
                                    <th>Amount Due</th>                       
                                    <th>Amount Paid</th>
                                    <th>Status</th>
                                    <th  width="25%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteers as $volunteer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>  
                                    <td>{{$volunteer->InvestmentPlan->Package->name}}</td>
                                    <td>{{ $volunteer->amount_invested }}</td>
                                    <td>{{ $volunteer->InvestmentPlan->duration }}</td>
                                    <td>{{$volunteer->created_at}}</td> 
                                    <td><a href="{{ route('invoices.show', $volunteer->Invoice->id) }}">{{ $volunteer->Invoice->currency }} {{number_format($volunteer->Invoice->amount_due,2)}}</a> </td>                                             
                                    <td>{{number_format($volunteer->Invoice->amount_paid) }}</td>
                                    <td>{{$volunteer->status}}</td>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-md-4">                                        
                                                <a class="btn btn-secondary btn-sm" href="{{ route('volunteers.show', $volunteer->reference_code) }}"><i class="fa fa-eye"></i> </a>                                                                               
                                                @if ($volunteer->status == 'Approved')
                                                <a class="btn btn-danger btn-sm" href="{{ route('volunteers.certificate', $volunteer->reference_code) }}" target="_blank">Certificate</a>                                                                               
                                                @endif
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
