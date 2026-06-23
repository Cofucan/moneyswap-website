@extends('layouts.admin')
@section('page_title', $resume->Profile->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('resumes/profile', Session::get('profile_id'))}}" class="s-text16">
          Resume
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">

        </span>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Form Instruction</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">

        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">   {{ $resume->Profile->full_name }} </h4>
            <form action="{{ route ('resumes.update', $resume->id) }}" method="POST"  id="UpdateResume" >
                {{csrf_field()}}
                <input type="hidden" name="profile_id" value=" {{ $resume->profile_id }} " id="profile_id" required>
                <input type="hidden" name="status" value="Moderation" id="status" />
                @method('PUT')  

                  <div class="form-group">
                    <label for="career_objective">Career Objecttive <span class="required">*</span></label>
                    <textarea name="career_objective" class="form-control {{ $errors->has('career_objective') ? ' is-invalid' : '' }}" rows="7" placeholder="Add your Department goal/objective">
                        {!! $resume->career_objective !!}
                    </textarea>
                    @if ($errors->has('career_objective'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('career_objective') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="designation_id"> Job Role</label>
                    <select class="custom-select d-block w-100 select2{{ $errors->has('designation_id') ? ' is-invalid' : '' }}"  name="designation_id" id="designation_id" required>
                    @foreach($designations as $key => $designation)
                            @if($resume->designation_id == $key)
                              <option value="{{$key}}" selected> {{$designation}}</option>
                            @else
                              <option value="{{$key}}"> {{$designation}}</option>
                            @endif
                    @endforeach
                    </select>
                    @if ($errors->has('designation_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('designation_id') }}</strong>
                        </span>
                    @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="education_id">Display Qualification</label>
                        <select name="education_id" class="custom-select d-block w-100 select2" id="education_id" required>                       
                          @foreach($resume->Profile->Educations as $education)
                          @if($education->id == $resume->education_id)
                            <option value="{{$education->id }}" selected>  {{$education->Qualification->qualification }} {{$education->major }}</option>
                            @else
                            <option value="{{$education->id }}"> {{$education->Qualification->qualification }} {{$education->major }} </option>
                          @endif
                          @endforeach
                        </select>
                        @if ($errors->has('education_id'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('education_id') }}</strong>
                                </span>
                                @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label for="experience_years"> Experience</label>
                        <div class="input-group">
                          <input type="number" name="experience_years" value="{{ $resume->experience_years}}" class="form-control {{ $errors->has('experience_years') ? ' is-invalid' : '' }}"/>
                          <div class="input-group-prepend">
                              <div class="input-group-text">Year(s)</div>
                          </div>
                      </div>
                    @if ($errors->has('experience_years'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('experience_years') }}</strong>
                        </span>
                    @endif
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="visibility"> Resume Visibility</label>
                        <select class="custom-select d-block w-100 select2{{ $errors->has('visibility') ? ' is-invalid' : '' }}"  name="visibility" id="visibility" required>
                          @foreach($visibilities as $key => $visibility)
                                  @if($resume->visibility == $key)
                                  <option value="{{$key}}" selected> {{$visibility}}</option>
                                  @else
                                  <option value="{{$key}}"> {{$visibility}}</option>
                                  @endif
                          @endforeach
                        </select>
                          @if ($errors->has('visibility'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('visibility') }}</strong>
                              </span>
                          @endif
                    </div>
                  </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Continue </button>
                {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
  <script src="{{ asset('js/select2.full.min.js')}}"></script>
 
    <script>
      CKEDITOR.replace("career_objective",
        {
            height: 100,
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
     

  <script>
    $(document).ready(function(){
        $('.select2').select2();
      });
  </script>

@endpush
