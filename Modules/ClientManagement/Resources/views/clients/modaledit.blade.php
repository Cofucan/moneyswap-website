 <a class="btn btn-primary px-3  btn-sm" data-toggle="modal" data-target="#update">
Edit Details
</a>
  {{-- client modal begins--}}
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
          <form method="POST" action="{{ route('clients.update', $client) }}" id="UpdateClient">
            {{csrf_field()}}
            @method('PUT')

            <div class="form-group">
              <strong> Full Name: </strong>
              <input id="client_name" type="text" value="{{$client->name}}" class="form-control{{ $errors->has('form_number') ? ' is-invalid' : '' }}" disabled>

            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="program">Program: </label>
                  <input id="program_id" type="text" value="{{$client->program_name}}" class="form-control{{ $errors->has('form_number') ? ' is-invalid' : '' }}" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
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
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="form_number">Admission Number</label>
                  <input id="form_number" type="number" value="{{ $client->form_number }}" class="form-control{{ $errors->has('form_number') ? ' is-invalid' : '' }}" name="form_number" required>
                  @if ($errors->has('form_number'))
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('form_number') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="client_category_id"> Category </label>
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









