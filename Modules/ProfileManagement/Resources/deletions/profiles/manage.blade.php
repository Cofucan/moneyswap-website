@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css')}} "/>
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
        .myDiv{
            display:none;
        }

    </style>
@endpush
@section('content')
    <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="row">
            <div class="col-md-7">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
                <span class="s-text17">
                Profiles
                </span>
            </div>
            <div class="col-md-5">
                <a href="{{url('profiles')}}" class="btn btn-sm btn-info">All Profiles </a>
                <a href="{{url('profiles/export')}}" class="btn btn-sm btn-warning">Export  </a>
                {{-- <a href="{{url('profiles/setup')}}" class="btn btn-sm btn-success">Generate Logins  </a> --}}
                @if (Auth::user()->profile->role_id == 1)
                <a href="{{url('profiles/create')}}" class="btn btn-sm btn-success"> <i class="fa fa-plus"></i> New Profile  </a>
                @endif

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 content_title">
            <h3> @if(isset($rolecategory)){{ str_plural($rolecategory) }} @endif Profiles </h3>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name </th>
                        <th> Gender</th>
                        <th>Role </th>
                        <th> Telephone</th>
                        {{-- <th>Created At </th> --}}
                        <th>Status</th>
                        <th width="18%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$profile->full_name  }}</td>
                        <td>{{ $profile->gender }}</td>
                        <td>{{$profile->Role->label }} </td>
                       <td>{{ $profile->telephone }} </td>
                        <td> {{ $profile->status}}  </td>
                        <td>
                        @include('profilemanagement::profiles._actions')
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
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

   <script>
      jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More');
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
 <script type="text/javascript">
    $('#country').on('change',function(){
    var country = $(this).val();
    if(country){
      $.ajax({
        type:"GET",
        url:"{{url('countries/get-state-list')}}?country="+country,
        beforeSend: function()
        {
          $('#state_loading').css("visibility", "visible");
        },
        success:function(res){
          if(res){

            $("#state").empty();

            $('#state_loading').css("visibility", "hidden");

            $.each(res,function(key,value)
            {
              $("#state").append('<option value="'+key+'">'+value+'</option>'); });
            }else
            {
              $("#state").empty();
            }
          } });
    }else{
      $("#state").empty();
    }
  });
  </script>

 @endpush
