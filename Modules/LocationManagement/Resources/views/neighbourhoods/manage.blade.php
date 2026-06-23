@extends('layouts.admin')
@section('page_title','Neighbourhoods')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/reveal.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    
    #city_loading{
    visibility:hidden;
    }
  
</style>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Neighbourhoods
            </span>
        </div>
<div class="row">
  <div class="col-md-7 content_title">

         <h3> Neighbourhoods </h3>
         <small>

         </small>
	</div>
    <div class="col-md-3">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> Add Neighbourhood                                         
        </button>
    </div>
  <div class="col-md-2">
	  <div class="page_button">
	 	<a href="{{ url('neighbourhoods/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
      </div>
        {{-- modal begins--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-center">Create new Neighbourhood</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('neighbourhoods.store') }}" id="CreateNeoghbourhood"> 
                        {{csrf_field()}}
                                        
                            @include('neighbourhoods._form')

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
                    <th >Postal Code</th>
                    <th > Neighbourhood Name</th>
                    <th >State</th>
                    <th >Population (Estimate) </th>
                    <th >Latitude</th>
                    <th >Longitude </th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($neighbourhoods as $neighbourhood)
            <tr>
                    <td>{{$neighbourhood->id}}</td>
                    <td>{{$neighbourhood->postal_code}}</td>
                    <td>{{$neighbourhood->neighbourhood_name}}</td>
                    <td>{{$neighbourhood->City->city_name}}</td>
                    <td>{{$neighbourhood->population_estimate}}</td>
                    <td>{{$neighbourhood->latitude}}</td>
                    <td>{{$neighbourhood->longitude}}</td>   
                
                <td>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$neighbourhood->id}}">
                                <i class="fa fa-edit"></i>                                           
                            </button>
                            {{-- modal begins--}}
                                <div class="modal fade bd-example-modal-lg{{$neighbourhood->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-center">Edit {{$neighbourhood->id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <strong>City</strong>: {{$neighbourhood->City->city_name}}
                                                </div>
                                                <form method="POST" action="{{ route('neighbourhoods.update', $neighbourhood->id) }}" id="UpdateDesignation" enctype="multipart/form-data"> 
                                                    {{csrf_field()}}  
                                                    @method('PUT')
                                                   <input type="hidden" name="city_id" id="city_id" value="{{$neighbourhood->id}}">             
                                                    @include('neighbourhoods._formedit')
                        
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
                            <form action="{{ route('neighbourhoods.destroy', $neighbourhood->id) }}" method="post"
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
<script type="text/javascript">
    $('#state').on('change',function(){
    var state = $(this).val();
    if(state){
    $.ajax({
    type:"GET",
    url:"{{url('states/get-city-list')}}?state="+state,
    beforeSend: function()
    {
      $('#city_loading').css("visibility", "visible");
    },
    success:function(res){
      if(res){

        $("#city").empty();

        $('#city_loading').css("visibility", "hidden");

        $.each(res,function(key,value)
        {
          $("#city").append('<option value="'+key+'">'+value+'</option>'); });
        }else
        {
          $("#city").empty();
        }
      } });
    }else{
    $("#city").empty();
    }
  });
</script>
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
 
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
