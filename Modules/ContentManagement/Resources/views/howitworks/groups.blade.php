@extends('layouts.admin')
@section('page_title', 'Workflow Groups')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style>
  .group-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 2px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }
  .group-status--live {
    background: #dcfce7;
    color: #166534;
  }
  .group-status--off {
    background: #fee2e2;
    color: #991b1b;
  }
  .group-meta {
    color: #64748b;
    font-size: 12px;
  }
</style>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('howitworks/manage') }}">How It Works</a></li>
        <li class="breadcrumb-item active" aria-current="page">Workflow Groups</li>
        <div class="ml-auto mr-0">
            <a href="{{ url('howitworks/manage') }}" class="btn btn-sm btn-outline-secondary mr-2">Back to Items</a>
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addGroup">Add Group</a>
        </div>
    </ol>
</nav>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
    <h4 class="mb-3">Workflow Groups</h4>
    <table class="table" id="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Group</th>
          <th>Description</th>
          <th>Items</th>
          <th>Order</th>
          <th>Status</th>
          <th width="26%">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($groups as $group)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            <strong>{{ $group->name }}</strong><br>
            <span class="group-meta">{{ $group->slug }}</span>
          </td>
          <td>{!! $group->description !!}</td>
          <td>{{ $group->how_it_works_count }}</td>
          <td>{{ $group->display_order }}</td>
          <td>
            @if($group->published)
              <span class="group-status group-status--live">Published</span>
            @else
              <span class="group-status group-status--off">Hidden</span>
            @endif
          </td>
          <td>
            <a class="btn btn-sm btn-info" href="{{ route('howitworks.groups.show', $group->id) }}">Show Items</a>
            <a class="btn btn-sm btn-primary" href="#edit{{ $group->id }}" data-toggle="modal" data-target="#edit{{ $group->id }}">Edit</a>
            @if($group->published)
              <a class="btn btn-sm btn-warning" href="{{ route('howitworks.groups.toggle', $group->id) }}">Disable</a>
            @else
              <a class="btn btn-sm btn-success" href="{{ route('howitworks.groups.toggle', $group->id) }}">Enable</a>
            @endif
            <form action="{{ route('howitworks.groups.destroy', $group->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this group?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@foreach($groups as $group)
<div class="modal fade" id="edit{{ $group->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('howitworks.groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label>Name</label>
              <input type="text" name="name" value="{{ $group->name }}" class="form-control" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Order</label>
              <input type="number" name="display_order" value="{{ $group->display_order }}" class="form-control" min="1">
            </div>
          </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control summernote" rows="4">{!! $group->description !!}</textarea>
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Workflow Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('howitworks.groups.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Order</label>
              <input type="number" name="display_order" class="form-control" min="1" value="1">
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control summernote" rows="4"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Group</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@include('partials.summernote')
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
  });
</script>
@endpush
