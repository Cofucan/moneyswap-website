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

<div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('advantages/manage')}}" class="s-text16">
               Advantages
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Edit content
            </span>
        </div>

<div class="row">
        <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <hr>
          <strong class="mb-3">{{$advantage->label}}</strong>
          <div class="school-image">
            <img src="{{ asset($advantage->display_image ?: 'img/icons/upload-img.jpg') }}" alt="{{$advantage->label}}">
          </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Update content</h4>
          <form action="{{ route('advantages.update', $advantage->id) }}" method="POST"  id="UpdateHowItWork" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')

            <div class="form-group">
              <label for="for_whom"> For Whom <span class="required">*</span></label>
              <select name="for_whom" class="custom-select d-block w-100 select2" id="for_whom" required>
                 @foreach ($services as $service)
                  <option value="{{$service}}" {{ $advantage->for_whom === $service ? 'selected' : '' }}>{{$service}}</option>
                 @endforeach
              </select>
              @if ($errors->has('for_whom'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('for_whom') }}</strong>
                </span>
              @endif
            </div>
           
            <div class="form-group">
              <label for="label">Title</label>
              <input type="text" name="label" value="{{$advantage->label}}" class="form-control{{ $errors->has('label') ? ' is-invalid' : ''}}">
              @if ($errors->has('label'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('label') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="display_image"> Display Image</label>
                <input type="file" name="display_image" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('display_image'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('display_image') }}</strong>
                    </span>
                @endif
              </div>
              <div class="col-md-6 form-group">
                <label for="display_order"> Display Order</label>
                <input type="number" name="sequence" value="{{ $advantage->sequence }}" class="form-control{{ $errors->has('sequence') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('sequence'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('sequence') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          
            <div class="form-group ">
              <label for="overview">Overview</label>
              <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="4">{!! $advantage->overview !!} </textarea>
              @if ($errors->has('overview'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('overview') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="published" name="published" {{ $advantage->published ? 'checked' : '' }}>
                <label class="custom-control-label" for="published">Published</label>
              </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-success" type="submit">Save </button>
            <button class="btn btn-primary" type="reset">Cancel</button>

          </form>
        </div>
</div>

@endsection
@push('scripts')
<!-- Select2 -->

@endpush
