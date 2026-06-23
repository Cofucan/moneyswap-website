@extends('layouts.admin')
@section('headline', $page->headline)
@push('styles')
<link href="{{ asset('lib/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pages/manage') }}">  Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $page->headline }}</li>
            </ol>
        </nav>   

        <div class="row mt-3">
            <div class="col-md-10">
                <h3 class="mb-3"> Edit {{ $page->headline }} </h3>
                <div class="card">                   
                    <div class="card-body">
                        <form action="{{ route('pages.update', $page->page_tag) }}" method="POST"  id="UpdatePage" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PUT')
            
                            <div class="form-group">
                                <label for="headline"> Title </label>
                                <input type="text" name="headline" value="{{$page->headline}}" class="form-control" placeholder="Add Page Title"  id="headline" />
                                @if ($errors->has('headline'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('headline') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
            
                            <div class="form-row mb-3">
                                <div class="col-md-12 p-l-20">
                                    <label for="buttone_one"> Page Button</label>
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
                                <textarea name="body" value="{{$page->body }}" class="form-control" rows="7" placeholder="Add Page Content" id="textarea">{!! $page->body !!}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div> 
                           
                            <hr class="mb-4">
                            <button class="btn btn-success" type="submit">Save </button>
            
                        </form>
                    </div>
                </div>
               
            </div>         

        </div>
   

@endsection
@push('scripts')

<script src="{{ asset('lib/summernote/summernote-lite.min.js')}}"></script>
<script>
  $('#textarea').summernote({
    tabsize: 2,
    height: 400,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>

@endpush
