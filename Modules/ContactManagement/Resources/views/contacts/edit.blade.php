@extends('layouts.admin')
@section('page_title', $contact->contactable_type)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('contacts/manage')}}" class="s-text16">
          Contacts
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          Edit Contact
        </span>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Contact </h4>
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST"  id="UpdateContact">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="contactable_type"> Contact Object </label>
                            <select name="contactable_type" class="custom-select d-block w-100 select2" id="contactable_type" required>
                            <option>Choose one </option>
                                @foreach($contactableTypes as $key => $contactable_type)
                                @if($contact->contactable_type == $key)
                                <option value="{{$key}}" selected> {{$contactable_type}}</option>
                                    @else
                                    <option value="{{$key}}"> {{$contactable_type}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('contactable_type'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contactable_type') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="contactable_id"> Contact Owner</label>
                            <select name="contactable_id" class="custom-select d-block w-100 select2" id="contactable" required>

                            </select>
                            <span id="live_loading"><i class="fa fa-spinner  fa-spin"></i></span>
                            @if ($errors->has('contactable_id '))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('contactable_id ') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="contact_type">Contact Type</label>
                      <div class="input-group">
                        <div class="input-group-append">
                          <select class="custom-select w-100 select2" id="contact_type" name="contact_type">
                                @foreach($contactTypes as $contactType)
                                    @if($contact->contact_type == $contactType)
                                        <option value="{{  $contactType }}" selected>{{  $contactType }}</option>
                                    @else
                                        <option value="{{  $contactType }}">{{  $contactType }}</option>
                                    @endif
                                @endforeach
                          </select>
                        </div>
                        <input type="text" class="form-control" name="contact_value" id="contact_value" value="{{  $contact->contact_value }}">
                        <div class="input-group-prepend">
                          <select class="custom-select w-100 select2" id="contact_tag" name="contact_tag">
                                <option> Contact Tag</option>
                                @foreach($contactTags as $key => $contactTag)
                                @if($contact->contact_tag == $key)
                                    <option value="{{  $key }}" selected>{{  $contactTag }}</option>
                                @else
                                    <option value="{{  $key }}">{{  $contactTag }}</option>
                                @endif
                            @endforeach

                          </select>
                        </div>
                      </div>
                    </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>


        </div>
        <div class="col-md-3 offset-md-1">
            <div class="box box-collapsed">
                <div class="box-header text-center">
                    <h5>Publish</h5>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-desktop"></i>
                                Status:
                                <b>
                                        @if($contact->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>
                                <a href="#" onclick="editForm()">Edit </a></p>
                            @include('modals.status')
                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-bandcamp"></i>
                                Type: <b>{{ $contact->activity_type }}</b></p>

                        </div>
                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-clock-o"></i>
                                    Last Updated: <b>{{ $contact->updated_at }}</b></p>

                            </div>

                        

                        <div class="col-md-12 p-t-20">

                            <img src="{{ asset ($contact->thumbnail) }}" alt="{{$contact->activity_name }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')

<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
   $('.select2').select2();
  }
  );
  $('#contactable_type').on('change',function()
{
  var contactable_type = $(this).val();
  if(contactable_type){
    $.ajax({
      type:"GET",
      url:"{{url('contacts/get-contactable-list')}}?contactable_type="+contactable_type,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){

          $("#contactable").empty();

          $('#live_loading').css("visibility", "hidden");

          $.each(res,function(key,value)
          {
            $("#contactable").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#contactable").empty();
          }
        } });
  }else{
    $("#contactable").empty();
  }
});
</script>
@endpush
