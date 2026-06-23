@extends('layouts.admin')

@section('content')
<section class="mt-2">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card px-3 py-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h4 class="text-muted"> <i class="fa fa-folder-o"></i> Cause Balance: </h4>
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-3">
                <h4 class="text-muted text-right">50,000</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
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
      </div>


      <div class="col-md-12 mt-5">
         @if (session()->has('message'))
        <div class="alert alert-primay">
            {{ session('message') }}
        </div>
        @endif
          @livewire('company')
      </div>

    </div>


  </div>
  </section>
@endsection
