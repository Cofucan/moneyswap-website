{{-- organization modal begins--}}
<div class="modal fade" id="edit-vital" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Update Vitals</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vitals.update', $client->Profile->Vital->id) }}" method="POST"  id="UpdateDepartment">
                    {{csrf_field()}}
                    @method('PUT')

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="blood_group"> Blood group</label>
                            <input type="text" name="blood_group" value="{{$client->profile->vital->blood_group}}" class="form-control {{ $errors->has('blood_group') ? ' is-invalid' : '' }}" placeholder="Blood Group"  id="blood_group"/>
                            @if ($errors->has('blood_group'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('blood_group') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="genotype"> Genotype</label>
                            <input type="text" name="genotype" value="{{$client->profile->vital->genotype}}" class="form-control {{ $errors->has('genotype') ? ' is-invalid' : '' }}" placeholder="Genotype"  id="genotype"/>
                            @if ($errors->has('genotype'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('genotype') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="height">Height</label>
                            <div class="input-group">
                                <input type="number" name="height" value="{{$client->profile->vital->height}}" class="form-control {{ $errors->has('height') ? ' is-invalid' : '' }}"   id="height"/>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">ft</div>
                                </div>
                            </div>
                            @if ($errors->has('height'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="weight">Weight</label>
                            <div class="input-group">
                                <input type="number" name="weight" value="{{$client->profile->vital->weight}}" class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}"   id="weight"/>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">kg</div>
                                </div>
                            </div>
                            @if ($errors->has('weight'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="eye_colour"> Eye Colour</label>
                            <input type="text" name="eye_colour" value="{{$client->profile->vital->eye_colour}}" class="form-control {{ $errors->has('eye_colour') ? ' is-invalid' : '' }}"  id="eye_colour"/>
                            @if ($errors->has('eye_colour'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('eye_colour') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="hair_colour"> Hair Colour</label>
                            <input type="text" name="hair_colour" value="{{$client->profile->vital->hair_colour}}" class="form-control {{ $errors->has('hair_colour') ? ' is-invalid' : '' }}" id="hair_colour"/>
                            @if ($errors->has('hair_colour'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('hair_colour') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="complexion"> Complexion</label>
                            <input type="text" name="complexion" value="{{$client->profile->vital->complexion}}" class="form-control {{ $errors->has('complexion') ? ' is-invalid' : '' }}"  id="complexion"/>
                            @if ($errors->has('complexion'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('complexion') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-row mb-3">
                            <div class="col-12"><label for="tribal_marks">Tribal Marks</label></div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input id="yes" name="tribal_marks" type="radio" value="1" class="custom-control-input" required>
                                    <label class="custom-control-label" for="yes">Yes</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input id="no" name="tribal_marks" type="radio" value="0" class="custom-control-input" required>
                                    <label class="custom-control-label" for="no">No</label>
                                </div>
                            </div>
                        </div>
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


