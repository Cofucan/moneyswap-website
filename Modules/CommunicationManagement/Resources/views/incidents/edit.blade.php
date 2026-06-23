@extends('layouts.admin')
@section('page_title', 'Update FAQ')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

<div class="container-fluid">
    <div class="bread-crumb bg5 flex-w p-l-5 p-t-5 p-b-5 p-l-15-sm m-b-10">
		<a href="{{ url ('home')}}" class="s-text16">
			<i class="fa fa-home"></i> Dashboard
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="{{ url ('incidents/manage')}}" class="s-text16">
			FAQs
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			create
		</span>
	</div>

<div class="row">
  <div class="col-md-3 offset-md-1 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Existing FAQ</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
        <div class="page-menu">
            <ul>


            </ul>
        </div>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Edit FAQ</h4>
            <form method="POST" action="{{ route('incidents.update', $incident->id) }}" id="UpdateFaq">
                {{csrf_field()}}
                @method('PUT')

                <div class="form-group">
                    <label for="label">Question</label>
                    <input type="text" name="label" value="{{ $incident->label }}" class="form-control"  id="label" />
                    @if ($errors->has('label '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="overview">Answer</label>
                    <textarea name="overview" class="form-control" rows="7" placeholder="Response">{!! $incident->overview !!}</textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('overview') }}</strong>
                        </span>
                    @endif
                </div>

                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>

            </form>
        </div>
</div>
</div>



@endsection
@push('scripts')
<script>
    CKEDITOR.replace( 'overview' );
</script


@endpush
