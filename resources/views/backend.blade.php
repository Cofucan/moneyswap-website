@extends('layouts.admin')
@push('styles')

<style>
    h4, p, h6{
     margin-bottom: 0px;
    }
    .swap{
        border-bottom: solid 3px #000;
    }
    .swap:last-child{
        border: none
    }
    
</style>

@endpush
@section('content')
<section class="mt-2">
  <div class="container">
    <div class="row">

      {{-- <div class="col-md-6 mb-3">
        <div class="card px-3 py-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="text-muted"> <i class="fa fa-folder-o"></i> Cause Balance: </h5>
              </div>
              <div class="col-md-3">
                <select name="transaction_type" class="custom-select d-block w-100 select2" id="transaction_type" required>
                    <option value=""> NGN </option>
                    <option value=""> USD </option>
                    <option value=""> EURO </option>
                </select>
              </div>
              <div class="col-md-3">
                <h4 class="text-muted text-right">50,000</h4>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="col-md-12">
        <div class="card bg-ward px-2 py-3">
          <div class="row">
            <div class="col-md-5 col-sm-5 mb-2">
              <div class="row align-items-center ">
                <div class="col-md-3 col-3">
                 <div class="icon-border-circle"> <i class="fa fa-external-link"></i></div>
                </div>
                <div class="col-md-9 col-9">
                  <p>Total Transactions</p>
                  <h5>NGN 150,000</h5>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-3 mb-2">
              <div class="row align-items-center">
                <div class="col-md-4 col-sm-3 col-3 ">
                  <div class="icon-border-circle"> <i class="fa fa-external-link"></i></div>
                </div>
                <div class="col-md-8 col-8 col-sm-9 ">
                  <p class="pl-sm-2 pl-0 pl-md-0">Active Swaps</p>
                  <h5 class="pl-sm-2 pl-0 pl-md-0">3</h5>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4">
              <div class="row align-items-center">
                <div class="col-md-3 col-3">
                  <div class="icon-border-circle"> <i class="fa fa-external-link"></i></div>
                </div>
                <div class="col-md-9 col-9">
                  <p>Total Offers</p>
                  <h5>3</h5>
                </div>
              </div>
            </div>

            {{-- <div class="col-md-4 text-center">
              <i class="fa fa-folder-o fa-2x"></i>
              <h6> <a href="#" class="">My causes</a></h6>
            </div> --}}
          </div>
        </div>
      </div>
      {{-- <div class="col-md-6">
        <div class="card ">
          <div class="card-body">
              <div class="row">
                <div class="col-md-9">
                  <p class="text-muted"> This month we gave away NGN10,000 in referrals. You could earn with referrals too! </p>
                </div>
                <div class="col-md-3">
                  <a href="" class="btn btn-solid btn-blue">Refer Now</a>
                </div>
              </div>
          </div>

        </div>
      </div> --}}



    </div>

    <div class="row mt-5">

      <div class="col-md-12 mb-5">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-9 col-8">
                <h5>Pending Profiles</h5>
              </div>
              <div class="col-md-3 col-4">
                <a href="{{ url('profiles/home') }}" class="btn btn-primary btn-block btn-sm">View all</a>
              </div>
            </div>
          </div>
          <div class="px-3 py-3">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Telephone</th>
                  <th>Email</th>
                  <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($profiles as $profile)
                  <tr>
                  <td>{{ $profile->full_name}}</td>
                  <td>{{ $profile->country_code}}</td>
                  <td>+{{ !empty($profile->DefaultPhone->contact_value) ? $profile->DefaultPhone->contact_value : 'None'}}</td>
                  <td>{{ $profile->User->email }}</td>
                  <td>{{ $profile->status}}</td>
                    <td>
                      <a href="#" class="btn btn-danger btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Click to here to view all bids">Approve</a>
                      <a href="#" class="btn btn-primary btn-sm mb-2"   data-toggle="tooltip" data-placement="top" title="Click to here to view bid details">Details</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-header">
            <h5>Pending Swaps</h5>
          </div>
          <div class="card-body">
          <div class="d-none d-md-flex">
            <div class="table-responsive">             
              <table class="table table-stripe">
                <thead>
                  <tr>
                    <th>Type</th>
                     <th>Amount</th>
                    <th>Rate</th>
                    <th> </th>
                  </tr>
                </thead>             
                <tbody>
                  @foreach($swaps as $swap)
                  <tr>
                    <td>{{ $swap->type}} </td>
                    <td>{{ $swap->requested_amount}} </td>
                    <td>{{ $swap->swap_rate}}</td>
                    <td>
                      @include('swaps._action')
                    </td>
                  </tr>
                  @endforeach
  
                </tbody>
              </table> 
              </div>
          </div>
          <div class="d-md-none d-block  d-lg-none">
           <div class="row">
              @foreach($swaps as $swap)
                @include('swaps.mobiledata')
              @endforeach
              </div>
          </div>
          
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Closing Soon</h5>
          </div>
          <div class="card-body">
            <table class="table table-stripe">
              <thead>
                <tr>
                  <th>Transaction Details</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
@endsection
