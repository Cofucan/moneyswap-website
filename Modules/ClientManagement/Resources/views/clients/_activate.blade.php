<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#enrol{{$client->id}}">
    Activate
</a>
        {{-- modal begins--}}
<div class="modal fade" id="enrol{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">Schedule Enrolment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.activate') }}" id="ActivateStudent">
                {{csrf_field()}}
                <input type="hidden" name="client_id" value="{{ $client->id }}" class="form-control" />
                <div class="form-group">
                    <strong for="orphan_id"> Client:</strong>
                    {{ $client->name }}
                </div>

                <div class="form-group mb-2">
                    <label for="batch_id">Class to be Enrolled</label>
                    <select class="custom-select{{ $errors->has('batch_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="batch_id" id="batch_id">
                       @foreach ($batches as $batch)
                        @if($client->batch_id == $batch->id)
                        <option value="{{ $batch->id }}" selected> {{$batch->label}}</option>
                        @else
                        <option value="{{$batch->id}}"> {{$batch->label}}</option>
                        @endif
                        @endforeach
                    </select>
                    @if ($errors->has('batch_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('batch_id') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- <div class="form-group mb-2">
                    <label for="stream_id">Stream</label>
                    <select class="custom-select{{ $errors->has('stream_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="stream_id" id="stream_id">
                       @foreach ($client->Stream->Program->Streams as $stream)
                        @if($client->stream_id == $stream->id)
                        <option value="{{ $stream->id }}" selected> {{$stream->label}}</option>
                        @else
                        <option value="{{$stream->id}}"> {{$stream->label}}</option>
                        @endif
                       @endforeach
                    </select>
                    @if ($errors->has('stream_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('stream_id') }}</strong>
                        </span>
                    @endif
                </div> --}}

                <div class="form-group mb-2">
                    <label for="client_category_id">Attendance Type</label>
                    <select class="custom-select{{ $errors->has('client_category_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="client_category_id" id="client_category_id">
                       <option value=""> Select client attendance type</option>
                       @foreach ($clientcategories as $key => $clientcategory)
                        @if($client->client_category_id == $key)
                        <option value="{{ $key }}" selected> {{$clientcategory}}</option>
                        @else
                        <option value="{{$key}}"> {{$clientcategory}}</option>
                        @endif
                       @endforeach
                    </select>
                    @if ($errors->has('client_category_id'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('client_category_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="modal-footer">
                <button class="btn btn-success" type="submit">Submit </button>
                {{--  <button class="btn btn-primary" type="reset">Reset Form</button>  --}}
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}
