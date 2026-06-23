@extends('layouts.admin')
@section('page_title', 'Provisional list')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">

<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
        <a href="{{ url ('home')}}" class="s-text16">
          <i class="fa fa-home"></i> Dashboard
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url ('members/manage')}}" class="s-text16">
         Members
          <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
          New Member
        </span>
    </div>
<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Approved Applications</span>
            <span class="badge badge-secondary badge-pill">3</span>

          </h4>
        <div class="page-menu">

        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Approved Applications </h4>
          <p> Clients eligible for member </p>
          <form method="POST" action="{{ route('members.bulkstore') }}" id="CreateMember" enctype="multipart/form-data">
                {{csrf_field()}}



                <div class="form-row">
                    {{-- <div class="col-md-6 form-group">
                         <label for="grade_id"> ScoringScheme Level </label>
                        {{ $level->label}}
                    </div> --}}
                    <div class="col-md-6 mb-3 form-group">
                        <label for="academic_term_id"> Academic Term</label>
                        {{$academicterm->academic_term }}
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="Status"> Action  <span class="required">*</span></label>
                        <select name="status" class="custom-select d-block w-100 select2" id="status" required>
                            <option value="Offered">  Offer Member</option>
                            <option value="Recommended" selected> Recommend for Member</option>

                        </select>
                        @if ($errors->has('status'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    <label for="remarks"> Member Remark </label>
                    <input id="remarks" type="text" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}" name="remarks" placeholder="Comment" >
                </div>
            <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- <div class="table-responsive"> -->
        <table class="table w-100 mt-4" id="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Registration Code </th>
                    <th >Client Name</th>
                    <th >Member ScoringScheme Level </th>
                    <th >Academic Stream </th>
                    <th >Current Status </th>

                </tr>
            </thead>
            <tbody>
               @foreach($registrations as $registration)
               <input type="hidden" name="registrations[]" id="registration_id" value="{{ $registration->id }}" />
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $registration->registration_code }}</td>
                    <td>{{ $registration->Person->candidate_name }}</td>
                   <td>{{ $registration->Level->label }}</td>
                   <td>{{ $registration->Stream->stream_name }}</td>
                    <td>{{ $registration->status }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
<!-- </div> -->
</div>
</div>
            <hr class="mb-4">
                <div class="pull-right">
                <button class="btn btn-success" type="submit">Offer Member </button>
                </div>
            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>

@endpush
