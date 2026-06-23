@extends('layouts.admin')
 @section('page_title', $price->label . ' Details' )
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush
@section('content')


    <nav aria-label ="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('pricecategories') }}"> Price Categories</a></li>
            @if (!is_null($price->item_category_id))
            <li class="breadcrumb-item"> <a href="{{ route('pricecategories.show', $price->PriceCategory) }}"> {{ $price->category }}</a></li>
            
            @endif
            <li class="breadcrumb-item active" aria-current="page"> {{$price->label}}</li>
            <div class="ml-auto mr-0">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editprice{{$price->id}}">Edit</a>
                @if($price->published == true)
                <a class="btn btn-warning btn-sm" href="{{ url('prices/toggle', $price)}}">Deactivate</a>
                @else
                <a class="btn btn-success btn-sm" href="{{ url('prices/toggle', $price)}}">Activate</a>
                @endif
                @if ((optional(Auth::user()->Profile)->role_id == 1 || optional(Auth::user()->Profile)->role_id == 3) && class_exists(\Modules\FeeManagement\Entities\Fee::class) && Route::has('fees.store'))
                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#newfee">
                        <i class="fa fa-credit-card"></i> Add
                    </a>
                    @includeIf('feemanagement::fees.createmodal')
                @endif
                {{-- modal begins--}}
                @include('catalogmanagement::prices._formedit')

            </div>
        </ol>

        {{-- edit modal begins--}}

        {{-- edit modal end--}}

    </nav>


    <div class="row details p-t-20">
        <div class="col-md-8 mb-4 content_title">
	    <h4>   {{ $price->label }}  </h4>
             <div class="form-group">
                <strong>Category:</strong>
                {{ $price->category ?? 'Uncategorized' }}
            </div>
            <div class="form-group">
                <strong>Feature:</strong>
                {{ $price->Feature->label ?? 'Unassigned' }}
            </div>
            <div class="form-group">
                <strong>Cost Price:</strong>
                @if(is_null($price->cost_price))
                    Free
                @else
                    NGN {{ number_format($price->cost_price, 2) }}{{ $price->uom ? ' /'.$price->uom : '' }}
                @endif
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                @if($price->published)
                    <span class="badge badge-success">Enabled</span>
                @else
                    <span class="badge badge-secondary">Disabled</span>
                @endif
            </div>
            @if(!empty($price->overview))
                <div class="form-group">
                    <strong>Overview:</strong>
                    {{ $price->overview }}
                </div>
            @endif
	    </div>

        <div class="col-md-11 col-sm-12 col-xs-12">
            @if (class_exists(\Modules\FeeManagement\Entities\Fee::class) && Route::has('fees.store'))
                <h4>Price Fees</h4>
                <div class="table-responsive-sm">
                    <table class="table w-100" id="table">
                        <thead>
                            <tr style="background-color: #F7F7F7">
                                <th>S/N </th>
                                <th>Label</th>
                                <th>
                                    @if ($price->label == 'School Bus')
                                    Route
                                    @else
                                        Applicable to
                                    @endif
                                </th>
                                <th>Payment Frequency</th>
                                <th>Selling Price</th>
                                @if (optional(Auth::user()->Profile)->role_id == 1 || optional(Auth::user()->Profile)->role_id == 3)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(($price->Fees ?? collect()) as $fee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fee->label }} </td>
                                <td>
                                    {{ $fee->Feeable->label ?? 'General Fee'}}
                                </td>
                                <td>{{ $fee->frequent }} </td>
                                <td>{{ $fee->price }} </td>
                                <td>
                                    <div class="row">
                                    @if (optional(Auth::user()->Profile)->role_id == 1 || optional(Auth::user()->Profile)->role_id == 3)
                                            <div class="col-md-7">
                                                <a class="btn btn-success btn-sm" href="#editfee{{ $fee->id }}" data-toggle="modal" data-target="#editfee{{ $fee->id }}">Edit
                                                </a>
                                                @if($fee->published == true)
                                                <a class="btn btn-warning btn-sm" href="{{ url('fees/toggle', $fee)}}">Disable</a>
                                                @else
                                                <a class="btn btn-success btn-sm" href="{{ url('fees/toggle', $fee)}}">Enable</a>
                                                @endif

                                            </div>
                                            <div class="col-md-2">
                                                <form action="{{ route('fees.destroy',$fee) }}" method="post"
                                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                        <input type="hidden" name="_method" value="DELETE" />
                                                        {{ csrf_field() }}
                                                        <button type="submit" name="Delete" class="btn btn-sm btn-danger action_btn"> <i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                            {{-- modal begins--}}
                                            @includeIf('feemanagement::fees.editmodal')
                                        {{-- modal ends--}}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            @endif

        </div>

    </div>






@endsection
