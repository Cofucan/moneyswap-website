@extends('layouts.admin')
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
               Designations
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">

         <h3> Designations </h3>
	</div>

    <div class="col-md-4">
	  <div class="page_button">
            <a href="{{ url('designations/create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Designation </a>
      </div>

	</div>
</div>
    <div class="row">
        <div class="col-md-12 col-sm-12 table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Designation </th>
                        <th>Role </th>
                        <th>Status</th>
                        {{-- <th>Report to </th> --}}
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($designations as $designation)
                    <tr>
                        <td>{{$designation->id}}</td>
                        <td>{{$designation->job_role}} </td>
                        <td>{{$designation->Role->label}} </td>
                        <td>
                            @if ($designation->published == true)
                                Published
                                @else
                                Not Publish
                            @endif
                        </td>
                        {{-- <td>{{$designation->parent_id }}</td> --}}

                        <td>
                            <div class="row no-gutters">
                                <div class="col-md-10">
                                    <a class="btn btn-primary btn-sm show" href="{{ route('designations.show', $designation->id) }}">Details</a>
                                    <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit-designation{{$designation->id}}" href="#edit{{$designation->id}}"> Edit</a>
                                    @if($designation->published == true)
                                    <a class="btn btn-warning btn-sm" href="{{ url('designations/toggle', $designation->id)}}">Deactivate</a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ url('designations/toggle', $designation->id)}}">Activate</a>
                                    @endif
                                </div>
                                @if ($designation->Employees->count() < 1 )
                                    <div class="col-md-2">
                                        <form action="{{ route('designations.destroy',$designation->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @include('humanresources::designations._formedit')

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

<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
