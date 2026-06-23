@extends('layouts.admin')
@section('content_caption', 'Add Slider')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
@endpush
@section('content')

<div class="container-fluid">
    <nav aria-label ="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{url('home')}}"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{url('sliders/manage')}}"> Sliders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Slider</li>
            
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Create Slider </h4>
          <span>All fields marked with <span class="required">*</span> are required</span>
          <form method="POST" action="{{ route('sliders.store') }}" id="CreateSlider" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="caption"> Slider Caption <span class="required">*</span></label>
                    <input type="text" name="caption" value="{{ old ('caption')}}" class="form-control{{ $errors->has('financial_year_id') ? ' is-invalid' : '' }}" required/>
                    @if ($errors->has('caption'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('caption') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group ">
                    <label for="highlight">Slider Highlight</label>
                    <textarea name="highlight" class="form-control{{ $errors->has('financial_year_id') ? ' is-invalid' : '' }}" rows="1"></textarea>
                    @if ($errors->has('highlight'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('highlight') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="display_media">Display Media<span class="required">*</span></label>
                    <input type="file" name="display_media" value="" class="form-control{{ $errors->has('financial_year_id') ? ' is-invalid' : '' }}" id="display_media" required/>
                    @if ($errors->has('display_media'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('display_media') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-danger reveal pull-right"><b>More</b></button>
                        <div class="toggle_container" id="Description">                      
                            
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="buttone_one"> Button One</label>
                                </div>
                                <div class="col-md-6 input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Text</div>
                                    </div>
                                    <input type="text" name="button_one" value="{{ old ('button_one')}}" class="form-control{{ $errors->has('button_one') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('button_one'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('button_one') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Link</div>
                                    </div>
                                    <input type="text" name="button_one_link" value="{{ old ('button_one_link')}}" class="form-control{{ $errors->has('button_one_link') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('button_one_link'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('button_one_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col-md-12">
                                    <label for="button_two"> Button Two</label>
                                </div>
                                <div class="col-md-6 input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Text</div>
                                    </div>
                                    <input type="text" name="button_two" value="{{ old ('button_two')}}" class="form-control{{ $errors->has('button_two') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('button_two'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('button_two') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6 input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Link</div>
                                    </div>
                                    <input type="text" name="button_two_link" value="{{ old ('button_two_link')}}" class="form-control{{ $errors->has('button_two_link') ? ' is-invalid' : '' }}"/>
                                    @if ($errors->has('button_two_link'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('button_two_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
            
                    </div>
                </div>
            


                <hr class="mb-4">
                <button class="btn btn-success" type="submit">Save </button>
                <button class="btn btn-primary" type="reset">Reset</button>

            </form>
        </div>
</div>
</div>


@endsection
@push('scripts')
<script>
    jQuery(document).ready(function($){
        $(".toggle_container").hide();
        $("button.reveal").click(function(){
            $(this).toggleClass("active").next().slideToggle("fast");

            if ($.trim($(this).text()) === 'Hide') {
                $(this).text('Add More');
            } else {
                $(this).text('Hide');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".reveal").click();
    });
</script>
@endpush
