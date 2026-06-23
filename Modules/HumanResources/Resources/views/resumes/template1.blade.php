@extends('layouts.slip')
@section('page_title',  'Resume')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
<style>
    #state_loading{
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



    <div class="container-fluid "> 
        <div class="row mt-4 mb-5">
            <div class="col-md-3" id="left-section">
                    <h3 class="mb-4">  John Mike Doe </h3>
                    <div class="text-center">
                    <img src="{{asset('images/passport.png')}}" alt="Passport" class="img-thumb">
                    </div>
                    <h5 class="mt-4">Contact</h5>
                    <p><i class="fa fa-map-marker"> </i>: 64, Main Street, Mainland Lagos</p>
                    <p> <i class="fa fa-envelope"></i>:  johndoe@sample.com </p>
                    <p><i class="fa fa-phone"></i> :  08100112233 </p>

                    <h5 class="mt-5">Bio</h5>
                    <p>I am a courteous and well-spoken individual seeking to work.</p>
            </div>
            <div class="col-md-9 bio-data" id="right-section">
                <h5 class="bg-light">Department Objectives</h5>
                <p>I am a courteous and well-spoken individual seeking to work in a 
                    conducive environment where good is recognized and rewarded due to staff commitment.</p> 
            <div class="bio-data mt-5">
                <h5 class="bg-light">Educational</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td>1993 – 1998</td>
                            <td width="80%"> <b>Ireti Primary School Ikoyi, Lagos</b>                            <br>First School Leaving Certificate(FSLC)</td>
                        </tr> 
                        <tr>
                            <td>1998 – 2003</td>
                            <td> <b>Victoria Island Secondary School V/I Sand Field Mobile, Lagos</b>
                            <br>Senior Secondary School Certificate(SSCE)</td>
                        </tr>   
                        <tr>
                            <td>2007 – 2008</td>
                            <td> <b>Computer College Training Centre Lekki, Lagos.</b>
                            <br>Certificate in Desktop Publishing</td>
                        </tr> 
                        <tr>
                            <td>2008 - 2013</td>
                            <td> <b>Nassarrawa State Polytechnic</b>
                            <br>Diploma in Sociology(HND)</td>
                        </tr>                                                        
                    </table>               
            </div> 

            <div class="bio-data mt-5">
                <h5 class="bg-light">Work Experience</h5>
                <div class="mt-3">
                    <table class="table table-borderless">
                        <tr>
                            <td>2014 – 2016</td>
                            <td width="80%"> <b>Shoprite Shopping Centre (THE PALMS)</b> LEKKI, LAGOS
                                <br>Cashier  
                                <br>Lorem Ipsum dolor sit amet, consecteure adipiscing elit, sed diam nonummy nibh euismod tincident ut laoreet dolore madna aliquam
                            </td>
                        </tr> 
                        <tr>
                            <td>2014 – 2016</td>
                            <td width="80%"> <b>Silvervalley International College</b> Kabba, Kogi State
                                <br>Vice Principal
                                <br>Lorem Ipsum dolor sit amet, consecteure adipiscing elit, sed diam nonummy nibh euismod tincident ut laoreet dolore madna aliquam
                            </td>
                        </tr> 
                                                                              
                    </table>
                </div>                       
            </div> 
            
            <div class="bio-data mt-3">
                <h5 class="bg-light">Skills and Abilities</h5>
                    <ul>
                        <li>Ability to work under pressure and meet seemingly  impossible targets with little or  no supervision</li>
                        <li>Team Player and willing to go extra mile</li>
                        <li>High ethnic orientation, intelligent, resourceful, honest and self-driven</li>
                    </ul>                 
            </div> 
            
               
            </div> 
          
        
        </div>
    </div>





@endsection

@push('scripts')
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                format: 'YYYY/MM/DD'
                }
            });
        });
    </script>
    <script>
   jQuery(document).ready(function($){


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
    </script>

    <script type="text/javascript">
        $('#country').on('change',function(){
        var country = $(this).val();
        if(country){
        $.ajax({
            type:"GET",
            url:"{{url('countries/get-state-list')}}?country="+country,
            beforeSend: function()
            {
            $('#state_loading').css("visibility", "visible");
            },
            success:function(res){
            if(res){

                $("#state").empty();

                $('#state_loading').css("visibility", "hidden");

                $.each(res,function(key,value)
                {
                $("#state").append('<option value="'+key+'">'+value+'</option>'); });
                }else
                {
                $("#state").empty();
                }
            } });
        }else{
        $("#state").empty();
        }
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

 @endpush
