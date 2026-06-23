 {{-- modal begins--}}
 <div class="modal fade" id="relieve{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Relieve {{ $employee->Profile->full_name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> Upon submission of this form, the profile and login details of this staff will be disabled on the platform</p>
                <form method="POST" action="{{ route('employeedisengagements.store') }}" id="RelieveEmployee">
                    {{ csrf_field()}}
                    <input type="hidden" class="form-control" name="employee_id" value="{{ $employee->id }}">

                        <div class="form-group">
                            <strong>Employee Name:</strong> {{ $employee->Profile->full_name }}
                        </div>

                        @include('humanresources::employeedisengagements._form')

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal ends--}}