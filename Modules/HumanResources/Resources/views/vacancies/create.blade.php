@extends('layouts.admin')
@section('page_title', 'Post Job Vacancy')
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
			New Vacancy
		</span>
	</div>

<div class="row">
  <div class="col-md-8 content_title">
    <h4 class="mb-3">Add Vacancy </h4>
	</div>
  <div class="col-md-4">

	  <div class="page_button">
        <a href="{{ url('vacancies/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>

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

            <form action="{{ route('vacancies.store') }}" method="POST" id="CreateVacancy" enctype="multipart/form-data">
                {{csrf_field()}}
                {{-- <input type="hidden" name="organization_id" value="{{ $portal->Organization->id }}" id="organization_id" />          --}}

                <div class="form-row">
                    <div class="col-md-4 form-group">
                        <label for="designation_id"> Designation</label>
                        <select class="custom-select d-block w-100 select2{{ $errors->has('designation_id') ? ' is-invalid' : '' }}"  name="designation_id" id="designation_id" required>
                            @foreach($designations as $key => $designation)
                                @if(old('designation_id') == $key)
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

                    <div class="col-md-4 form-group">
                        <label for="employment_type_id"> Employment Type</label>
                        <select class="custom-select d-block w-100 select2{{ $errors->has('employment_type_id') ? ' is-invalid' : '' }}"  name="employment_type_id" id="employment_type_id" required>
                            @foreach($employmentTypes as $key => $employment_type)
                                @if(old('employment_type_id') == $key)
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
                    <div class="col-md-4 form-group">
                        <label for="qualification_id"> Minimum Qualifications <span class="required">*</span></label>
                        <select name="qualification_id" class="custom-select d-block w-100 select2 {{ $errors->has('qualification_id') ? ' is-invalid' : '' }}" id="qualification_id" required>
                            <option>Choose Qualification </option>
                            @foreach($qualifications as $key => $qualification)
                            @if(old('qualification_id') == $key)
                            <option value="{{$key}}" selected> {{ $qualification }}</option>
                                    @else
                                    <option value="{{$key}}"> {{ $qualification }}</option>
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

                <div class="form-row">

                    <div class="col-md-4 form-group">
                        <label for="years_of_experience"> Min. Experience Years <span class="required">*</span></label>
                        <select name="years_of_experience" class="custom-select d-block w-100 select2 {{ $errors->has('years_of_experience') ? ' is-invalid' : '' }}" id="years_of_experience" required>
                            <option>Choose Experience (Years)</option>
                            @for ($years = 0; $years < 11; $years++)
                                @if(old('years_of_experience') == $years)
                                <option value="{{$years}}" selected> {{$years}}</option>
                                @else
                                <option value="{{$years}}"> {{$years}}</option>
                                @endif
                            @endfor
                            <option value="11">10+</option>
                        </select>
                        @if ($errors->has('years_of_experience'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('years_of_experience') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3 form-group">
                        <label for="academic_term"> Academic Term</label>
                        <select class="custom-select d-block w-100 select2" id="academic_term" name="academic_term_id">
                            <option value=""> Select Term</option>
                            @foreach($academicTerms as $key => $academicterm)
                                @if((old('academic_term_id') == $key) || ($key == $currentterm->id))
                                <option value="{{$key}}" selected> {{$academicterm }}</option>
                                @else
                                <option value="{{$key}}">  {{$academicterm }} </option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('academic_term_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('academic_term_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="campus_id"> Location </label>
                        <select id="neighbourhood" class="select2 form-control" name="campus_id" data-live-search="true" >
                            {{-- <option>Choose Location </option> --}}
                            @foreach($portal->Organization->Campuses as $campus)
                            <option value="{{$campus->id}}"> {{$campus->Neighbourhood->neighbourhood_name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('campus_id'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('campus_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-row">

                    <div class="col-md-4 mb-3 form-group">
                        <label for="expected_start_date ">Expected Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="expected_start_date" value="{{old ('expected_start_date')}}" class="form-control{{ $errors->has('expected_start_date') ? ' is-invalid' : '' }}"  id="expected_start_date" />
                        </div>
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
                            <input type="text" class="form-control{{ $errors->has('close_at') ? ' is-invalid' : '' }} pull-right" name="close_at"  value="{{old ('close_at')}}">
                        </div>

                        @if ($errors->has('close_at'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('close_at') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="employees_needed"> Employees Needed <span class="required">*</span></label>
                        <input type="number" name="employees_needed" value="{{ (old ('employees_needed') || 1) }}" class="form-control {{ $errors->has('employees_needed') ? ' is-invalid' : '' }}" placeholder="50"  id="employees_needed" />
                        @if ($errors->has('employees_needed'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('employees_needed') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                      <label class="control-label" for="salary_from"> Minimum Salary<span class="requiredfield">*</span></label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">NGN</div>
                        </div>
                        <input type="text" class="form-control" value="{{old ('salary_from')}} " id="salary_from" name="salary_from" placeholder="Minimum Salary">
                      </div>
                    </div>
                    <div class="col-md-6 form-group">
                      <label class="control-label" for="salary_to">Possible Maximum</label>
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" value="{{old ('salary_to')}} " id="salary_to" name="salary_to" placeholder="Possible Maximum">
                        <div class="input-group-append">
                          <select name="payment_cycle" id="payment_cycle" class="custom-select select2 w-100 form-control" data-live-search="true" title="Please select a payment_cycle ...">
                            @foreach($paymentCycles as $Cycle)
                              @if(old('payment_cycle') == $Cycle)
                              <option value="{{$Cycle}}" selected> {{$Cycle}}</option>
                              @else
                              <option value="{{$Cycle}}">  {{$Cycle}} </option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="form-row">

                    <div class="col-md-6 form-group">
                        <label for="display_salary" class="control-label mb-3">Display Salary to applicants</label> <br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="Yes" name="display_salary" type="radio" value="1" class="custom-control-input"checked>
                            <label class="custom-control-label" for="Yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="No" name="display_salary" type="radio" value="0" class="custom-control-input">
                            <label class="custom-control-label" for="No">No</label>
                        </div>
                    </div>


                </div>




                <div class="form-group ">
                    <label for="description">Description <span class="required">*</span></label>
                    <textarea name="description" id="description"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="4" placeholder="Enter Vacancy Overview">
                    {!! old('description') !!}
                    </textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="responsibilities">Duties & Responsibilities</label>
                    <textarea name="responsibilities" value="{{ old('responsibilities') }}" class="form-control" rows="2" placeholder="Add responsibilities">
                        {!! old('responsibilities')  !!} </textarea>
                    @if ($errors->has('responsibilities'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('responsibilities') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-danger reveal pull-right"><b>Add More</b></button>
                        <div class="toggle_container" id="Description">
                            <div class="form-group">
                                <label for="vacancy_ref"> Vacancy Ref</label>
                                <input type="text" name="vacancy_ref" value="{{ old('vacancy_ref') }}" class="form-control {{ $errors->has('vacancy_ref') ? ' is-invalid' : '' }}"   id="vacancy_ref" />
                                @if ($errors->has('vacancy_ref'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('vacancy_ref') }}</strong>
                                    </span>
                                @endif
                            </div>
                              <div class="form-group ">
                                <label for="other_requirements">Other Requirements <span class="required">*</span></label>
                                <textarea name="other_requirements" id="other_requirements"  class="form-control{{ $errors->has('other_requirements') ? ' is-invalid' : '' }}" rows="4" placeholder="Other requirements">
                                {!! old('other_requirements') !!}
                                </textarea>
                                @if ($errors->has('other_requirements'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('other_requirements') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
                <div class="form-row ">
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
                                <label for="application_threshold"> Applications Limit</label>
                                <input type="number" name="application_threshold" value="{{ old ('application_threshold') }}" class="form-control {{ $errors->has('application_threshold') ? ' is-invalid' : '' }}" placeholder="50"  id="application_threshold" />
                                @if ($errors->has('application_threshold'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('application_threshold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="showEmail" class="myDiv">
                            <div class="form-group">
                                <label for="email"> Application Submission Email</label>
                                <input type="email" name="email" value="{{ old ('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email to receive applications"  id="email" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>



                <hr class="mb-4">
                <button class="btn btn-success" type="submit" name="status" value="Draft">Save </button>
                <button class="btn btn-success" type="submit" name="status" value="Scheduled">Schedule </button>
            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
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
