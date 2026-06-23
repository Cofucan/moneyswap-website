@extends('layouts.admin')
@section('page_title','Roles')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
               Roles
            </span>
        </div>
<div class="row">
  <div class="col-md-6 content_title">

         <h3> Roles </h3>
         <small>

         </small>
	</div>
    <div class="col-md-2">
        <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
            <i class="fa fa-plus"></i> Add Role
        </button>
    </div>
  <div class="col-md-2">
        {{-- modal begins--}}
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-role text-center">Add new Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('roles.store') }}" id="CreateIndustry">
                        {{csrf_field()}}

                            @include('roles._form')

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
      <div class="col-md-8 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Role </th>
                        <th>Department </th>
                        <th>Description</th>
                        <th> Status </th>
                        <th width="18%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$role->label}} </td>
                        <td>{{$role->Department->label}} </td>
                        <td>{{$role->overview}} </td>
                        <td>
                            @if($role->published == 1)
                            Published
                            @else
                            Not Published
                            @endif
                        </td>
                        <td>
                            <div class="row no-gutters">

                                <div class="col-md-4">
                                    @if($role->published == 1)
                                    <a class="btn btn-warning btn-sm" href="{{ url('roles/toggle', $role->id)}}"><i class="fa fa-power-off"></i></a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ url('roles/toggle', $role->id)}}"><i class="fa fa-play-circle-o"></i></a>
                                    @endif
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg{{$role->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    {{-- modal begins--}}
                                        <div class="modal fade bd-example-modal-lg{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-role text-center">Update {{$role->industry_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="POST" action="{{ route('roles.update', $role->id) }}" id="UpdateIndustry" >
                                                            {{csrf_field()}}
                                                            @method('PUT')
                                                            @include('roles._formedit')

                                                            <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Update </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- modal ends--}}
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('roles.destroy',$role->id) }}" method="post"
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
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 <script>
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add Descriptions');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
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
