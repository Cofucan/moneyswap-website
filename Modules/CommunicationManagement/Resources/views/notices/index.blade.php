@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush
@section('content')

<div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <div class="col-md-8 content_title">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text16">
                Announcements
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </span>
        </div>
        {{-- <div class="col-md-4">
            <a href="{{ url('announcements/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>
            <a href="{{ url('announcements/import') }}"><button class="btn btn-sm btn-primary">Import  <i class="fa fa-arrow-down"></i></button></a>
            <a href=""><button class="btn btn-sm btn-warning">Export  <i class="fa fa-arrow-up"></i></button></a>
        </div> --}}
    </div>
    <div class="container-fluid">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @foreach($announcements as $announcement)
            <div class="announcement mb-3">
                    <div class="col-md-12  ">
                        <a href="{{ route('announcements.show', $announcement->id) }}">

                            <div class="row title">
                                <div class="col-md-8 col-sm-8 col-8"><h6 class="">{{ $announcement->headline }}</h6></div>
                                <div class="col-md-4 col-sm-4 col-4 text-right "><span class="s-text4"><i class="fa fa-clock-o"></i>: {{ $announcement->publish_date }} </span></div>
                            </div>
                            <div class="announcement_body">
                            {!! str_limit($announcement->announcement_body, $limit = 70, $end = '...')!!}
                            </div>
                        </a>
                        </div>
                </div>
            @endforeach
        </div>
</div>

@endsection
@push('scripts')


 @endpush
