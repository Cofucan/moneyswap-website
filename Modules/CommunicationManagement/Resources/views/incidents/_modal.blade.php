<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Report New Incident</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('incidents.store') }}" id="CreateIncident">
                    {{csrf_field()}}
                  
                    <div class="form-group">
                        <label for="label">Incident Title</label>
                        <input type="text" name="label" value="{{old('label')}}" class="form-control"  id="label" />
                        @if ($errors->has('label'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="overview">Describe the incident in details</label>
                        <textarea name="overview" class="form-control" rows="7" placeholder="Provide response" id="textarea">{!! old('overview') !!}</textarea>
                        @if ($errors->has('overview'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('overview') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="incident_category_id">Incident Category</label>
                                <select name="incident_category_id" class="custom-select d-block w-100 select2" id="incident_category_id" required>
                                    @foreach ($incidentcategories as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>                                
                                    @endforeach                          
                                </select>
                                @if ($errors->has('incident_category_id'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('incident_category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity">How urgent is this incident</label>
                                <select name="severity" class="custom-select d-block w-100 select2" id="severity" required>
                                    @foreach ($severities as $severity)
                                        <option value="{{ $severity }}">{{ $severity }}</option>                               
                                    @endforeach
                                </select>
                                @if ($errors->has('severity'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('severity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Save </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@include('partials.summernote')