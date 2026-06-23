@extends('layouts.admin')
 @section('page_title', $cohort->label )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('lib/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
<style>
    .card{
        overflow: hidden;
    }
</style>
@endpush
@section('content')

    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('cohorts/manage') }}"> <i class="fa fa-list"></i> Clients Groups</a></li>
            @if (Auth::user()->Profile->role_id == 11 || Auth::user()->Profile->role_id == 14)
            <li class="breadcrumb-item"><a href="{{ url ('cohorts')}}">Client Groups </a></li>
            <li class="breadcrumb-item"><a href="{{ url ('cohorts/manage')}}"> Client Groups </a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">  {{ $cohort->label }}</li>

            <div class="ml-auto mr-0">
                <a class="btn btn-success px-3 btn-sm mb-2" href="{{ route('clients.add', $cohort)}}">Add Client</a>
                @include('ClientManagement::clients.uploadmodal')
                <a class="btn btn-warning px-3 btn-sm mb-2" href="#editgroup" data-target="#editgroup" data-toggle="modal">Edit</a>
                @include('ClientManagement::cohorts.editmodal')
            </div>
            <div class="ml-4">
                <form action="{{ route('cohorts.destroy',$cohort) }}" method="post"
                onsubmit="return confirm('Are you sure you want to delete this record?');">
                <input type="hidden" name="_method" value="DELETE" />
                {{ csrf_field() }}
                <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn mb-2">Delete </button>
            </form>
            </div>
        </ol>
    </nav>

    <div class="row details p-t-20">
        <div class="col-md-12"><h4 class="mb-4">{{ $cohort->label }}  </h4></div>
        <div class="col-md-5 content_title mb-4">
            <div class="card">
                <div class="corner-ribbon">
                {{$cohort->status}}
                </div>
                <div class="card-body">

                    <p><b>Class:</b> {{$cohort->label}}</p>
                    <p><b>Outlet:</b> {{$cohort->students_campus}}</p>
                    <p><b>Term:</b> {{$cohort->school_term}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h5>Total Clients: <b>{{$cohort->Clients->count()}}</b></h5>
            @include('ClientManagement::cohorts.action')
        </div>
        <div class="col-md-4">
            <p><b>Created By:</b> {{$cohort->creator}}</p>
                    <p><b>Date Created:</b> {{$cohort->date_created}}</p>
                    @if($cohort->status <> 'Draft')
                        <p><b>Date Submitted:</b> {{$cohort->date_scheduled}}</p>
                    @endif
        </div>

        <div class="col-md-12" id="tab">
            <div class="card">
                <div class="card-header">
                    <h5>Clients</h5>
                </div>
                <div class="card-body">
                    <table class="table w-100" id="table">
                        <thead>
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Reference. </th>
                                    <th >Client </th>
                                    <th >Admission No. </th>
                                    <th >Gender</th>
                                    <th >Date of Birth</th>
                                    <th >Attendance Type</th>
                                    <th width="10%"> </th>
                                </tr>
                            </thead>

                        </thead>
                        <tbody>
                            @foreach($cohort->Clients as $client)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$client->reference}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->admission_number}}</td>
                                <td>{{$client->Profile->gender}}</td>
                                <td>{{$client->Profile->birthday}}</td>
                                <td>{{$client->attendance_type}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('clients.show', $client) }}" class="px-2 btn btn-primary btn-sm">Details</a>
                                        </div>

                                    @if ($client->status == 'Draft' || $client->status == 'Scheduled')
                                        <div class="col-md-6">
                                            <form action="{{ route('clients.destroy',$client) }}" method="post"
                                                onsubmit="return confirm('Are you sure you want to delete this client?');">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                {{ csrf_field() }}
                                                <button type="submit" name="Delete" class="px-2 btn btn-sm btn-danger action_btn">Remove</button>
                                            </form>
                                        </div>
                                    @endif
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>





@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 <script>
    jQuery(document).ready(function($){
        // $(".toggle_container").hide();
        //     $("button.reveal").click(function(){
        //         $(this).toggleClass("active").next().slideToggle("fast");

        //         if ($.trim($(this).text()) === 'Hide') {
        //             $(this).text('Attach Vendor');
        //         } else {
        //             $(this).text('Hide');
        //         }

        //         return false;
        //     });
        // $("a[href='" + window.location.hash + "']").parent(".reveal").click();

        $('input[name="rate"]').keyup(function(event) {

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


    });
</script>

 @endpush
