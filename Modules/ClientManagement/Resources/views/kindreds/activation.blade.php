@extends('layouts.admin')
 @section('page_title')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    .card{
        overflow: hidden;
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url ('levels/manage')}}"> Classes </a></li>
            <div class="ml-auto mr-0">

            </div>
        </ol>
    </nav>

    <div class="row details p-t-20">

        <div class="col-md-3">
            <h5>Last enrolment Class: <b>{{$level->label}}</b></h5>
            <h5>Affected Clients : <b>{{$clients->count()}}</b></h5>
        </div>
        <div class="col-md-12"></div>

        <div class="col-md-6" id="tab">
            <div class="card">
                <div class="card-header">
                    <h5>Clients</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clients.bulkactivate') }}" id="BulkActivate">
                        {{csrf_field()}}
                        <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}">
                        <input type="hidden" name="enrolment_action" value="Activate">

                        {{-- <div class="form-group">
                            <strong>Current Class: </strong> {{$level->label}}
                        </div> --}}

                        <div class="mb-3 form-group">
                            <label class="control-label" for="admission_year">Clients to be re-enrolled</label>
                            <select name="clients[]" class="custom-select d-block w-100 select2 multiple" id="academic_term" required multiple >
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}"> {{$client->name}}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('orphan_id'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('orphan_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="grade_id">Class to be enrolled</label>
                            <select class="custom-select d-block w-100 select2"  name="grade_id" id="level">
                                <option value=""> Select Class</option>
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}"> {{$level->label}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('grade_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('grade_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="program">Stream </label> <span id="live_loading"><i class="fa fa-spinner fa-spin"></i> Loading</span>
                            <select name="stream_id" class="custom-select d-block w-100 select2 {{ $errors->has('stream_id') ? ' is-invalid' : '' }}" id="stream" required>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Continue</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>





@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
=
 <script>
    $('#level').on('change',function(){
      var level = $(this).val();
      if(level){
        $.ajax({
          type:"GET",
          url:"{{url('levels/get-streams')}}?level="+level,
          beforeSend: function()
          {
            $('#live_loading').css("visibility", "visible");
          },
          success:function(res){
            if(res){

              $("#stream").empty();
              $('#live_loading').css("visibility", "hidden");
              $.each(res,function(key,value)
              {
                $("#stream").append('<option value="'+key+'">'+value+'</option>'); });
              }else
              {
                $("#stream").empty();
              }
            } });
      }else{
        $("#stream").empty();
      }
    });
</script>

 @endpush
