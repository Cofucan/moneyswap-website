@extends('layouts.admin')
 @section('page_title', $designation->designation)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <a href="{{ url ('designations')}}" class="s-text16">
                    Designation
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    {{ $designation->job_role }}
                </span>
            </div>

            <div class="col-md-4 ">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-designation{{$designation->id}}" href="#edit{{$designation->id}}"> Edit</a>
            @include('designations._formedit')

            </div>
        </div>
      <div class="row mt-3">
        <div class="col-md-6 content_title">
            <h4>  {{ $designation->job_role }} </h4>
            <div class="form-group">
                <strong>Login Role:</strong>
               {{ $designation->Role->label }}
            </div>
            <div class="form-group">
                <strong>Report To :</strong>
               {{ $designation->Parent->job_role ?? 'N/A' }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <hr>
            @if (!is_null($designation->job_role))
              <div class="form-group">
                  <strong>Job Description :</strong>
                  {!! $designation->job_description !!}
              </div>
            @endif
            @if (!is_null($designation->responsibilities))
              <div class="form-group">
                  <strong>Responsibilities :</strong>
                  {!! $designation->responsibilities !!}
              </div>
              @endif
        </div>


      </div>

      <div class="row mt-4">




      </div>


@endsection

@push('scripts')
<script>
    CKEDITOR.replace("job_description",
       {
           height: 100,
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

   CKEDITOR.replace("responsibilities",
       {
           height: 100,
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
