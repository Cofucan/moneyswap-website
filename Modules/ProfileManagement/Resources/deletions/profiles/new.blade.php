@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{asset('css/pages.css')}}">
<link href="{{ asset ('css/select2.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container m-t-30 m-b-10">
    <div class="row ">
        <div class="col-md-6">
            @include('partials.alert')
            <div class="card"> 
                <div class="card-header">Add Profile</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profiles.add') }}" id="NewProfile" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group"> 
                            <label for="role_id">Role</label>
                            <select id="role_id" name="role_id" class="custom-select select2 w-100 form-control" data-live-search="true">
                                @foreach ($roles as $key => $role)
                                    <option value="{{$key}}"> {{$role}} </option>  
                                @endforeach                                 
                            </select>   
                        </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="control-label">{{ __('First Name') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" id="first_name" placeholder="" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
                                    </div>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="last_name">{{ __('Last Name') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" id="last_name" placeholder="" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                                    </div>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    </div>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="telephone">Telephone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <i class="input-group-text">+234</i>
                                    </div>
                                    <input type="text" id="telephone" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ old('telephone') }}" placeholder="Mobile Telephone Number" required>
                                </div>
                                @if ($errors->has('telephone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                            </div>

                         
                            <hr>

                            <div class="form-row mb-0">
                              
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-success">Save and Close</button>
                                    <button class="btn btn-primary" type="submit" name="todo" value="Continue">Save & Add New</button>                      
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
       
    </div>
</div>
    
@endsection

@push('script')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
    
<script>
  jQuery(document).ready(function($) {
    $('.select2').select2();
    });
</script>
@endpush
