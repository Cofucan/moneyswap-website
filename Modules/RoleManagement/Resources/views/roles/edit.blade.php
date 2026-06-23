@extends('layouts.admin')
@section('page_title', 'Edit Role')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
@endpush
@section('content')

            <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('roles/manage')}}" class="s-text16">
                    Roles
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    Edit [{{$role->label }}]
                </span>
            </div>
	      	<div class="row">
	      		<div class="col-md-9 order-mb-1">
                  <h4 class="mb-3">Edit {{$role->label }} </h4>

                  <form action="{{ route('roles.update', $role->id) }}" method="POST"  id="UpdateRole" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')


                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="default_role" id="default_role" checkbox>
                    <label class="form-check-label" for="default_role">Default </label>
                </div>



                <div class="form-group">
                    <label for="role_category_id"> Profile Type</label>
                    <select class="custom-select d-block w-100"  name="role_category_id" id="school_type" required>
                        <option value="">Choose...</option>
                        <option>United States</option>
                    </select>
                    @if ($errors->has('role_category_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('role_category_id') }}</strong>
                        </span>
                    @endif
                </div>

                    <hr class="mb-4">
                    <button class="btn btn-success" type="update">Update </button>
                    <button class="btn btn-primary" type="reset">Reset</button>

                </form>

                </div>

                <div class="col-md-3">
                    <div class="box box-collapsed">
                        <div class="box-header text-center">
                            <h5>Publish</h5>
                        </div>
                        {{--  <div class="box-body">
                             <div class="row">
                                <div class="col-md-12 publish-form">
                                    <p><i class="fa fa-desktop"></i>
                                        Status:
                                        <b>
                                                @if($role->published == 1)
                                                <span class="enable">Published</span>
                                                @else
                                                <span class="disable"> Not Published</span>
                                                @endif
                                        </b>

                                </div>

                                <div class="col-md-12 publish-form">
                                        <p><i class="fa fa-clock-o"></i>
                                            Last Updated: <b>{{ $role->updated_at }}</b></p>

                                    </div>



                                <div class="col-md-12 p-t-20">
                                    <hr>
                                    Display Media
                                    <img src="{{ asset ($role->thumbnail) }}" alt="{{$role->label }}" class="w-100">
                                    <hr>
                                </div>
                            </div>
                        </div>  --}}
                    </div>
                </div>
	      	</div>


@endsection
@push('scripts')
     <script>
        CKEDITOR.replace("overview",
            {
                height: 120,
                // Define the toolbar streams as it is a more accessible solution.
            toolbarGroups: [{
            "name": "basicstyles",
            "streams": ["basicstyles"]
            },
            {
            "name": "links",
            "streams": ["links"]
            },
            {
            "name": "paragraph",
            "streams": ["list", "blocks"]
            },
            {
            "name": "document",
            "streams": ["mode"]
            },
            {
            "name": "insert",
            "streams": ["insert"]
            },
            {
            "name": "styles",
            "streams": ["styles"]
            },
            {
            "name": "about",
            "streams": ["about"]
            }
        ],
        // Remove the redundant buttons from toolbar streams defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            });
    </script>

@endpush
