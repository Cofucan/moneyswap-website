@extends('layouts.admin')
@section('page_title', 'Workflow Group Items')
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
  .group-meta {
    color: #64748b;
    font-size: 13px;
  }
</style>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('howitworks.manage') }}">How It Works</a></li>
        <li class="breadcrumb-item"><a href="{{ route('howitworks.groups.manage') }}">Workflow Groups</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $group->name }}</li>
        <div class="ml-auto mr-0">
            <a href="#" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#editGroupModal">Edit Group</a>
            <a href="{{ route('howitworks.groups.manage') }}" class="btn btn-sm btn-outline-secondary mr-2">Back to Groups</a>
            <a href="{{ route('howitworks.create') }}" class="btn btn-sm btn-success">Create New How it Works</a>
        </div>
    </ol>
</nav>

<div class="row mb-3">
  <div class="col-md-12">
    <h4 class="mb-1">{{ $group->name }} Items</h4>
    <p class="group-meta mb-0">{!! $group->description !!}</p>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h5 class="mb-3">Attach Existing How It Works Items</h5>
        <form action="{{ route('howitworks.groups.items.attach', $group->id) }}" method="POST">
          @csrf
          <div class="form-row align-items-end">
            <div class="col-md-9 form-group">
              <label for="howitwork_ids">Select one or more items</label>
              <select name="howitwork_ids[]" id="howitwork_ids" class="custom-select" multiple size="6" required>
                @foreach($attachableItems as $attachableItem)
                  <option value="{{ $attachableItem->id }}">{{ $attachableItem->label }}</option>
                @endforeach
              </select>
              <small class="text-muted">Only items not already in this group are listed.</small>
            </div>
            <div class="col-md-3 form-group">
              <button type="submit" class="btn btn-primary btn-block">Attach Selected</button>
            </div>
          </div>
        </form>
        @if($attachableItems->isEmpty())
          <div class="alert alert-info mb-0">All existing items are already attached to this group.</div>
        @endif
      </div>
    </div>
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
          <th>Other Groups</th>
          <th>Display Order</th>
          <th>Status</th>
          <th width="28%">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->label }}</td>
          <td>
            @php
              $thumb = $item->display_image ? asset($item->display_image) : asset('img/icons/upload-img.jpg');
              $extension = strtolower(pathinfo((string) $item->display_image, PATHINFO_EXTENSION));
              $isVideo = in_array($extension, ['mp4', 'webm', 'mov'], true);
            @endphp
            @if($isVideo && !empty($item->display_image))
              <video class="hiw-table-thumb" muted loop playsinline controls>
                <source src="{{ $thumb }}" type="{{ $extension === 'mov' ? 'video/quicktime' : 'video/'.$extension }}">
              </video>
            @else
              <img src="{{ $thumb }}" alt="{{ $item->label }}" class="hiw-table-thumb">
            @endif
          </td>
          <td>
            @php
              $otherGroups = $item->groups->where('id', '!=', $group->id)->pluck('name')->filter()->values();
            @endphp
            {{ $otherGroups->isNotEmpty() ? $otherGroups->implode(', ') : '-' }}
          </td>
          <td>
            <form action="{{ route('howitworks.groups.items.order', [$group->id, $item->id]) }}" method="POST" class="form-inline">
              @csrf
              @method('PUT')
              <input type="number" name="display_order" value="{{ (int) ($item->pivot->display_order ?? 1) }}" min="1" class="form-control form-control-sm mr-1" style="width:85px;">
              <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
            </form>
          </td>
          <td>
            @php
              $groupEnabled = !isset($item->pivot->is_enabled) ? true : (bool) $item->pivot->is_enabled;
            @endphp
            @if($groupEnabled)
              <span class="hiw-status hiw-status--live">Enabled In Group</span>
            @else
              <span class="hiw-status hiw-status--off">Disabled In Group</span>
            @endif
            <br>
            @if($item->published)
              <small class="text-success">Item Published</small>
            @else
              <small class="text-danger">Item Hidden</small>
            @endif
          </td>
          <td>
            <a class="btn btn-sm btn-info" href="{{ route('howitworks.show', $item->id) }}">Details</a>
            <a class="btn btn-sm btn-primary" href="{{ route('howitworks.edit', $item->id) }}">Edit</a>
            <form action="{{ route('howitworks.groups.items.toggle', [$group->id, $item->id]) }}" method="POST" class="d-inline">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-sm {{ $groupEnabled ? 'btn-warning' : 'btn-success' }}">
                {{ $groupEnabled ? 'Disable In Group' : 'Enable In Group' }}
              </button>
            </form>
            <form action="{{ route('howitworks.groups.items.detach', [$group->id, $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this item from {{ $group->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Remove</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    @if($items->isEmpty())
      <div class="alert alert-info">No How It Works items belong to this group yet.</div>
    @endif
  </div>
</div>

<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Workflow Group</h5>
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
            <div class="col-md-3 form-group">
              <label>Order</label>
              <input type="number" name="display_order" value="{{ $group->display_order }}" min="1" class="form-control">
            </div>
            <div class="col-md-3 form-group">
              <label>Status</label>
              <select name="published" class="custom-select">
                <option value="1" {{ $group->published ? 'selected' : '' }}>Published</option>
                <option value="0" {{ !$group->published ? 'selected' : '' }}>Hidden</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{!! $group->description !!}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Group</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
  });
</script>
@endpush
