@extends('layouts.admin')
@section('page_title', 'Payment Notices')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-9 col-sm-12">
            <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text16">
               Payments
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>
        </div>
      <div class="col-md-3 col-sm-12">

        {{-- <div class="page_button text-right">
          <a class="btn btn-sm btn-primary" href=""><i class="fa fa-user-info"></i> Import</a>
          <a class="btn btn-sm btn-warning " href=""><i class="fa fa-file-o"></i> Export</a>
        </div> --}}
      </div>
    </div>

    <div class="row">
        <div class="col-md-9 content_title">
            <h3> Payment Notices </h3>
            <small></small>
        </div>

        <div class="col-md-3 content_title">
        @if ($invoices->count() > 0)
         @include('advices._modal_full')     
         @endif                
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive-md">
                    <table class="table w-100" id="table">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Description</th>
                                <th >Amount</th>
                                <th >Date Initiated </th>
                                <th >Value Date </th>
                                <th >Payment Method </th>
                                <th >Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($advices as $advice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $advice->Invoice->ref_code}}</td>
                                    <td> {{ $advice->currency}} {{ number_format($advice->amount, 2)}}</td>
                                    <td>{{ $advice->created_at}}</td>
                                    <td>{{ $advice->value_date}}</td>
                                    <td>{{ $advice->TransactionMethod->label}}</td>
                                    <td>{{ $advice->status }}</td>
                                    <td>       
                                        <a class="btn btn-primary  btn-sm" target="_blank" href="{{ route('advices.show',$advice->id) }}">Details</a>                             
                                    {{-- @if($advice->status == 'Pending' && $advice->transactionMethod->type == 'Online')
                                    <form action="{{ route('advices.process') }}" method="POST"
                                        onsubmit="return confirm('Click OK to confirm and continue ');">
                                        {{csrf_field()}}
                                    <input type="hidden" name="advice_id" value="{{ $advice->id }}">
                                    <input type="hidden" name="todo" value="Verify">
                                    </form>
                                    @endif --}}
                                    @include('paymentmanagement::advices._action')
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
