@extends('layouts.admin')
@section('page_title', $department->department_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <a href="{{ url ('home')}}" class="s-text16">
                <i class="fa fa-home"></i> Dashboard
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <a href="{{ url ('departments/manage')}}" class="s-text16">
               Department
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>

            <span class="s-text17">
                Edit [{{$department->department_name}}]
            </span>
        </div>
<div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Edit Department </h4>
            <form action="{{ route('departments.update', $department->id) }}" method="POST"  id="UpdateDepartment">
                {{csrf_field()}}
                @method('PUT')

                
                <div class="form-group">
                    <label for="department_name"> Department</label>
                    <input type="text" name="department_name" value="{{ $department->department_name }}" class="form-control{{ $errors->has('department_name') ? ' is-invalid' : '' }}" placeholder="Enter program title"  id="department_name" />
                    @if ($errors->has('department_name'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('department_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="type">Type</label>
                            <select class="custom-select{{ $errors->has('type') ? ' is-invalid' : '' }} d-block w-100 select2"  name="type" id="type" required>
                            @foreach($types as $key => $type)
                            @if($department->type == $key)
                            <option value="{{$key}}" selected> {{$type}}</option>
                                @else
                                <option value="{{$key}}"> {{$type}}</option>
                                @endif
                            @endforeach
                            </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="parent_id"> Parent Department</label>
                        <select name="parent_id" class="custom-select d-block w-100 select2" id="parent_id">
                            <option value=""></option>
                            @foreach($parents as $key=> $parent)
                                @if($department->parent_id == $key)
                                    <option value="{{  $$key }}" selected>{{  $parent }}</option>
                                @else
                                    <option value="{{  $key }}">{{  $parent}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5">
                        {!! $department->description !!}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>




                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>


        </div>

        <div class="col-md-3 offset-md-1">
            <div class="box box-collapsed">
                <div class="box-header text-center">
                    <h5>Publish</h5>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-desktop"></i>
                                Status:
                                <b>
                                        @if($department->published == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>

                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-clock-o"></i>
                                Last Updated: <b>{{ $department->updated_at }}</b></p>
                        </div>

                      

                       
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script>
    CKEDITOR.replace("description",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>


@endpush
