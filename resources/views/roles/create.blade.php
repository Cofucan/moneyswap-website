@extends('layouts.admin')
@section('content_title', 'Add Role')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')

<div class="container-fluid">

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
            <i class="fa fa-home"></i> Dashboard
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('roles/manage')}}" class="s-text16">
            Posts
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            Add New Role
        </span>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing Roles</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">

        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Add New Role </h4>
            <form action="{{ url('roles') }}" method="POST"  id="CreateRole" novalidate>
                {{csrf_field()}}

                <div class="form-group">
                    <label for="label"> Name</label>
                    <input type="text" name="label" value="" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" placeholder="Enter role name"  id="label" />
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="default_role" id="default_role" checkbox>
                    <label class="form-check-label" for="default_role">Default </label>
                </div>

                <div class="form-group">
                    <label for="overview">Description</label>
                    <textarea id="overview" class="form-control" value="{{old ('overview')}}" name="post_body" style="height: 200px">
                    </textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="profile_type_id"> Profile Type</label>
                    <select class="custom-select d-block w-100"  name="profile_type_id" id="profile_type_id" required>
                        <option value="">Choose...</option>
                        <option>United States</option>
                    </select>
                    @if ($errors->has('profile_type_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('profile_type_id') }}</strong>
                        </span>
                    @endif
                </div>



                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
    <script>
        CKEDITOR.replace("overview",
            {
                height: 120,
                // Define the toolbar groups as it is a more accessible solution.
            toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
            },
            {
            "name": "links",
            "groups": ["links"]
            },
            {
            "name": "paragraph",
            "groups": ["list", "blocks"]
            },
            {
            "name": "document",
            "groups": ["mode"]
            },
            {
            "name": "insert",
            "groups": ["insert"]
            },
            {
            "name": "styles",
            "groups": ["styles"]
            },
            {
            "name": "about",
            "groups": ["about"]
            }
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            });
    </script>

@endpush
