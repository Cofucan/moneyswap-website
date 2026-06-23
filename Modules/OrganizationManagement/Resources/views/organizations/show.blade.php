@extends('layouts.admin')
@section('page_title', $organization->organization_name )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
@endpush
@section('content')



    <div class="container-fluid">
        <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
            <div class="col-md-8 ">
                <a href="{{ url ('home')}}" class="s-text16">
                    <i class="fa fa-home"></i> Dashboard
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
    
                <a href="{{ url ('organizations/manage')}}" class="s-text16">
                   Organizations
                    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
                </a>
    
                <span class="s-text17">
                    {{$organization->organization_name}}
                </span>
            </div>
            <div class="col-md-4">

                    <a href="{{ url('organizations/manage') }}"><button class="btn btn-sm btn-success">Manage <i class="fa fa-list"></i></button></a>
                    <a class="btn btn-primary btn-sm" href="{{ route('organizations.edit',$organization->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-success" href="{{ route('organizations.edit',$organization->id) }}"><i class="fa fa-print"></i> Print</a>
    
                </div>
        </div>
        <div class="row">
            <div class="col-md-7 organization_name">
                <h3>  {{ $organization->organization_name }} </h3>
            </div>
            
        </div>

    <div class="row details mt-4 ">
       <div class="col-xs-10 col-sm-10 col-md-4  ">
           <div class="school-image">
                <img src="{{ asset ($organization->official_logo) }}" class="img-responsive w-100" alt="Official Logo" />
           </div>
        </div>

        <div class="col-xs-10 col-sm-12 col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Trading Name:</strong>
                        {!! $organization->trading_name !!}
                    </div>
                    <div class="form-group">
                        <strong>Reg Number:</strong>
                        {!! $organization->reg_number !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                            <strong>Industry:</strong>
                            {!! $organization->Industry->industry_name !!}
                    </div>
                    <div class="form-group">
                        <strong>VAT Number:</strong>
                        {!! $organization->vat_number !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xs-10 school-image col-sm-10 col-md-12">
        <div class="form-group">
            <strong>Excerpt:</strong>
            {!! $organization->overview !!}
        </div>
        <hr>
        <div class="form-group">
            <h5>Content :</h5>
            {!! $organization->about_organization!!}
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Outlets</h4>
            <a class="btn btn-sm btn-success" href="{{ route('outlets.create', ['organization_id' => $organization->id]) }}">
                Add Outlet <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organization->Outlets as $outlet)
                        <tr>
                            <td>{{ $outlet->id }}</td>
                            <td>{{ $outlet->label }}</td>
                            <td>{{ $outlet->outlet_type }}</td>
                            <td>{{ $outlet->address_prefix }} {{ $outlet->building_number }}, {{ $outlet->street_name }}</td>
                            <td>{{ !empty($outlet->City->city_name) ? $outlet->City->city_name : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No outlets yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    </div>
@endsection
