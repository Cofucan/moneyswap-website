@extends('layouts.admin')
@section('page_title','Manage Client batches' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('cohorts') }}"> Client Groups </a></li>

        <div class="ml-auto mr-0">
            @include('ClientManagement::cohorts.createmodal')
        </div>
    </ol>
</nav>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Manage Client Groups </h3>
	</div>

</div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table w-100" id="table">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Label</th>
                            <th >Clients</th>
                            <th >Last Modified</th>
                            <th >Status </th>

                            <th  width="30%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cohorts as $cohort)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cohort->label}}</td>
                            <td> {{ $cohort->Clients->count()}}</td>
                            <td>{{$cohort->date_created}}</td>
                            <td>{{ $cohort->status }}</td>
                            <td>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <a class="btn btn-secondary btn-sm" href="{{ route('cohorts.show',$cohort) }}">Details</a>
                                    </div>
                                    @if($cohort->status =='Draft' || $cohort->status =='Scheduled')

                                    <div class="col-md-2">
                                        <form action="{{ route('cohorts.destroy',$cohort) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i> </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
