@section('page_title', 'Our')
@extends('layouts.theme')
@push('style')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link href="{{ asset ('css/member.css')}}" rel="stylesheet">

@endpush


@section('content')

 <section id="page-image">
    <img src="{{ asset('img/member1.jpg')}}">
 </section>


  <!--==========================
      What We Do Section
    ============================-->
    <section id="member">
        <div class="container">
          <div class="row">
            <div class="col-md-9 facility">
                <h3 class="text-center">Member Application Form</h3>
                <hr>

                <form action="" method="post" role="form" class="contactForm">
                    <span class="span">Member Information</span>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                                </div>
                                <input id="candidate_surname" type="text" class="form-control{{ $errors->has('candidate_surname') ? ' is-invalid' : '' }}" name="candidate_surname" placeholder="Client Name" required autofocus>
                            </div>
                            @if ($errors->has('candidate_surname'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('candidate_surname') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                                </div>
                                <input id="candidate_othernames" type="text" class="form-control{{ $errors->has('candidate_othernames') ? ' is-invalid' : '' }}" name="candidate_othernames" placeholder="Other Names" required autofocus>
                            </div>
                            @if ($errors->has('candidate_othernames'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('candidate_othernames') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                         <div class="col-md-6 mb-3 form-group">
                            <label class="control-label" for="gender">Gender</label>
                            <select name="gender" class="custom-select d-block w-100" id="gender" required>
                                <option value="gender">Male</option>
                                <option>Female</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            <label class="control-label" for="date_of_birth">Date of Birth</label>
                            <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" placeholder="Date of Birth" required autofocus>
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="control-label" for="candidate_passport">Passport Photograph</label>
                        <input id="candidate_passport" type="file" class="form-control{{ $errors->has('candidate_passport') ? ' is-invalid' : '' }}" name="candidate_passport" placeholder="Date of Birth" required autofocus>
                        @if ($errors->has('candidate_passport'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('candidate_passport') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3 form-group">
                        <select name="school" class="custom-select d-block w-100" id="school" required>
                            <option value="school">School</option>
                            <option>Creche</option>
                            <option>Nursery</option>
                            <option>Primary</option>
                            <option>College</option>
                        </select>
                        @if ($errors->has('school'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('school') }}</strong>
                            </span>
                        @endif
                    </div>

                     <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <select name="school" class="custom-select d-block w-100" id="school" required>
                                <option value="school">Class applying to </option>
                                <option>Creche</option>
                                <option>Nursery</option>
                                <option>Primary</option>
                                <option>College</option>
                            </select>
                            @if ($errors->has('member_class'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('member_class') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3 form-group">
                            <select name="school" class="custom-select d-block w-100" id="school" required>
                                <option value="school">Academic Sesssion</option>
                                <option>Creche</option>
                                <option>Nursery</option>
                                <option>Primary</option>
                                <option>College</option>
                            </select>
                            @if ($errors->has('academic_session'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('academic_session') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <input id="current_school" type="text" class="form-control{{ $errors->has('current_class') ? ' is-invalid' : '' }}" name="current_class" placeholder="Current School" required autofocus>
                            @if ($errors->has('current_class'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('current_class') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            <select name="school" class="custom-select d-block w-100" id="school" required>
                                <option value="school">Present Class </option>
                                <option>Creche</option>
                                <option>Nursery</option>
                                <option>Primary</option>
                                <option>College</option>
                            </select>
                            @if ($errors->has('member_class'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('member_class') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <hr>
                    <span class="span">Agent Information</span>
                    <hr>
                    <div class="mb-3 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-o"></i></div>
                            </div>
                            <input id="parent_name" type="text" class="form-control{{ $errors->has('parent_name') ? ' is-invalid' : '' }}" name="parent_name" placeholder="Contact Name" required autofocus>
                        </div>


                        @if ($errors->has('parent_name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('parent_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                </div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="E-mail Address" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                </div>
                                <input id="tel" type="tel" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="email" placeholder="Telephone" required autofocus>
                            </div>
                            @if ($errors->has('tel'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <select name="relationship" class="custom-select d-block w-100" id="relationship" required>
                            <option value="relationship">Relationship</option>
                            <option>Mother</option>
                            <option>Father</option>
                            <option>Guardian</option>
                        </select>
                        @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" placeholder="Address" required autofocus>
                        </div>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>

                      <div class="form-row">
                       <div class="col-md-6 mb-3 form-group">
                       <select name="state" class="custom-select d-block w-100" id="state" required>
                            <option value="state">State</option>
                            <option>Lagos</option>
                            <option>Abuja</option>
                            <option>Kogi</option>
                        </select>
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>

                         <div class="col-md-6 mb-3 form-group">
                            <select name="state" class="custom-select d-block w-100" id="city" required>
                                <option value="city">City</option>
                                <option>Lagos</option>
                                <option>Abuja</option>
                                <option>Kogi</option>
                            </select>
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-7">
                            <ul>
                            <li>Non refundable application fee of N5,000 is mandatory</li>
                            </ul>
                        </div>

                        <div class="col-md-3 offset-md-2">
                            <button type="submit" class="btn btn-primary btn-sm btn-block pul-right">{{ __('Submit') }}</button>
                        </div>
                    </div>


                    </form>

        </div>
    </section>





  @endsection
  @push('script')
<script>
    CKEDITOR.replace("section_overview",
        {
            height: 120
        });
</script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function()
 {
   $('#sectionable_type').select2();
   $('#sectionable').select2();
  }
  );
  $('#sectionable_type').on('change',function()
{
  var sectionable_type = $(this).val();
  if(sectionable_type){
    $.ajax({
      type:"GET",
      url:"{{url('sections/get-sectionable-list')}}?sectionable_type="+sectionable_type,
      beforeSend: function()
      {
        $('#live_loading').css("visibility", "visible");
      },
      success:function(res){
        if(res){

          $("#sectionable").empty();

          $('#live_loading').css("visibility", "hidden");

          $.each(res,function(key,value)
          {
            $("#sectionable").append('<option value="'+key+'">'+value+'</option>'); });
          }else
          {
            $("#sectionable").empty();
          }
        } });
  }else{
    $("#sectionable").empty();
  }
});
</script>

<script>


  function showDescription() {
      document.getElementById("Description").style.display = "block";
  }

  function closeDescription() {
      document.getElementById("Description").style.display = "none";
  }

</script>

@endpush
