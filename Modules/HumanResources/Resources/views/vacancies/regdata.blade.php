

     <div class="main-content mt-4">


                        <div class="job-text">
                        
                                <ul>
                                    <div class="row mb-4">
                                
                                        <div class="col-md-6">
                                            <li class="mb-1"> <b class="mr-3">Vacancy Ref: </b> {{ $vacancy->vacancy_ref }}</li>
                                            <li class="mb-1"> <b class="mr-3">Employment Type: </b> {{ $vacancy->EmploymentType->employment_type }}</li>
                                            <li class="mb-1"> <b class="mr-3">Minimum Requirements: </b> {{ $vacancy->Qualification->label }}</li>
                                        </div>
                                         <div class="col-md-6">
                                            {{-- <li class="mb-1"> <b class="mr-3"></b></li> --}}
                                            <li class="mb-1"> <b class="mr-3">Application Deadline:</b> {{ $vacancy->close }}</li>
                                            <li class="mb-1"> <b class="mr-3">Available Positions:</b> {{ $vacancy->employees_needed }}</li>
                                            <li class="mb-1"> <b class="mr-3">Minimum Experience Year: </b> {{ $vacancy->years_of_experience }}</li>
                                        </div>
                                            
                                    </div>
                                </ul>
                            <hr>
                        </div>

                        {{--  <div class="col-md-6">
                                <a href="#" class="btn btn-success mt-3 mr-4">View Details</a>
                            <a href="#" class="btn btn-danger mt-3 ">Apply Now</a>
                        </div>  --}}



                        <div class="single-content2">
                            <h6>Description</h6>
                            <div class="text-justify"> {!!  $vacancy->description !!}</div>
                        </div>
                        @if (!empty($vacancy->responsibilities))
                            <div class="single-content4 mb-4">
                                <h6>Duties & responsibility</h6>
                                <div class="text-justify">  {!!  $vacancy->responsibilities !!}</div>
                            </div>                            
                        @endif
                        @if (!empty($vacancy->other_requirements))
                        <div class="single-content4 mb-4">
                            <h6>Other Requirements</h6>
                            <div class="text-justify"> {!!  $vacancy->other_requirements !!}</div>
                            
                        </div>
                            
                        @endif
                        <div class="row mb-4">
                            <div class="col-md-6 ">
                                <div class="single-content6">
                                     
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-content6">

                                </div>
                            </div>

                        </div>


                         <hr>


                        {{--  <div class="pull-right mb-3"> <span>Share on </span><br>{!! $shared !!} </div>  --}}

                    </div>

