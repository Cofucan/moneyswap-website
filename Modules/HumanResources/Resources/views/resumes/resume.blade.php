@extends('layouts.slip')
@section('page_title',  $resume->Profile->full_name)
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/resume.css') }}">
<style>
    #state_loading{
    visibility:hidden;
    }
</style>

@endpush
@section('content')

    <div class="container-fluid "> 
        
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
