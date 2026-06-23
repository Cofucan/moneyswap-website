@extends('layouts.admin')
@section('page_title', $event->event_title)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link href="{{ asset ('css/select2.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('events/manage')}}" class="s-text16">
			Manage
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			 Edit [{{$event->event_title}}]
		</span>
	</div>

    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Event </h4>
            <form action="{{ route('events.update', $event->id) }}" method="POST"  id="UpdateEvent" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-group">
                    <label for="event_title"> Title</label>
                    <input type="text" name="event_title" value="{{ $event->event_title}}" class="form-control{{ $errors->has('event_title') ? ' is-invalid' : '' }}" placeholder="Enter Event Title"  id="event_title" />
                    @if ($errors->has('event_title'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('event_title') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-row">
                    <div class="col-md-6 mb-3 form-group">
                        <label class="control-label" for="from_datetime">Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('from_datetime') ? ' is-invalid' : '' }} pull-right" name="from_datetime" id="datepicker" value="{{ $event->from_datetime }}">
                        </div>

                        @if ($errors->has('from_datetime'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('from_datetime') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="to_datetime">End Date</label>
                        <input type="text" name="to_datetime" value="{{ $event->to_datetime}}" class="form-control{{ $errors->has('to_datetime') ? ' is-invalid' : '' }}"  id="to_datetime" />
                        @if ($errors->has('to_datetime'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('to_datetime') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('to_datetime'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('to_datetime') }}</strong>
                            </span>
                        @endif
                    </div>

                    
                </div>

                <div class="form-group ">
                    <label for="event_description">Description</label>
                    <textarea name="event_description" class="form-control{{ $errors->has('event_description') ? ' is-invalid' : '' }}" placeholder="Enter description">
                    {!! $event->event_description !!}
                    </textarea>
                    @if ($errors->has('event_description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('event_description') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-row">
                    <div class="col-md-6 form-group">
                    <label for="event_status">Event status</label>
                    <select class="custom-select d-block w-100 select2"  name="event_status" id="event_status" required>

                       @foreach($event_statuses as $key => $status)
                       @if($event->event_status == $key)
                       <option value="{{$key}}" selected> {{$status}}</option>
                        @else
                        <option value="{{$key}}"> {{$status}}</option>
                        @endif
                    @endforeach
                    </select> 
                    @if ($errors->has('event_status'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('event_status') }}</strong>
                        </span>
                    @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="display_image">Display Image</label>
                        <input type="file" name="display_image" value="{{old ('display_image')}}" class="form-control" id="display_image" />
                        @if ($errors->has('display_image'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('display_image') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Update </button>
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
                                        @if($event->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>

                        </div>

                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-desktop"></i>
                                    Event Status: <b>{{ $event->event_status}}</b></p>

                        </div>

                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-clock-o"></i>
                                    Last Updated: <b>{{ $event->updated_at }}</b></p>

                        </div>



                        <div class="col-md-12 p-t-20">
                            <img src="{{ asset ($event->thumbnail) }}" alt="{{$event->event_title }}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="from_datetime"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                locale: {
                format: 'YYYY-MM-DD hh:mm'
                }
            });
        });
    </script>
    <script>
         jQuery(document).ready(function($) {
            $('input[name="to_datetime"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                locale: {
                format: 'YYYY-MM-DD hh:mm'
                }
            });
        });
    </script>
    <script>
        CKEDITOR.replace("event_description",
       {
           height: 150,
           // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [{
         "name": "basicstyles",
         "groups": ["basicstyles"]
       },
       {
         "name": "links",
         "groups": ["links"]
       },
       {
         "name": "paragraph",
         "groups": ["list", "blocks"]
       },
       {
         "name": "document",
         "groups": ["mode"]
       },
       {
         "name": "insert",
         "groups": ["insert"]
       },
       {
         "name": "styles",
         "groups": ["styles"]
       },
       {
         "name": "about",
         "groups": ["about"]
       }
     ],
     // Remove the redundant buttons from toolbar groups defined above.
     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
    </script>
    <script type="text/javascript">
        $('#city').on('change',function(){
            var city = $(this).val();
            if(city){
            $.ajax({
            type:"GET",
            url:"{{url('cities/get-neighbourhood-list')}}?city="+city,
            beforeSend: function()
            {
            $('#city_loading').css("visibility", "visible");
            },
            success:function(res){
            if(res){
                $("#neighbourhood").empty();

                $('#city_loading').css("visibility", "hidden");

                $.each(res,function(key,value)
                {
                $("#neighbourhood").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                $("#neighbourhood").empty();
                }
            } });
            }else{
            $("#neighbourhood").empty();
            }
        });
    </script>
@endpush
