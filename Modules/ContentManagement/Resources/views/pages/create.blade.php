@extends('layouts.admin')
@section('page_title', 'Add Page')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pages/manage') }}">  Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New Page</li>
                
            </ol>
        </nav>   

        <div class="row mt-3">
            <div class="col-md-8">
                <h3>Create New Page</h3>
                <div class="card">                   
                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.store') }}" id="CreatePage" enctype="multipart/form-data">
                            {{csrf_field()}}
            
                            <div class="form-group">
                                <label for="headline">Title</label>
                                <input type="text" name="headline" value="{{old('headline')}}" class="form-control" placeholder="Add Page Title"  id="headline" />
                                @if ($errors->has('headline'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('headline') }}</strong>
                                    </span>
                                @endif
                            </div>
            
                             <div class="form-row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="page_tag">Page Tag</label>
                                        <input type="text" name="page_tag" value="{{old('page_tag')}}" class="form-control" placeholder="e.g admission-status "  id="page_tag" />
                                        @if ($errors->has('page_tag'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('page_tag') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="parent_id">Child Of</label>
                                        <select class="custom-select d-block w-100 select2" name="parent_id" id="parent">
                                        <option value=""> Select Parent Page</option>
                                        @foreach($pages as $key => $page)
                                        @if(old('parent_id') == $key)
                                        <option value="{{$key}}" selected> {{$page}}</option>
                                            @else
                                            <option value="{{$key}}"> {{$page}}</option>
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
                                        <input type="text" name="page_button" value="{{ old ('page_button')}}" class="form-control{{ $errors->has('page_button') ? ' is-invalid' : '' }}"/>
                                        @if ($errors->has('page_button'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('page_button') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Link</div>
                                        </div>
                                        <input type="text" name="button_link" value="{{ old ('button_link')}}" class="form-control{{ $errors->has('button_link') ? ' is-invalid' : '' }}"/>
                                        @if ($errors->has('button_link'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('button_link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
            
                             <div class="form-group">
                                <label for="body">Content Body</label>
                                <textarea name="body" class="form-control" rows="7" placeholder="Add Page Content" id="textarea">{{old('body')}}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
            
                           
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display_image">Display Image</label>
                                        <input type="file" name="display_image" value="" class="form-control" placeholder="Upload Page Imaga"  id="display_image" />
                                        @if ($errors->has('display_image'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('display_image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                           
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-success" type="submit">Save </button>
                            <button class="btn btn-primary" type="reset">Reset</button>
            
                        </form>
                    </div>
                </div>
               
            </div>         

        </div>
    

@include('partials.summernote')
@endsection
@push('scripts')



@endpush
