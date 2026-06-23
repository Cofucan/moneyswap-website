@extends('layouts.admin')
@section('content_title', 'Add Neigbourhood')
@push('styles')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
			<div class="row">
		        <div class="col-md-6 content_title">
		        	<h3> Blank Page </h3>
		        	<small>It all starts here</small>
		        </div>

		        <div class="col-md-6">
		        	<!-- <ol class="breadcrumb">
				        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				        <li><a href="#">Examples</a></li>
				        <li class="active">Blank page</li>
				    </ol> -->
				    <div class="page_button">
		        	<button class="btn btn-sm btn-outline-secondary">Import</button>
                    <button class="btn btn-sm btn-outline-secondary">Export</button>
		        	</div>
		        </div>
	      	</div>
	      	<div class="row">
              <div class="table-responsive">
            <table class="table table-striped table-sm" id="cities">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">City Code</th>
                        <th class="text-center"> City Name</th>
                        <th class="text-center">Population (Estimate) </th>
                        <th class="text-center">State</th>
                        <th class="text-center">Latitude</th>
                        <th class="text-center">Longitude </th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $city)
                    <tr class="city{{$city->id}}">
                    <td>{{$city->id}}</td>
                    <td>{{$city->city_code}}</td>
                    <td>{{$city->city_name}}</td>
                    <td>{{$city->population_estimate}}</td>
                    <td>{{$city->country_code}}</td>
                    <td>{{$city->latitude}}</td>
                    <td>{{$city->longitude}}</td>    
                    <td> 
                <button class="edit-modal btn btn-info"
                data-info="{{$city->id}},{{$city->first_name}},{{$city->last_name}},
                {{$city->population_estimate}},{{$city->city_id}},{{$city->longitude}},{{$city->latitude}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger"
                data-info="{{$city->id}},{{$city->first_name}},{{$city->last_name}},{{$city->population_estimate}},{{$city->city_id}},{{$city->longitude}},{{$city->latitude}}">
            <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table> 
            
		  </div>

	      	</div>
              @include('cities.modal')		
@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#cities').DataTable();
} );
 </script>
 <script>
	
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

function fillmodalData(details){
    $('#fid').val(details[0]);
    $('#city_code').val(details[1]);
    $('#city_name').val(details[2]);
    $('#population_estimate').val(details[3]);
    $('#city_id').val(details[4]);
    $('#longitude').val(details[5]);
    $('#latitude').val(details[6]);
}

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'city_code': $('#city_code').val(),
                'city_name': $('#city_name').val(),
                'population_estimate': $('#population_estimate').val(),
                'city_id': $('#city_id').val(),
                'longitude': $('#longitude').val(),
                'latitude': $('#latitude').val()
            },
            success: function(data) {
            	if (data.errors){
                	$('#myModal').modal('show');
                    if(data.errors.city_code) {
                    	$('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.city_name) {
                    	$('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.population_estimate) {
                    	$('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.longitude) {
                    	$('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.latitude) {
                    	$('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.first_name +
                        "</td><td>" + data.last_name + "</td><td>" + data.population_estimate + "</td><td>" +
                         data.city_id + "</td><td>" + data.longitude + "</td><td>" + data.latitude +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.population_estimate+","+data.city_id+","+data.longitude+","+data.latitude+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.population_estimate+","+data.city_id+","+data.longitude+","+data.latitude+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

            	 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.city' + $('.did').text()).remove();
            }
        });
    });
</script>
 @endpush