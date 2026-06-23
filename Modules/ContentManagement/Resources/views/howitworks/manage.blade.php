@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style>
  .hiw-table-thumb {
    width: 56px;
    height: 56px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
  }
  .hiw-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 2px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }
  .hiw-status--live {
    background: #dcfce7;
    color: #166534;
  }
  .hiw-status--off {
    background: #fee2e2;
    color: #991b1b;
  }
</style>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">How It Works</li>
        <div class="ml-auto mr-0">
            <a href="{{ route('howitworks.groups.manage') }}" class="btn btn-sm btn-outline-primary mr-2">Manage Workflow Groups</a>
            <a href="{{ url('howitworks/create') }}" class="btn btn-sm btn-success">Add How it Works</a>
        </div>
    </ol>
</nav>
<div class="row">
  <div class="col-md-6 content_title">

     	<h4>  How It Works </h4>
	</div>
    
</div> 
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">

            <table class="table" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Display Image</th>
                    <th>Workflow Groups</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
        <tbody>
            @foreach($howitworks as $howitwork)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$howitwork->label}}</td>
                <td>
                  @php
                    $thumb = $howitwork->display_image ? asset($howitwork->display_image) : asset('img/icons/upload-img.jpg');
                    $extension = strtolower(pathinfo((string) $howitwork->display_image, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
                  @endphp
                  @if($isVideo && !empty($howitwork->display_image))
                    <video class="hiw-table-thumb" muted loop playsinline controls>
                      <source src="{{ $thumb }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
                    </video>
                  @else
                    <img src="{{ $thumb }}" alt="{{ $howitwork->label }}" class="hiw-table-thumb">
                  @endif
                </td>
                <td>
                  @php
                    $groupNames = $howitwork->groups->pluck('name')->filter()->values();
                  @endphp
                  {{ $groupNames->isNotEmpty() ? $groupNames->implode(', ') : (optional($howitwork->group)->name ?? $howitwork->forwhom) }}
                </td>
                <td>{{$howitwork->summary }}</td>
                <td>
                  @if($howitwork->published == true)
                    <span class="hiw-status hiw-status--live">Published</span>
                  @else
                    <span class="hiw-status hiw-status--off">Hidden</span>
                  @endif
                </td>
                <td>
                    <div class="row no-gutters">
                        <div class="col-md-10">
                            <a class="btn btn-secondary btn-sm show" href="{{ route('howitworks.show', $howitwork->id) }}">Details</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('howitworks.edit',$howitwork->id) }}">Edit</a>
                            @if($howitwork->published == true)                 
                            <a class="btn btn-warning btn-sm" href="{{ url('howitworks/toggle', $howitwork->id)}}">Disable</a>
                            @else                        
                            <a class="btn btn-success btn-sm" href="{{ url('howitworks/toggle', $howitwork->id)}}">Enable</a>
                            @endif
                        </div> 
                        <div class="col-md-2">
                            <form action="{{ route('howitworks.destroy',$howitwork->id) }}" method="post"
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
