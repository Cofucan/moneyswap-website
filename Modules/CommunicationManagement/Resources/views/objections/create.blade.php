@extends('layouts.admin')
@section('page_title', 'Add Payment')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
      <div class="col-md-8">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('payments')}}" class="s-text16">
            Collections
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Add Payment
        </span>
      </div>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>


        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Payment objection </h4>
          <form method="POST" action="{{ route('payments.store') }}" id="CreatePayment" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="mb-3 form-group">
                    <label for="invoice_id"> Invoice</label>
                    <select name="invoice_id" class="custom-select d-block w-100 select2" id="section" required>

                        @foreach($invoices as $key => $invoice)
                        <option value="{{$key}}"> {{ $invoice->invoice_title }} ({{$invoice->ref_code}})</option>
                        @endforeach
                    </select>
                    @if ($errors->has('invoice_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('invoice_id') }}</strong>
                                </span>
                    @endif
                  </div>
 
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="payment_type"> Payment Type</label>
                        <select id="payment_type" name="payment_type" class="custom-select select2 w-100 form-control" data-live-search="true" >
                            @foreach($transactionTypes as $key => $transactionType)
                            @if(old('payment_type') == $key)
                            <option value="{{$key}}" selected> {{$transactionType}}</option>
                             @else
                             <option value="{{$key}}"> {{$transactionType}}</option>
                             @endif
                         @endforeach
                              </select>
                        @if ($errors->has('payment_type'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('payment_type') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group mb-3">
                      <label for="reference_code">Payment Reference  </label>
                      <input type="text" name="reference_code" value="{{old('reference_code')}}" class="form-control{{ $errors->has('reference_code') ? ' is-invalid' : '' }}" placeholder="e.g Cheque No or Transaction ref"  id="reference_code" required/>
                      @if ($errors->has('reference_code'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('reference_code') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                <div class="form-row">
                  <div class="col-md-6 form-group mb-3">
                    <label for="email">Email  </label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="e.g Cheque No or Transaction ref"  id="email" required/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-md-6 form-group mb-3">
                    <label for="telephone">Telephone  </label>
                    <input type="tel" name="telephone" value="{{old('telephone')}}" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" placeholder="e.g Cheque No or Transaction ref"  id="telephone" required/>
                    @if ($errors->has('telephone'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('telephone') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-row mt-4">
                  <div class="col-md-6 form-group">
                    <label class="control-label" for="value_date">Payment Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" class="form-control{{ $errors->has('value_date') ? ' is-invalid' : '' }} pull-right" name="value_date"  value="{{old ('value_date')}}">
                    </div>

                    @if ($errors->has('value_date'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('value_date') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="col-md-6 form-group has-feedback">
                    <label class="control-label" for="amount_paid">Amount Paid&nbsp;<span class="requiredfield">*</span></label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <select id="currency" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a currency ...">
                              <option>NGN</option>
                              <option>USD</option>
                          </select>
                      </div>
                      <input type="text" class="form-control" value="{{old ('amount_paid')}} " id="amount_paid" name="amount_paid" placeholder="" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="narration">Narratives </label>
                  <textarea name="narration" class="form-control" id="narration" rows="2"></textarea>
                </div>


                <div class="form-row">
                  <div class="col-md-6 form-group">
                      <label for="status">Payment status</label>
                      <select class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="status" id="status" required>

                      @foreach($statuses as $key => $status)
                      @if(old('status') == $key)
                      <option value="{{$key}}" selected> {{$status}}</option>
                          @else
                          <option value="{{$key}}"> {{$status}}</option>
                          @endif
                      @endforeach
                      </select>
                      @if ($errors->has('status'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('status') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="col-md-6 form-group">
                      <label for="reference_document">Reference Document <span class="required"></span></label>
                      <input type="file" name="reference_document" value="{{old ('reference_document')}}" class="form-control{{ $errors->has('reference_document') ? ' is-invalid' : '' }}" id="reference_document"/>
                      @if ($errors->has('reference_document'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('reference_document') }}</strong>
                          </span>
                      @endif
                  </div>

                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Post </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
      jQuery(document).ready(function($) {
          $('input[name="value_date"]').daterangepicker({
              singleDatePicker: true,
              timePicker: false,
              // minDate: moment(),
              maxDate: moment(),
              locale: {
              format: 'YYYY-MM-DD'
              }
          });
      });
  </script>
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script>
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>

  <script type="text/javascript">

    $('#paymentable_type').on('change',function()  {
    var paymentable_type = $(this).val();
    if(paymentable_type){
      $.ajax({
        type:"GET",
        url:"{{url('payments/get-paymentable-list')}}?paymentable_type="+paymentable_type,
        beforeSend: function()
        {
          $('#live_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#paymentable").empty();
            $('#live_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#paymentable").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#paymentable").empty();
            }
          } });
    }else{
      $("#paymentable").empty();
    }
  });
  </script>
@endpush
