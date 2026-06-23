@extends('layouts.admin')
@section('page_title', 'Client Logs')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">

                <div class="col-md-8">
                    <a href="{{ url ('home')}}" class="s-text16">
                        <i class="fa fa-home"></i> Dashboard
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </a>

                    <span class="s-text16">
                    Holiday
                        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                    </span>

                    <span class="s-text17">
                        Manage
                    </span>
                </div>
                <div class="col-md-4">

                    <div class="page_button">
                        <a href="{{ url('communications/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
                        <a href="{{ url('communications/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
                        <a href=""><button class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></button></a>
                    </div>
                </div>

        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Client Logs </h3>	<small>My clients activities/performance Log</small>
	</div>

</div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
            <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Client </th>
                        <th> Subject </th>
                        <th> Date </th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($communications as $communication)
                <tr>
                    <td>{{ $communication->id }}</td>
                    <td>{{$communication->Client->Person->candidate_name}} </td>
                    <td>{{ $communication->subject }} </td>
                    <td>{{ $communication->activity_type }} </td>
                    <td>{{$communication->AcademicTerm->academic_term }}  </td>
                    <td>
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <a class="btn btn-secondary btn-sm show" href="{{ route('communications.show', $communication->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-sm" href="{{ route('communications.edit',$communication->id) }}"><i class="fa fa-edit"></i> </a>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('communications.destroy',$communication->id) }}" method="post"
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
