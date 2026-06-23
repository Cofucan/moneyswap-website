@extends('layouts.admin')
@section('page_title', 'Outlet Details')
@section('content')
<div class="bread-crumb bg5 p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
    <a href="{{ url ('home')}}" class="s-text16">
        <i class="fa fa-home"></i> Dashboard
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url ('outlets/manage')}}" class="s-text16">
        Outlets
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">Outlet #{{ $outlet->id }}</span>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $outlet->label }}</h5>
        <p class="card-text"><strong>Organization:</strong> {{ $outlet->organization_id ? ($outlet->Organization->organization_name ?: $outlet->Organization->legal_name ?: $outlet->Organization->trading_name) : '-' }}</p>
        <p class="card-text"><strong>Type:</strong> {{ $outlet->outlet_type }}</p>
        <p class="card-text"><strong>Code:</strong> {{ $outlet->outlet_code ?: '-' }}</p>
        <p class="card-text"><strong>Telephone:</strong> {{ $outlet->telephone ?: '-' }}</p>
        <p class="card-text"><strong>Address:</strong> {{ $outlet->address }}</p>
        <a href="{{ route('outlets.edit', $outlet->id) }}" class="btn btn-primary btn-sm">Edit</a>
    </div>
</div>
@endsection
