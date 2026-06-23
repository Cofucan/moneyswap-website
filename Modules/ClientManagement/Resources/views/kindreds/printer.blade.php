@extends('layouts.slip')
@section('page_title', $label .' Report')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<div class="container">
    @include('partials.printheader')
  </div>
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-5 content_title">
        <h4> {{$label }} </h4>
      </div>
      <div class="col-md-3 content_title">
        <h4> Total Records: {{$clients->count() }} </h4>
      </div>
      <div class="col-md-4 content_title">
        <p><b> Generated On: </b> {{ date('d/m/Y H:i:s') }}</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
            <table class="table" id="table">
                @include('ClientManagement::clients._tablehead')
                @foreach($clients as $client)
                   @include('ClientManagement::clients._tabledata')
                @endforeach
                </tbody>

            </table>
        </div>
      </div>
  </div>
@endsection
@push('scripts')


 @endpush
