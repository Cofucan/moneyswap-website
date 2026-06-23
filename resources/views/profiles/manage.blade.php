@extends('layouts.admin')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css')}} "/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
@endpush
@section('content')

<section>
    <div class="container">
        <nav aria-label ="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profiles</li>
                <div class="ml-auto mr-0">
                   <a class="btn btn-success btn-sm" href="{{url('profiles')}}">Create New Profile</a>
                </div>
            </ol>
        </nav>

        <div class="row mt-3">
            <div class="col-md-12 col-sm-12 col-xs-12 p-t-20">
                <h4>Profiles</h4>

                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Location</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                            <tr class="profile{{$profile->referral_code}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$profile->full_name}} </td>
                                <td>{{ $profile->Country->label }}</td>
                                <td>{{ $profile->User->email }}</td>
                                <td>{{$profile->DefaultPhone->phone_number ?? 'None'}}</td>
                                <td>{{ $profile->status }}</td>
                                 <td>
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                            <a class="btn btn-secondary btn-sm" href="{{ route('profiles.show', $profile->referral_code) }}">Details</a>
                                        </div>
                                        <div class="col-md-3">

                                        </div>
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
</section>

@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
  @endpush
