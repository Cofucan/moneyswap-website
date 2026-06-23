  {{-- profile modal begins--}}
  <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center">Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('clients.update', $client) }}" id="UpdateStudent">
            {{csrf_field()}}
            @method('PUT')

            <div class="form-group">
              <strong> Client Name: </strong>
              <input id="grade_id" type="text" value="{{$client->name}}" class="form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}" disabled>

            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="program">Class: </label>
                  <input id="grade_id" type="text" value="{{$client->Level->label}}" class="form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="stream_id"> Academic Group: </label>
                  <input id="stream_id" type="text" value="{{ $client->batch->academic_group}}" class="form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}" disabled>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="admission_number">Admission Number</label>
                  <input id="admission_number" type="number" value="{{ $client->admission_number }}" class="form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}" name="admission_number" required>
                  @if ($errors->has('admission_number'))
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('admission_number') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="client_category_id"> Attendance Type </label>
                  <select name="client_category_id" class="custom-select d-block w-100 select2" id="student_type" required>
                      @foreach($clientcategories as $key => $student_type)
                      @if($client->client_category_id == $key)
                      <option value="{{$key}}" selected> {{$student_type}}</option>
                      @else
                      <option value="{{$key}}"> {{$student_type}}</option>
                      @endif

                      @endforeach
                  </select>
                  @if ($errors->has('student_type_i'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('client_category_id') }}</strong>
                              </span>
                  @endif
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









