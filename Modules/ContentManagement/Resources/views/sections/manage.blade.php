@extends('layouts.admin')
@section('page_title', 'Content Sections')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style>
  .section-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 2px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }
  .section-status--live {
    background: #dcfce7;
    color: #166534;
  }
  .section-status--off {
    background: #fee2e2;
    color: #991b1b;
  }
  .section-key {
    font-family: "Courier New", Courier, monospace;
    font-size: 12px;
    color: #64748b;
  }
</style>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Content Sections</li>
        <div class="ml-auto mr-0">
            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addSection">Add Section</a>
        </div>
    </ol>
</nav>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
    <h4 class="mb-3">Sections for "{{ $page }}"</h4>
    <table class="table" id="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Key</th>
          <th>Type</th>
          <th>Headline</th>
          <th>Image</th>
          <th>Order</th>
          <th>Status</th>
          <th width="20%">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $section)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><span class="section-key">{{ $section->section_key }}</span></td>
          <td><span class="section-key">{{ $section->type ?? 'text' }}</span></td>
          <td>{!! $section->headline !!}</td>
          <td>
            <div class="d-flex align-items-center">
              @if($section->image)
                <img src="{{ asset($section->image) }}" alt="{{ $section->section_key }}" class="section-thumb" data-section="{{ $section->id }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
              @else
                <img src="{{ asset('img/icons/upload-img.jpg') }}" alt="{{ $section->section_key }}" class="section-thumb" data-section="{{ $section->id }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
              @endif
              <form action="{{ route('content-sections.image', $section->id) }}" method="POST" enctype="multipart/form-data" class="ml-2 section-image-form" data-section="{{ $section->id }}">
                @csrf
                <input type="file" name="image" class="form-control form-control-sm mb-1 section-image-input" data-section="{{ $section->id }}" required>
                <button type="submit" class="btn btn-sm btn-outline-primary btn-block">Update</button>
              </form>
            </div>
          </td>
          <td>{{ $section->display_order }}</td>
          <td>
            @if($section->published)
              <span class="section-status section-status--live">Published</span>
            @else
              <span class="section-status section-status--off">Hidden</span>
            @endif
          </td>
          <td>
            <a class="btn btn-sm btn-primary" href="#edit{{ $section->id }}" data-toggle="modal" data-target="#edit{{ $section->id }}">Edit</a>
            @if($section->published)
              <a class="btn btn-sm btn-warning" href="{{ route('content-sections.toggle', $section->id) }}">Disable</a>
            @else
              <a class="btn btn-sm btn-success" href="{{ route('content-sections.toggle', $section->id) }}">Enable</a>
            @endif
            <form action="{{ route('content-sections.destroy', $section->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this section?');">
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

@foreach($sections as $section)
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('content-sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="page" value="{{ $page }}">
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label>Section Key</label>
              <input type="text" name="section_key" value="{{ $section->section_key }}" class="form-control" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Order</label>
              <input type="number" name="display_order" value="{{ $section->display_order }}" class="form-control" min="1">
            </div>
          </div>
          <div class="form-group">
            <label>Type</label>
            <select name="type" class="custom-select">
              @foreach($types as $key => $label)
                <option value="{{ $key }}" {{ ($section->type ?? 'text') === $key ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Headline</label>
            <textarea name="headline" class="form-control summernote" rows="3">{!! $section->headline !!}</textarea>
          </div>
          <div class="form-group">
            <label>Subtext</label>
            <textarea name="subtext" class="form-control summernote" rows="4">{!! $section->subtext !!}</textarea>
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($section->image)
              <small class="section-key d-block mt-2">{{ $section->image }}</small>
            @endif
          </div>
          <div class="form-group">
            <label>Data (JSON)</label>
            <textarea name="data" class="form-control" rows="4" placeholder='{"button_text":"Get Started","button_url":"/register"}'>{{ $section->data ? json_encode($section->data) : '' }}</textarea>
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

<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('content-sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="page" value="{{ $page }}">
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label>Section Key</label>
              <input type="text" name="section_key" class="form-control" placeholder="why-us, home-how-it-works" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Order</label>
              <input type="number" name="display_order" class="form-control" min="1" value="1">
            </div>
          </div>
          <div class="form-group">
            <label>Type</label>
            <select name="type" class="custom-select">
              @foreach($types as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Headline</label>
            <textarea name="headline" class="form-control summernote" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label>Subtext</label>
            <textarea name="subtext" class="form-control summernote" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="form-group">
            <label>Data (JSON)</label>
            <textarea name="data" class="form-control" rows="4" placeholder='{"button_text":"Get Started","button_url":"/register"}'></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Section</button>
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
    $('.section-image-input').on('change', function() {
      var input = this;
      var sectionId = $(this).data('section');
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('.section-thumb[data-section="' + sectionId + '"]').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    });
  });
</script>
@endpush
