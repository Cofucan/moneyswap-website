@extends('layouts.admin')
@section('page_title', $guideline->label)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush
@section('content')

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('guidelines/manage')}}" class="s-text16">
			School Policies
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			Edit {{ $guideline ->label}}
		</span>
	</div>
    <div class="row">
    <div class="col-md-9 label">
            <h4>Edit School Policy </h4>
        </div>
    <div class="col-md-3">

        <div class="page_button">
            <a href="{{ url('guidelines/create') }}"><button class="btn btn-sm btn-success"> New <i class="fa fa-plus"></i></button></a>

        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3"></h4>
            <form action="{{ route('guidelines.update', $guideline->id) }}" method="POST"  id="UpdateGuideline" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-group">
                    <label for="label">Guideline Title </label>
                    <input type="text" name="label" value="{{ $guideline->label}}" class="form-control" placeholder="Add School Policy Title"  id="label" />
                    @if ($errors->has('label'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                 <div class="form-group">
                    <label for="overview">Policy Details</label>
                    <textarea name="overview" value="{{$guideline->overview }}" class="form-control" rows="7" placeholder="Add Guideline Content">
                        {!! $guideline->overview !!}</textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="guideline_excerpt"> Excerpt</label>
                    <textarea name="guideline_excerpt" value="{{ $guideline }}->guideline_excerpt}}" class="form-control" rows="2" placeholder="Add Short Description">
                        {!! $guideline->guideline_excerpt !!}</textarea>
                    @if ($errors->has('guideline_excerpt'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('guideline_excerpt') }}</strong>
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
                                        @if($guideline->enabled == 1)
                                        <span class="enable">Published</span>
                                        @else
                                        <span class="disable"> Not Published</span>
                                        @endif
                                </b>
                                </p>

                        </div>

                        <div class="col-md-12 publish-form">
                            <p><i class="fa fa-chart"></i>
                                Visits: <b>{{ $guideline->page_views }}</b></p>

                        </div>
                        <div class="col-md-12 publish-form">
                                <p><i class="fa fa-clock-o"></i>
                                    Last Updated: <b>{{ $guideline->updated_at }}</b></p>

                            </div>



                        {{--  <div class="col-md-12 p-t-20">

                            <img src="{{ asset ($guideline->thumbnail) }}" alt="{{ $guideline }}->page_name }}" class="w-100">
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>
<script>
    CKEDITOR.replace("guideline_excerpt",
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
<script>
    CKEDITOR.replace( 'overview' );
</script>


@endpush
