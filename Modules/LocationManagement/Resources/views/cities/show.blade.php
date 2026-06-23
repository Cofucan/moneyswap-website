@extends('layouts.admin')
@section('page_title','Cities')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/reveal.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Cities
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">

         <h3> Cities </h3>
         <small>

         </small>
	</div>
    <div class="col-md-2">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> Add City                                         
        </button>
    </div>
  <div class="col-md-2">
	  <div class="page_button">
	 	<a href="{{ url('cities/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
      </div>
        {{-- modal begins--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Create new City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('cities.store') }}" id="CreateDesignation" enctype="multipart/form-data"> 
                        {{csrf_field()}}
                                        
                            @include('cities._form')

                            <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save </button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal ends--}}
	</div>
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >City Code</th>
                    <th > City Name</th>
                    <th >State</th>
                    <th >Population (Estimate) </th>
                    <th >Latitude</th>
                    <th >Longitude </th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($cities as $city)
            <tr>
                    <td>{{$city->id}}</td>
                    <td>{{$city->city_code}}</td>
                    <td>{{$city->city_name}}</td>
                    <td>{{$city->State->state_name}}</td>
                    <td>{{$city->population_estimate}}</td>
                    <td>{{$city->latitude}}</td>
                    <td>{{$city->longitude}}</td>   
                
                <td>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$city->id}}">
                                <i class="fa fa-edit"></i>                                           
                            </button>
                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal-lg{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$city->id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{ route('cities.update', $city) }}" id="UpdateDesignation" enctype="multipart/form-data"> 
                                                    {{csrf_field()}}  
                                                    @method('PUT')
                                                   <input type="hidden" name="city_id" id="city_id" value="{{$city->id}}">             
                                                    @include('cities._formedit')
                        
                                                    <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Save </button>
                                                    <button class="btn btn-primary" type="reset">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- modal ends--}}
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('cities.destroy', $city) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </td>
                

            </tr>
            @endforeach
            </tbody>
            </table>
</div>
</div>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
        
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More Info');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
  
  </script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 <script>
    CKEDITOR.replace("description",
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
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
