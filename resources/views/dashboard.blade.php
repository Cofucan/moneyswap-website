@extends('layouts.admin')
@section('page_title', 'Dashboard ')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/hide.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css') }}">
@endpush
<style>
    .myDiv{
        display:none;
    }

</style>
@section('content')
    @if ( Auth::user()->Profile->role_id == 1 )
	@include('partials.dashboard.admin')
	@elseif ( Auth::user()->Profile->role_id == 5 )
	@include('partials.dashboard.customer')
	@elseif ( Auth::user()->Profile->role_id == 2 )
	@include('partials.dashboard.admin')
	@elseif ( Auth::user()->Profile->role_id == 4 )
    @include('partials.dashboard.cashier')
    @elseif ( Auth::user()->Profile->role_id == 6 )
    @include('partials.dashboard.storemanager')
    @elseif ( Auth::user()->Profile->role_id == 3 )
	@include('partials.dashboard.manager')
    @elseif ( Auth::user()->Profile->role_id == 9 )
	@include('partials.dashboard.agent')
@endif

@endsection
@push('scripts')
    <script>
        CKEDITOR.replace( 'article_body' );
    </script>
    <script>
        jQuery(document).ready(function($){
            $(".toggle_container").hide();
            $("button.reveal").click(function(){
                $(this).toggleClass("active").next().slideToggle("fast");

                if ($.trim($(this).text()) === 'Hide') {
                    $(this).text('Personalize Message');
                } else {
                    $(this).text('Hide ');
                }

                return false;
            });
            $("a[href='" + window.location.hash + "']").parent(".reveal").click();

    $(".mb-input").click(function(){
        var demovalue = $(this).val();
        $("div.myDiv2").hide();
        $("#display"+demovalue).show();
        });
    });
    </script>

    <script>
        function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myLink");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        /* Copy the text inside the text field */
        document.execCommand("copy");
        /* Alert the copied text */
        alert("Investor Referral Link Copied: " + copyText.value);
        }
    </script>
    <script>
        function myFunction2() {
        /* Get the text field */
        var copyText = document.getElementById("myLink2");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/
        /* Copy the text inside the text field */
        document.execCommand("copy");
        /* Alert the copied text */
        alert("100% Store Referral Link Copied: " + copyText.value);
        }
    </script>
@endpush
