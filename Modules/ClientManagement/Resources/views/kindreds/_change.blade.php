<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#changeattendance">
    Change Attendance Type
</a>
<div class="modal fade" id="changeattendance" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelS" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Change Attendance Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.change') }}" id="ChangeEnrolment">
                    {{csrf_field()}}
                    <input type="hidden" name="orphan_id" value="{{ $client->id }}" class="form-control" />
                    <input type="hidden" name="academic_term_id" value="{{ $currentterm->id }}" class="form-control" />
                    <input type="hidden" name="status" value="Change" class="form-control" />
                    <div class=" form-group">
                            <label for="client_category_id"> Attendance Type </label>
                            <select name="client_category_id" id="client_category_id" class="custom-select select2 w-100 form-control" data-live-search="true" >
                                @foreach($clientcategories as $key => $clientcategory)
                                    @if($key <> $client->client_category_id)
                                        <option value="{{$key}}"> {{$clientcategory}}</option>
                                    @endif
                                @endforeach

                            </select>
                            @if ($errors->has('client_category_id'))
                                <span class="invalid-variationdback">
                                <strong>{{ $errors->first('client_category_id') }}</strong>
                                </span>
                            @endif
                        </div>

                    <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Change </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
