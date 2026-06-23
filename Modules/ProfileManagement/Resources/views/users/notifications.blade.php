@extends('layouts.admin')
@section('page_title', 'Notifications')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>

    #group_loading{
    visibility:hidden;
    }

    #live_loading{
    visibility:hidden;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-9 col-sm-8 content_title">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                Notifications
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>
        
        </div>            
       
    </div>    

    <div class="row">
        <div class="col-md-8 col-sm-9 content_title">
            <h4> Notifications </h4>	
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @foreach($notifications as $notification)
                        <div class="announcement mb-3">
                            <div class="col-md-12">
                                <a href="{{ route('announcements.show', $notification->id) }}">        
                                    <div class="row title">
                                        <div class="col-md-8 col-sm-8 col-8"><h6 class="">{{ $notification->type }}</h6></div>
                                        <div class="col-md-4 col-sm-4 col-4 text-right "><span class="s-text4"><i class="fa fa-clock-o"></i>: {{ $announcement->created_at }} </span></div>
                                    </div>
                                    <div class="announcement_body">
                                   {{ $notification->data['name'] }}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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
