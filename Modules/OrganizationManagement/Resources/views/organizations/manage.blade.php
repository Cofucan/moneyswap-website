@extends('layouts.admin')
@section('page_title', 'Organization Manager')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-8 col-sm-6">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            
            <span class="s-text17">
                Manage Organization
            </span>
        </div>
        <div class="col-md-4 col-sm-6">
            {{-- <a href="{{ url('organizations/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
             <a href="{{ url('organizations/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
            <a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a> --}}
        </div>
	</div>
<div class="row">
    <div class="col-md-8 guideline_title">
     	<h3> Organization </h3>
	</div>
   
</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12">

        <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Official Logo</th>
                    <th>Legal Name</th>
                    <th>Industry</th>
                    <th> reg_number</th>
                    <th  width="15%">Actions</th>
                </tr>
            </thead>
            <tbody >
                @foreach($organizations as $organization)
                <tr>
                    <td>{{$organization->id}}</td>
                    <td><img src="{{ asset ($organization->official_logo) }}" class="img-responsive" alt="Official Logo" height="70px" width="70px" /></td>
                    <td>{{$organization->organization_name}}</td>
                    <td>@foreach ($organization->Industries as $i)
                        {{$organization->Industry->industry_name}}
                    @endforeach
                        </td>
                    <td>{{$organization->reg_number}}</td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-7">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('organizations.show', $organization->id) }}"> <i class="fa fa-eye"></i> </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('organizations.edit',$organization->id) }}"><i class="fa fa-edit"></i> </a>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('organizations.destroy',$organization->id) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    {{ csrf_field() }}
                                    <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
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

 @endpush
