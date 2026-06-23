@extends('layouts.theme')
@push('styles')

@endpush
@section('content')
<div class="container m-t-30 m-b-10">
    <div class="row ">
     <div class="col-md-10 offset-md-1 portal">
        <h2 class="text-center">Unified Portal</h2>
        <hr>
                    <h5>Fill the form below to create the username and password that you will use to access Portal.</h5>
                    <ul class="p-l-20 p-t-10 p-b-10">
                        <li>The account information requested is for an adult only. </li>
                        <li>Please do not set up an account in the name of a client, you will be able to add client information later.  </li>
                        {{-- <li>If you have created an account before, Please <a href="{{ url ('/login')}}">login now. </a> </li> --}}
                    </ul>


                    <div class="card">
                        <div class="card-header">Register New</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                            @include('auth._register')
                            <div class="form-row mb-0">
                                <div class="col-md-6">
                                    <div class="form-check m-l-20">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="terms&condition">
                                                    <a href="#">{{ __('Accept Terms and Conditions') }}</a>
                                                </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
