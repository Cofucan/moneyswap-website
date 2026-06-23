@extends('layouts.admin')
@section('page_title', 'Edit Profile ' . $client->name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
  #state_loading{
  visibility:hidden;
  }
  #city_loading{
  visibility:hidden;
  }
  #neighbourhood_loading{
  visibility:hidden;
  }
  #group_loading{
      visibility:hidden;
      }
</style>
@endpush
@section('content')

<div class="container-fluid">

  <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('clients')}}" class="s-text16">
          Clients
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Edit Client
        </span>
    </div>
  <div class="row">
        <div class="col-md-6 order-md-1">
          <h4 class="mb-3">Edit {{$client->name}} Data </h4>
          <form method="POST" action="{{ route('clients.update', $client) }}" id="EditStudent">
                {{csrf_field()}}
                @method('PUT')
                <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
                <div class="form-group">
                  <strong> Admission : </strong>
                  <input id="admission_no" type="text" value="{{$client->admission_no}}" class="form-control{{ $errors->has('admission_no') ? ' is-invalid' : '' }}" >

                </div>

                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"> Class </label>
                      <select id="batch_id" class="select2 form-control" name="batch_id" data-live-search="true" >
                          @foreach($batches as $key => $batch)
                           @if($key == $client->batch_id)
                           <option value="{{  $key }}" selected>{{ $batch }}</option>
                           @else
                          <option value="{{$key}}"> {{$batch}}</option>
                          @endif
                          @endforeach
                      </select>
                      @if ($errors->has('batch_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('batch_id') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="client_category_id"> Attendance Type </label>
                      <select name="client_category_id" class="custom-select d-block w-100 select2" id="student_type" required>
                          @foreach($clientcategories as $key => $student_type)
                          @if($key == $client->client_category_id)
                          <option value="{{  $key }}" selected>{{ $student_type }}</option>
                          @else
                            <option value="{{$key}}"> {{$student_type}}</option>
                          @endif
                          @endforeach
                      </select>
                      @if ($errors->has('client_category_id'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('client_category_id') }}</strong>
                                  </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status"> Client Group /Set </label>
                      <select id="cohort_id" class="select2 form-control" name="cohort_id" data-live-search="true" >
                          @foreach($cohorts as $key => $cohort)
                           @if($key == $client->cohort_id)
                           <option value="{{  $key }}" selected>{{ $cohort }}</option>
                           @else
                          <option value="{{$key}}"> {{$cohort}}</option>
                          @endif
                          @endforeach
                      </select>
                      @if ($errors->has('cohort_id'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('cohort_id') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="transaction_method_id"> Preferred Revenue Method </label>
                      <select name="transaction_method_id" class="custom-select d-block w-100 select2" id="student_type" required>
                          @foreach($transactionmethods as $key => $transactionmethod)
                          @if($key == $client->transaction_method_id)
                          <option value="{{  $key }}" selected>{{ $transactionmethod }}</option>
                          @else
                              <option value="{{$key}}"> {{$transactionmethod}}</option>
                              @endif
                          @endforeach
                      </select>
                      @if ($errors->has('transaction_method_id'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('transaction_method_id') }}</strong>
                                  </span>
                      @endif
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-success" type="submit" name="action" value="save">Save Changes</button>
                <button class="btn btn-primary" type="submit" name="action" value="rebill">Save & Regenerate Bill</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
  <script src="{{ asset('js/select2.full.min.js')}}"></script>

    <script>
      CKEDITOR.replace("remarks",
          {
              height: 100,
              // Define the toolbar streams as it is a more accessible solution.
          toolbarGroups: [{
            "name": "basicstyles",
            "streams": ["basicstyles"]
          },
          {
            "name": "links",
            "streams": ["links"]
          },
          {
            "name": "paragraph",
            "streams": ["list", "blocks"]
          },
          {
            "name": "document",
            "streams": ["mode"]
          },
          {
            "name": "insert",
            "streams": ["insert"]
          },
          {
            "name": "styles",
            "streams": ["styles"]
          },
          {
            "name": "about",
            "streams": ["about"]
          }
        ],
        // Remove the redundant buttons from toolbar streams defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
          });
    </script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
      jQuery(document).ready(function($) {
          $('input[name="graduation_year"]').daterangepicker({
              singleDatePicker: true,
              timePicker: true,
              locale: {
              format: 'YYYY/M/DD'
              }
          });
      });
  </script>

@endpush
