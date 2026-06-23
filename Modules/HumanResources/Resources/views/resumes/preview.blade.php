@extends('layouts.preview')
@section('page_title', $resume->Profile->name .' Resume')
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
    <div class="container py-5"> 
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10 ">
            @if (Auth::user()->profile_id == $resume->profile_id)
            <div class="col-md-5">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>

                <span class="s-text17">
                    My Resume
                </span>

            </div>    
            <div class="col-md-3">
                <h6>Share on</h6>
               {!! $shared !!} 
            </div>   
            
            <div class="col-md-2">
                <a href="{{ route('resumes.show', $resume->reference_code) }}" class="btn btn-sm btn-block btn-success"> Edit</a>                       
            </div>
            @endif
           
            <div class="col-md-2">                             
                <a href="{{ route('resumes.print', $resume->reference_code) }}" class="btn btn-sm btn-block btn-warning"> Print</a>                       
            </div>             
        </div>
        
    </div>
    
    <div class="container">
    @include('resumes._details') 
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
