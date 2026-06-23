@extends('layouts.admin')
@section('page_title', 'Client Group')
@push('styles')
<link rel="stylesheet" href="{{ asset ('css/board.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('css/select2.css') }}">
<style>
  .myDiv{
      display:none;
  }
</style>
@endpush
@section('content')
  <nav aria-label ="breadcrumb mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ url('home') }}"> <i class="fa fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('expenses/manage') }}">  Expenses </a></li>
        <li class="breadcrumb-item active" aria-current="page"> New</li>

    </ol>
  </nav>

  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Bulk Expense Request Form </h4>
      <form method="POST" action="{{ route('studentgroups.store') }}" id="CreateBulkExpense">
            {{csrf_field()}}
          <div class="form-group">
            <label for="label"> Title</label>
            <input type="text" name="label" value="{{old('label')}}" class="form-control" placeholder="Enter Expense Group Title"  id="label" />
            @if ($errors->has('label'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('label') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="employee_id"> Employee Responsible</label>
                <select name="employee_id"  class="custom-select d-block w-100 select2" id="employee_id">
                    @foreach($employees as $employee)
                      @if( old('employee_id') == $employee->id)
                        <option value="{{$employee->id}}" selected> {{$employee->Profile->full_name}}</option>
                      @else
                        <option value="{{$employee->id}}"> {{$employee->Profile->full_name}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('employee_id'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('employee_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="academic_term_id"> Term</label>
                <select name="academic_term_id"  class="custom-select d-block w-100 select2" id="academic_term_id">
                    @foreach($academicterms as $key => $academicterm)
                      @if( $key == $currentterm->id)
                        <option value="{{$key}}" selected> {{$academicterm}}</option>
                      @else
                        <option value="{{$key}}"> {{$academicterm}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('academic_term_id'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('academic_term_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>
        @for ($idx = 0; $idx < 4; $idx++)
        <div class="form-row">
          <div class="col-md-4">
          <label class="control-label" for="expense_title">Required Items</label>
          <select name="items[]"  class="custom-select d-block w-100 select2" id="item" >
            <option value="">Select All required Item</option>
            @foreach($items as $key => $item)
              @if( old('item_id') == $key)
                <option value="{{$key}}" selected> {{$item}}</option>
              @else
                <option value="{{$key}}"> {{$item}}</option>
            @endif
          @endforeach
         </select>
          @if ($errors->has('item'))
          <span class="invalid-feedback">
          <strong>{{ $errors->first('item') }}</strong>
          </span>
          @endif
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="rate">Cost Price </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">NGN</div>
                            </div>
                            <input type="number" class="form-control" value="{{old ('rates')}} " id="rates" name="rates[]">
                        </div>
                    </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                    <label class="control-label" for="quantity">Quantity </label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="{{old ('quantities')}} " id="quantities" name="quantities[]">
                        <div class="input-group-prepend">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor



            <div class="form-group ">
              <label for="narration">Purpose</label>
              <textarea name="narration" class="form-control{{ $errors->has('narration') ? ' is-invalid' : '' }}" placeholder="Expense narration" id="textarea"> {!! old('narration') !!}</textarea>
              @if ($errors->has('narration'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('narration') }}</strong>
                  </span>
              @endif
          </div>


          <hr class="mb-4">

          <button class="btn btn-success px-4" type="submit">Continue</button>

        </form>
    </div>
  </div>

{{-- @include('partials.summernote') --}}
@endsection
@push('scripts')
<script src="{{ asset('js/select2.full.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script>
  $(document).ready(function(){
      $('.select2').select2();
    });
</script>

 <script>

  jQuery(document).ready(function($){
      $(".toggle_container").hide();
      $("button.reveal").click(function(){
          $(this).toggleClass("active").next().slideToggle("fast");

          if ($.trim($(this).text()) === 'Hide') {
              $(this).text('Add Supply');
          } else {
              $(this).text('Hide');
          }

          return false;
      });
      $("a[href='" + window.location.hash + "']").parent(".reveal").click();
  });

</script>

@endpush
