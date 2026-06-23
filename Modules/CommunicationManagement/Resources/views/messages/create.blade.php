@extends('layouts.admin')
@section('page_title', 'Compose Message')

@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/util.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">

@endpush
@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('messages')}}" class="s-text16">
			Messages
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
                Compose Message
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
          <form method="POST" action="{{ route('messages.store') }}" id="CreateMessage" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="role_category_id">Profile Types</label>
                        <select name="role_category_id" class="custom-select d-block w-100 select2" id="rolecategory" required>
                            <option value=""> Select Section</option>
                                @foreach($rolecategories as $key => $rolecategory)
                                    @if(old('role_category_id') == $key)
                                    <option value="{{$key}}" selected> {{$rolecategory }}</option>
                                        @else
                                    <option value="{{$key}}">  {{$rolecategory }}</option>
                                    @endif
                                @endforeach
                        </select>
                        @if ($errors->has('role_category_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('role_category_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="profiles"> Profile </label>
                        <select name="profiles[]" class="custom-select d-block w-100 select2" multiple="multiple" id="profiles" data-live-search="true">
                        </select>
                        <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                        @if ($errors->has('profiles '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('profiles ') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="message_subject"> Subject <span class="required">*</span></label>
                    <input type="text" name="message_subject" value="{{  old('message_subject') }}" class="form-control{{ $errors->has('message_subject') ? ' is-invalid' : '' }}"   id="message_subject" required/>
                    @if ($errors->has('message_subject'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('message_subject') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message_body">Message</label>
                    <textarea name="message_body" class="form-control" rows="4" >
                        {!! Old('message_body') !!}
                    </textarea>
                    @if ($errors->has('message_body'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('message_body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                  <div class="col-md-6 form-group">
                      <label for="message_status">Action</label>
                      <select class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="message_status" id="message_status" required>

                      @foreach($actions as $key => $action)
                      @if(old('status') == $key)
                      <option value="{{$key}}" selected> {{$action}}</option>
                          @else
                          <option value="{{$key}}"> {{$action}}</option>
                          @endif
                      @endforeach
                      </select>
                      @if ($errors->has('status'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('status') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="col-md-6">
                    <label for="attachments"> Attach Files <span class="required">*</span></label>
                    <input type="file" name="attachments[]" value="{{  old('attachments') }}" class="form-control{{ $errors->has('attachments') ? ' is-invalid' : '' }}"   multiple="multiple" id="attachments" />
                    @if ($errors->has('attachments'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('attachments') }}</strong>
                        </span>
                    @endif
                  </div>

                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Submit</button>
                
                {{--  <button class="btn btn-primary pull-right" type="save">Submit</button>  --}}

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

        $('#rolecategory').on('change',function()  {
        var rolecategory = $(this).val();
        if(rolecategory){
          $.ajax({
            type:"GET",
            url:"{{url('rolecategories/get-profiles')}}?rolecategory="+rolecategory,
            beforeSend: function()
            {
              $('#live_loading').css("visibility", "visible");
            },
            success:function(res){
              if(res){
                $("#profiles").empty();
                $('#live_loading').css("visibility", "hidden");
                $.each(res,function(key,value)
                {
                  $("#profiles").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                  $("#profiles").empty();
                }
              } });
        }else{
          $("#profiles").empty();
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
