
@if($vacancy->status == 'Draft'  && $vacancy->user_id ==  Auth::id())

    <div class="row">
        {{-- <div class="col-md-2 col-sm-3 ">
            <a href="{{ route('vacancies.finalize', $vacancy->id) }}" class="btn btn-primary btn-block"> Continue  </a>
        </div> --}}
        <div class="col-md-2 col-sm-3">
            <form method="POST" action="{{ route('vacancies.process') }}"
            onsubmit="return confirm('Are you sure you want to post this job ?');">
            <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}" />
            {{ csrf_field() }}

                <button class="btn btn-danger btn-block" name="status" value="Scheduled">Post Job</button>
            </form>
        </div>
        <div class="col-md-2 offset-md-4 offset-sm-3 col-sm-3 ">
            <a class="btn btn-warning btn-block" href="{{ route('vacancies.edit',$vacancy->id) }}"><i class="fa fa-edit"></i> Edit Job</a>
        </div>
    </div>
@elseif($vacancy->status == 'Rejected' && $vacancy->user_id == Auth::id())
<div class="col-md-2 offset-md-4 offset-sm-3 col-sm-3 ">
    <a class="btn btn-warning btn-block" href="{{ route('vacancies.edit',$vacancy->id) }}"><i class="fa fa-edit"></i> Edit Job</a>
</div>

@elseif(Auth::user()->profile->role_id == 11 && $vacancy->status =='Scheduled')

    <div class="row">
    <div class="col-md-3 offset-md-6">
        <form method="POST" action="{{ route('vacancies.process') }}"
            onsubmit="return confirm('Are you sure you want to perform the selected action ?');">
            <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}" />
            {{ csrf_field() }}
            <button class="btn btn-success btn-block btn-sm" name="status" value="Approved"> Approve Job</button>
        </form>
    </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#reject">
                Reject Job
            </button>
        </div>
    </div>

@endif

   {{-- modal begins--}}
   <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center"> Rejection Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('vacancies.process') }}"
                onsubmit="return confirm('Are you sure you want to perform the selected action ?');">
                <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}" />
                <input type="hidden" name="objectionable_id" value="{{$vacancy->id}}" />
                <input type="hidden" name="objectionable_type" value="vacancy" />
                {{ csrf_field() }}
                       <div class="form-group">
                        <label for="reason"> Reason for Rejection</label>
                        <textarea name="reason" class="form-control" rows="2"> {!! old('reason') !!}</textarea>
                        @if ($errors->has('reason'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('reason') }}</strong>
                            </span>
                        @endif
                       </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm" name="status" value="Rejected">Reject </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}
