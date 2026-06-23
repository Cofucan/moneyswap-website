@extends('layouts.admin')
@section('page_title', 'Editing Message')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/util.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<style>
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

		<a href="{{ url ('messages/manage')}}" class="s-text16">
			Messages
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
                Editing Draft
		</span>
	</div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          {{--  <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instructions</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>  --}}


        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Compose Message </h4>
          < <form action="{{ route('messages.update', $message->id) }}" method="POST"  id="UpdateMessage" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
                <div class="form-group">
                    <label for="message_tag"> To <span class="required">:</span></label>
                    <div class="custom-control custom-radio custom-control-inline p-l-40">
                        <input id="Management" name="role" type="radio" value="Male" class="custom-control-input" required>
                        <label class="custom-control-label" for="Management">Management</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="Parents" name="role" type="radio" value="Parents" class="custom-control-input" required>
                        <label class="custom-control-label" for="Parents">Parents</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="Teacher" name="role" type="radio" value="Teacher" class="custom-control-input" required>
                        <label class="custom-control-label" for="Teacher">Teacher</label>
                    </div>

                    <select name="recipients[]" class="custom-select d-block w-100 select2" multiple="multiple" id="level" data-live-search="true" required>
                    </select>
                        <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                        @if ($errors->has('recipients '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('recipients ') }}</strong>
                        </span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="message_subject"> Message Subject <span class="required">*</span></label>
                    <input type="text" name="message_subject" value="{{  $message->message_subject }}" class="form-control{{ $errors->has('message_subject') ? ' is-invalid' : '' }}"   id="message_subject" required/>
                    @if ($errors->has('message_subject'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('message_subject') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message_body">Message</label>
                    <textarea name="message_body" class="form-control" rows="4" >
                        {!! $message->message_body !!}
                    </textarea>
                    @if ($errors->has('message_body'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('message_body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="attachments"> Attach Files <span class="required">*</span></label>
                    <input type="file" name="attachments[]" value="{{ $message->attachments }}" class="form-control{{ $errors->has('attachments') ? ' is-invalid' : '' }}"   multiple="multiple" id="attachments" />
                    @if ($errors->has('attachments'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('attachments') }}</strong>
                        </span>
                    @endif
                </div>


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Send </button>
                <button class="btn btn-primary pull-right" type="save">Save</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
    <script>
        CKEDITOR.replace( 'message_body' );
    </script>
 <script type="text/javascript">

    $('#program').on('change',function()  {
    var program = $(this).val();
    if(program){
      $.ajax({
        type:"GET",
        url:"{{url('sections/get-levels')}}?program="+program,
        beforeSend: function()
        {
          $('#live_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){
            $("#level").empty();
            $('#live_loading').css("visibility", "hidden");
            $.each(res,function(key,value)
            {
              $("#level").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#level").empty();
            }
          } });
    }else{
      $("#level").empty();
    }
    });
  </script>

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    jQuery(document).ready(function($) {
        $('input[name="publish_datetime"]').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            locale: {
            format: 'YYYY/M/DD hh:mm A'
            }
        });
    });
</script>

@endpush
