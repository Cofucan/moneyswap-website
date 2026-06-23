@extends('layouts.admin')
@section('page_title', 'Add FAQ')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
@endpush
@section('content')

    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ url('incidents/manage') }}">Incidents</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report an Incident</li>
           
        </ol>
    </nav>

    <div class="row">   
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Report an Incident</h4>
            <form method="POST" action="{{ route('incidents.store') }}" id="CreateFaq">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="label">Question Category</label>
                    <select  name="faq_category_id" class="select2 w-100 custom-select d-block" data-live-search="true" title="Please select label category ..." id="Faqcategory">
                            @foreach($faqcategories as $key => $faqcategory)
                            <option value="{{$key}}"> {{$faqcategory}} </option>
                            @endforeach
                    </select>
                    @if ($errors->has('faq_category_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('faq_category_id') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="label">Question</label>
                    <input type="text" name="label" value="{{old('label')}}" class="form-control"  id="label" />
                    @if ($errors->has('label '))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('label') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="overview">Answer</label>
                    <textarea name="overview" class="form-control" rows="7" placeholder="Provide response">
                        {!! old('overview') !!}
                    </textarea>
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

@endsection
@push('scripts')
<script>
    CKEDITOR.replace( 'overview' );
</script


@endpush
