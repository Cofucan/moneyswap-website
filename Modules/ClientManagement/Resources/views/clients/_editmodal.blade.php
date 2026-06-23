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
                                            <label for="program_id">Class </label>
                                            <select class="custom-select{{ $errors->has('program_id') ? ' is-invalid' : '' }} d-block w-100 select2"  name="program_id" id="program">
                                               @foreach ($programs as $key => $program)
                                                @if($client->program_id == $key)
                                                <option value="{{ $key }}" selected> {{$program}}</option>
                                                @else
                                                <option value="{{$key}}"> {{ $program }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('program_id'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('program_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="position_in_family">Child Position In Family</label>
                                            <select name="position_in_family" class="custom-select select2" id="position_in_family" required>
                                                {{ $last = 10 }}
                                                {{ $first = 1 }}
                                                @for($i = $first; $i <= $last; $i++)
                                                    @if($client->position_in_family == $i)
                                                    <option value="{{$i}}" selected> {{$i}}</option>
                                                    @else
                                                    <option value="{{$i}}"> {{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            @if ($errors->has('position_in_family'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('position_in_family') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="client_category_id">Category</label>
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
