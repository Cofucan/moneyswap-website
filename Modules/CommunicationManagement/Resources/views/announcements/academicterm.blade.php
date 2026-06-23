@extends('layouts.admin')
@section('page_title', 'Announcements')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 content_title">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text16">
                    Announcement
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </span>

                <span class="s-text17">
                    Manage
                </span>
            </div>
            <div class="col-md-4">
                <a href="{{ url('announcements/create') }}"><button class="btn btn-sm btn-success">New <i class="fa fa-plus"></i></button></a>

            </div>
        </div>
    <div class="row">
        <div class="col-md-8 content_title">
            <h4> Announcement </h4>	<small>

            </small>
        </div>
        <div class="col-md-4">


        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="table-responsive">
            <table class="table w-100" id="table">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Subject</th>
                    <th >Status</th>
                    <th >Date</th>
                    <th >By</th>
                    <th  width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($announcements as $announcement)
            <tr>
                <td>{{$loop->iteration }}</td>
                <td>{{$announcement->subject}} <br>
                    {!!$announcement->summary!!}
                </td>
                <td>{{$announcement->publish_date }}</td>
                <td>{{$announcement->User->Profile->name }}</td>
                <td>
                @if($announcement->published == 1)
                <span class="enable">Published</span>
                @else
                <span class="disable"> Not Published</span>
                @endif
                </td>
                <td>

                <div class="row no-gutters">
                    <div class="col-md-3">
                        <a class="btn btn-secondary btn-sm" href="{{ route('announcements.show', $announcement->id) }}"><i class="fa fa-eye"></i> </a>
                    </div>
                    @if($announcement->user_id == Auth::id())
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-sm" href="{{ route('announcements.edit',$announcement->id) }}"><i class="fa fa-edit"></i> </a>
                        </div>
                        <div class="col-md-4">
                            @if($announcement->published == 1)
                            <a class="btn btn-warning btn-sm" href="{{ url('announcements/toggle', $announcement->id)}}"><i class="fa fa-power-off"></i></a>
                            @else
                            <a class="btn btn-success btn-sm" href="{{ url('announcements/toggle', $announcement->id)}}"><i class="fa fa-play-circle-o"></i></a>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('announcements.destroy',$announcement->id) }}" method="post"
                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="_method" value="DELETE" />
                                {{ csrf_field() }}
                                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                    @if(($announcement->status == 'Scheduled' &&Auth::user()->profile->role_id == 2))
                    <div class="col-md-4">
                        <a class="btn btn-primary btn-sm" href="{{ route('lives.edit',$announcement->id) }}"><i class="fa fa-edit"></i> </a>
                    </div>
                    <div class="col-md-2">
                        <form action="{{ route('announcements.process') }}" method="post"
                            onsubmit="return confirm('Are you sure you want perform the action?');">
                            <input type="hidden" name="announcement_id" value="{{ $announcement->id }}" />
                            {{ csrf_field() }}
                            <button type="submit" name="status" value="Approved" class="btn btn-sm btn-success action_btn"> <i class="fa fa-check"></i></button>
                            <button type="submit" name="status" value="Rejected" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-times"></i></button>
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
