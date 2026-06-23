@extends('layouts.admin')
@section('page_title', 'Add How It Work')
@push('styles')
<!-- Select2 -->
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
      <li class="breadcrumb-item active" aria-current="page">Add How it Work</li>
     
  </ol>
</nav>

<div class="row">
  <div class="col-md-3 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            
          </h4>



        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add How It Work</h4>
          <form method="POST" action="{{ route('howitworks.store') }}" id="CreateCoreValue" enctype="multipart/form-data">
          {{csrf_field()}}

            <div class="form-group">
              <label for="how_it_work_group_ids"> Workflow Groups</label>
              @if ($groups->count() == 0)
                <div class="alert alert-warning">Add a workflow group before creating a How It Works item.</div>
              @endif
              @php
                $selectedGroupIds = old('how_it_work_group_ids', []);
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
            <div class="form-group">
              <label for="label">Label</label>
              <input type="text" name="label" value="{{old('label')}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : ''}}">
              @if ($errors->has('label'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('label') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="display_image"> Display Media (Image, GIF, Video)</label>
                <input type="file" name="display_image" value="{{ old ('display_image')}}" accept=".jpg,.jpeg,.png,.gif,.mp4,.webm,.mov" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('display_image'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('display_image') }}</strong>
                    </span>
                @endif
                <small class="text-muted">Group display order is managed on each workflow group page after this item is created.</small>
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
                      <input type="text" name="button_text" value="{{ old('button_text') }}" class="form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}"/>
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
                      <input type="text" name="button_url" value="{{ old('button_url') }}" class="form-control{{ $errors->has('button_url') ? ' is-invalid' : '' }}"/>
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
              <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" id="textarea">{!! old('overview') !!} </textarea>
              @if ($errors->has('overview'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('overview') }}</strong>
                  </span>
              @endif
            </div>

            <hr class="mb-4">
            <div class="form-row">
              <div class="col-md-3">
                <button class="btn btn-success btn-sm btn-block" type="submit">Save </button>
              </div> 
              <div class="col-md-3">
                <button class="btn btn-primary btn-sm btn-block" type="reset">Cancel</button>
              </div>  
            </div>
           

          </form>
          </div>
</div>
@include('partials.summernote')
@endsection
@push('scripts')

@endpush
