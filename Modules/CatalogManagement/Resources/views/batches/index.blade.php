@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                Classes
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>


        </div>
<div class="row">
  <div class="col-md-8 content_title">
     	<h3> Classes </h3>
	</div>

</div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                @foreach ($batches as $stream => $batch_list)
                    <h5 class="bg-light">{{ $stream }} Class - {{ $batch_list->count() }} Arms </h5>

                    <table class="table w-100">
                    <tbody>
                        @include('schoolmanagement::batches._minihead')
                        @foreach($batch_list as $batch)
                        @include('schoolmanagement::batches._minidata')
                        @endforeach
                    </tbody>
                    </table>
                @endforeach
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
