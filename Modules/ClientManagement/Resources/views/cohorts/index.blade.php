@extends('layouts.admin')
@section('page_title','Client Groups')
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
               Client Groups
            </span>
        </div>
<div class="row">
  <div class="col-md-8 content_title">

         <h3> Client Groups </h3>
         <small>

         </small>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Label</th>
                    <th >Clients</th>
                    <th >Last Modified</th>
                    <th >Status </th>

                </tr>
            </thead>
        <tbody>
            @foreach($cohorts as $cohort)
            <tr >
                <td>{{$loop->iteration}}</td>
                <td><a href="{{ route('cohorts.show',$cohort) }}"> {{$cohort->label}} </a></td>
                <td> {{ $cohort->Clients->count()}}</td>
                <td>{{$cohort->date_created}}</td>
                <td>{{ $cohort->status }}</td>

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

<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.select2').select2();
});
</script>

 @endpush
