@extends('layouts.admin')
@section('page_title', $vacancy->vacancy_title)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <style>
        #city_loading{
        visibility:hidden;
        }
        #neighbourhood_loading{
        visibility:hidden;
        }
    </style>
    <style>
        .myDiv{
            display:none;
        }  
    
    </style>
    

@endpush
@section('content')

<div class="container-fluid">

    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

        <a href="{{ url ('vacancies/manage')}}" class="s-text16">
            Vacancies
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			{{ $vacancy->vacancy_title }}
		</span>
	</div>

<div class="row">
  <div class="col-md-8 content_title">
    <h4 class="mb-3">Edit</h4>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
        <a href="{{ url('vacancies/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
	 
		<a href=""><button class="btn btn-sm btn-success">Export  <i class="fa fa-arrow-up"></i></button></a>
	  </div>
	</div>
</div>

<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Information</span>
            <span class="badge badge-secondary badge-pill"></span>
          </h4>
        <div class="page-menu">
            <ul>

            </ul>
        </div>

        </div>
        <div class="col-md-8 order-md-1">

            <form action="{{ route('vacancies.update', $vacancy->id) }}" method="POST" id="UpdateVacancy" enctype="multipart/form-data">
                {{csrf_field()}}
                 @method('PUT')
                 <div class="form-group mb-3">
                    <label for="vacancy_title"> Vacancy Title <span class="required">*</span></label>
                    <input type="text" name="vacancy_title" value="{{ $vacancy->vacancy_title }}" class="form-control {{ $errors->has('vacancy_title') ? ' is-invalid' : '' }}" placeholder="Enter vacancy name"  id="vacancy_title" />
                    @if ($errors->has('vacancy_title'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('vacancy_title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row mb-3">
                    <div class="col-md-6 form-group">
                        <label for="vacancy_ref"> Vacancy Ref</label>
                        <input type="text" name="vacancy_ref" value="{{ $vacancy->vacancy_ref }}" class="form-control {{ $errors->has('vacancy_ref') ? ' is-invalid' : '' }}"   id="vacancy_ref" />
                            @if ($errors->has('vacancy_ref'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('vacancy_title') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="col-md-6 form-group">

                        <label for="employment_type_id"> Employment Type</label>
                        <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}"  name="employment_type_id" id="employment_type_id" required>
                            @foreach($employmentTypes as $key => $employment_type)
                                @if($vacancy->employment_type_id == $key)
                                    <option value="{{$key}}" selected> {{$employment_type}}</option>
                                        @else
                                        <option value="{{$key}}"> {{$employment_type}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('employment_type_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('employment_type_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row mb-3">

                    <div class="col-md-6 form-group">
                        <label for="years_of_experience"> Min. Experience Years <span class="required">*</span></label>
                        <select name="years_of_experience" class="custom-select d-block w-100 select2 {{ $errors->has('years_of_experience') ? ' is-invalid' : '' }}" id="years_of_experience" required>
                            @for ($years = 0; $years < 11; $years++)                           
                                @if($vacancy->years_of_experience == $years)
                                <option value="{{$years}}" selected> {{$years}}</option>
                                @else
                                <option value="{{$years}}"> {{$years}}</option>
                                @endif
                            @endfor
                            
                        </select>
                        @if ($errors->has('years_of_experience'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('years_of_experience') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="qualification_id"> Minimum Qualifications <span class="required">*</span></label>
                        <select name="qualification_id" class="custom-select d-block w-100 select2 {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}" id="qualification_id" required>
                            
                            @foreach($qualifications as $key => $qualification_id)
                                @if($vacancy->qualification_id == $key)
                                <option value="{{$key}}" selected> {{ $qualification_id }}</option>
                                @else
                                <option value="{{$key}}"> {{ $qualification_id }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('qualification_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('qualification_id') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group mb-3">
                    <label for="overview">Overview <span class="required">*</span></label>
                    <textarea name="overview" id="overview"  class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" rows="4">
                    {!! $vacancy->overview !!}
                    </textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div> --}}

                <div class="form-group mb-3">
                    <label for="description">Full Description <span class="required">*</span></label>
                    <textarea name="description" id="description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="4" >
                    {!! $vacancy->description !!}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group mb-3">
                    <label for="responsibilities">Duties & Responsibilities</label>
                    <textarea name="responsibilities" value="{{ $vacancy->responsibilities }}" class="form-control" rows="2" placeholder="Add responsibilities">
                        {!! $vacancy->responsibilities  !!} </textarea>
                    @if ($errors->has('responsibilities'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('responsibilities') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12">                     
                        <div class="form-group ">
                            <label for="other_requirements">Other Requirements <span class="required">*</span></label>
                            <textarea name="other_requirements" id="other_requirements"  class="form-control{{ $errors->has('other_requirements') ? ' is-invalid' : '' }}" rows="4" placeholder="Other requirements">
                            {!! $vacancy->other_requirements !!}
                            </textarea>
                            @if ($errors->has('other_requirements'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('other_requirements') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 form-group">
                      <label class="control-label" for="salary_from"> Minimum Salary<span class="requiredfield">*</span></label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">                             
                          <div class="input-group-text">NGN</div>
                        </div>
                        <input type="text" class="form-control" value="{{$vacancy->salary_from}} " id="salary_from" name="salary_from" placeholder="Minimum Salary">
                      </div>
                    </div>                        
                    <div class="col-md-6 form-group">
                      <label class="control-label" for="salary_to">Possible Maximum</label>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" value="{{$vacancy->salary_to}} " id="salary_to" name="salary_to" placeholder="Possible Maximum">
                        <div class="input-group-append">
                            <div class="input-group-text">{{ $vacancy->payment_cycle }}</div>                         
                        </div>
                      </div>                       
                    </div>        
                </div>
                    
                <div class="form-row">
                   
                    <div class="col-md-4 mb-3 form-group">
                        <label for="expected_start_date ">Expected Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="expected_start_date" value="{{ $vacancy->expected_start_date}}" class="form-control{{ $errors->has('expected_start_date') ? ' is-invalid' : '' }}"  id="expected_start_date" />
                        </div>
                        @if ($errors->has('expected_start_date'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('expected_start_date') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('expected_start_date'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('expected_start_date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-4 mb-3 form-group">
                        <label class="control-label" for="close_at">Application Deadline</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('close_at') ? ' is-invalid' : '' }} pull-right" name="close_at"  value="{{ $vacancy->close_at}}">
                        </div>

                        @if ($errors->has('close_at'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('close_at') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="employees_needed"> Total Positions <span class="required">*</span></label>
                        <input type="number" name="employees_needed" value="{{ $vacancy->employees_needed }}" class="form-control {{ $errors->has('employees_needed') ? ' is-invalid' : '' }}" placeholder="50"  id="employees_needed" />
                        @if ($errors->has('employees_needed'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('employees_needed') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                {{-- <div class="form-row ">                   

                    <div class="col-md-6 mb-3 form-group">
                        <label for="application_method" class="control-label mb-3">Application method</label> <br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Online" name="application_method" type="radio" value="Online" class="custom-control-input" required>
                            <label class="custom-control-label" for="Online">Online Application</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="email" name="application_method" type="radio" value="Email" class="custom-control-input" required>
                            <label class="custom-control-label" for="email">via Email</label>
                        </div>
                        @if ($errors->has('application_method'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('application_method') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div id="showOnline" class="myDiv">
                            <div class="form-group">
                                <label for="application_threshold"> Application Threshold</label>
                                <input type="number" name="application_threshold" value="{{ $vacancy->application_threshold }}" class="form-control {{ $errors->has('application_threshold') ? ' is-invalid' : '' }}" placeholder="50"  id="application_threshold" />
                                @if ($errors->has('application_threshold'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('application_threshold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="showEmail" class="myDiv">
                            <div class="form-group">
                                <label for="email"> Vacancy Email</label>
                                <input type="email" name="email" value="{{ $vacancy->email }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email to receive applications"  id="email" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div> --}}







                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
    <script>
        CKEDITOR.replace("overview",
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
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        CKEDITOR.replace( 'responsibilities' );
    </script>
    <script>
        CKEDITOR.replace( 'other_requirements' );
    </script>
    <!-- Select2 -->
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('.select2').select2();
    });
    </script>

    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="close_at"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY/M/DD'
                }
            });

            $('input[name="expected_start_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                locale: {
                format: 'YYYY/M/DD'
                }
            });

            $('input[name="salary_from"]').keyup(function(event) {

                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
                });
                });

                $('input[name="salary_to"]').keyup(function(event) {

                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
                });
            });
        });
    </script>
    <script>

        jQuery(document).ready(function($){
            $(".toggle_container").hide();
            $("button.reveal").click(function(){
                $(this).toggleClass("active").next().slideToggle("fast");

                if ($.trim($(this).text()) === 'Hide') {
                    $(this).text('Add More');
                } else {
                    $(this).text('Hide');
                }

                return false;
            });
            $("a[href='" + window.location.hash + "']").parent(".reveal").click();
        });

    </script>
    <script>
       jQuery(document).ready(function($){
            $('input[type="radio"]').click(function(){
                var demovalue = $(this).val(); 
                $("div.myDiv").hide();
                $("#show"+demovalue).show();
            });
        });
    </script>

@endpush
