@extends('layouts.admin')
@section('page_title', 'Add Advantage')
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
      <li class="breadcrumb-item"> <a href="{{ url('advantages/manage') }}"> Advantages </a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Advantage</li>
     
  </ol>
</nav>


<div class="row">
  <div class="col-md-3 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            
          </h4>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add Advantage</h4>
          <form method="POST" action="{{ route('advantages.store') }}" id="CreateAdvantage" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="for_whom"> For Whom <span class="required">*</span></label>
            <select name="for_whom" class="custom-select d-block w-100 select2" id="for_whom" required>
               @foreach ($services as $service)
                <option  value="{{$service}}">{{$service}}</option>                     
               @endforeach                  
            </select>
            @if ($errors->has('for_whom'))
              <span class="invalid-feedback">
              <strong>{{ $errors->first('for_whom') }}</strong>
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

            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="display_image"> Display Image</label>
                <input type="file" name="display_image" value="{{ old ('display_image')}}" class="form-control{{ $errors->has('display_image') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('display_image'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('display_image') }}</strong>
                    </span>
                @endif
              </div>
              <div class="col-md-6 form-group">
                <label for="sequence"> Display Order</label>
                <input type="number" name="sequence" value="{{ old ('sequence')}}" class="form-control{{ $errors->has('sequence') ? ' is-invalid' : '' }}"/>
                @if ($errors->has('sequence'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('sequence') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          
            <div class="form-group ">
              <label for="overview">Overview</label>
              <textarea name="overview" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="5">{!! old('overview') !!} </textarea>
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
           
            </div>
           

          </form>
          </div>
</div>

@endsection
@push('scripts')
<!-- Select2 -->

@endpush
