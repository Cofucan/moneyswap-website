<a href="#filterbyclass" data-target="#filterbyclass" data-toggle="modal" class="btn btn-sm btn-secondary px-3 mb-2">Filter By Class</a>
<div class="modal fade" id="filterbyclass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">View by class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('clients.gradefilter') }}" id="BulkEnrolment">
                    {{csrf_field()}}
                    <div class="form-group">
                    <label for="grade_id">Class </label>
                    <select name="grade_id" class="custom-select d-block w-100 select2" required>
                        <option>Choose class </option>
                        @foreach($levels as $level)
                        <option value="{{$level->id}}"> {{$level->label}}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="custom-select d-block w-100 select2" required>
                        <option value="Active">Active </option>
                        <option value="Graduated">Graduated </option>
                        <option value="Discontinued">Discontinued </option>
                        <option value="Expelled">Expelled </option>

                    </select>
                    </div>

                    <div class="modal-footer">
                    <button class="btn btn-success" type="submit">View Clients</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
