{{-- modal begins--}}
        <div class="modal fade" id="relieve{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Deactivate Client Profile</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('clients.process') }}" id="Relievestudent">
                            {{csrf_field()}}
                            <input type="hidden" class="form-control" name="client_id" value="{{ $client->id }}">

                                <div class="form-group">
                                    <strong>Client Name:</strong> {{ $client->name }}
                                </div>

                                <div class="form-group mb-2">
                                    <label for="status">Reason For Deactivation</label>
                                    <select class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }} d-block w-100 select2"  name="status" id="status" required>
                                        <option value="Graduated" > Graduated</option>
                                        <option value="No-show" >No show</option>
                                        <option value="No-show" >Expelled</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
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
