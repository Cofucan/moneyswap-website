 {{-- modal begins--}}
                <div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Edit Client Profile</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('clients.update', $client) }}" id="UpdateStudent">
                                    {{csrf_field()}}
                                    @method('PUT')

                                        <div class="form-group">
                                            <strong>Client Name:</strong> {{ $client->name }}
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="grade_id">Class </label>
                                            <select class="custom-select{{ $errors->has('grade_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="grade_id" id="grade_id">
                                               @foreach ($client->Level->Program->Levels as $level)
                                                @if($client->grade_id == $level->id)
                                                <option value="{{ $level->id }}" selected> {{$level->label}}</option>
                                                @else
                                                <option value="{{$level->id}}"> {{$level->label}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('grade_id'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('grade_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="stream_id">Stream</label>
                                            <select class="custom-select{{ $errors->has('stream_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="stream_id" id="stream_id">
                                               @foreach ($client->Batch->Level->Program->Streams as $stream)
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
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="client_category_id">Attendance Type</label>
                                            <select class="custom-select{{ $errors->has('client_category_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="client_category_id" id="client_category_id">
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
                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal ends--}}
