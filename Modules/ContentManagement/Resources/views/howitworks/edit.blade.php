@extends('layouts.admin')
@section('page_title', 'Edit')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/board.css')}}">
<link rel="stylesheet" href="{{ asset('css/select2.css')}}">
<style>
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
</style>
@endpush
@section('content')

<nav aria-label ="breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item"> <a href="{{ url('howitworks/manage') }}"> How It Works</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit {{ $howitwork->label }}</li>
     
  </ol>
</nav>

<div class="row">
        
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Update {{ $howitwork->label }}</h4>
          <form action="{{ route('howitworks.update', $howitwork->id) }}" method="POST"  id="UpdateHowItWork" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
            
           
            <div class="form-group">
              <label for="label">Title</label>
              <input type="text" name="label" value="{{$howitwork->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : ''}}">
              @if ($errors->has('label'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('label') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
              <label for="how_it_work_group_ids">Workflow Groups</label>
              @if ($groups->count() == 0)
                <div class="alert alert-warning">Add a workflow group before assigning this item.</div>
              @endif
              @php
                $selectedGroupIds = old('how_it_work_group_ids', $howitwork->groups->pluck('id')->all());
              @endphp
              <select name="how_it_work_group_ids[]" class="custom-select d-block w-100 select2" id="how_it_work_group_ids" multiple>
                @foreach ($groups as $group)
                  <option value="{{ $group->id }}" {{ in_array($group->id, array_map('intval', (array) $selectedGroupIds), true) ? 'selected' : '' }}>
                    {{ $group->name }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('how_it_work_group_ids'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('how_it_work_group_ids') }}</strong>
                </span>
              @endif
              @if ($errors->has('how_it_work_group_ids.*'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('how_it_work_group_ids.*') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-row mb-3">
              <div class="col-md-12">
                <label for="published">Status</label>
                <select name="published" class="custom-select d-block w-100" id="published">
                  <option value="1" {{ $howitwork->published ? 'selected' : '' }}>Published</option>
                  <option value="0" {{ !$howitwork->published ? 'selected' : '' }}>Unpublished</option>
                </select>
                <small class="text-muted">Group display order is managed inside each workflow group item listing.</small>
              </div>
            </div>

            <div class="form-row mb-3">
                                
              <div class="col-md-12 p-l-20">
                  <label for="buttone_one" > Page Button</label>
              </div>
              <div class="col-md-6">
                  <div class="form-group input-group">
                      <div class="input-group-append">
                          <div class="input-group-text">Text</div>
                      </div>
                      <input type="text" name="button_text" value="{{ $howitwork->button_text}}" class="form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}"/>
                      @if ($errors->has('button_text'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('button_text') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group input-group">
                      <div class="input-group-append">
                          <div class="input-group-text">Link</div>
                      </div>
                      <input type="text" name="button_url" value="{{ $howitwork->button_url}}" class="form-control{{ $errors->has('button_url') ? ' is-invalid' : '' }}"/>
                      @if ($errors->has('button_url'))
                          <span class="invalid-feedback">
                          <strong>{{ $errors->first('button_url') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
          </div>
          
            <div class="form-group ">
              <label for="overview">Overview</label>
              <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" id="textarea">{!! $howitwork->overview !!}</textarea>
              @if ($errors->has('overview'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('overview') }}</strong>
                  </span>
              @endif
            </div>

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>

          </form>
        </div>
</div>

@endsection
@include('partials.summernote')
@push('scripts')

@endpush
