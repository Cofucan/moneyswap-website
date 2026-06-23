<div class="subject-card">
    <div class="subject-header">
        <div class="row">
            <div class="col-md-10 col-10 col-sm-10">
                <a href="{{ route('levels.show', $level->slug) }}">
                    <h5>{{ $level->label}}   </h5>
                </a>
            </div>
            <div class="col-md-2 col-2 col-sm-2">
                <div class="dropdown">
                    <a class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-navicon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('levels.show', $level)}}">Details</a>
                        @if($level->enabled == true)
                            <a class="dropdown-item" href="{{ url('levels/toggle', $level)}}">Disabled</a>
                            @else
                            <a class="dropdown-item" href="{{ url('levels/toggle', $level)}}">Enabled</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subject-body">
        <div class="row">
            <div class="col-md-4 col-6 text-center text-primary">
                <h3>{{$level->ActiveStudents->count()}}</h3>
                <p> <b>Active Students</b> </p>
            </div>
            <div class="col-md-4 col-6 text-center text-danger">
                <h3>{{$level->InactiveStudents->count()}}</h3>
                <p> <b>Inactive Students</b> </p>
            </div>

            <div class="col-md-4 col-6 text-center text-danger">
                <h3>{{$level->Enrolments->count()}}</h3>
                <p> <b>Enrolments</b> </p>
            </div>

        </div>
    </div>

</div>
