@foreach($agents as $sponsor)

    <div class="announcement">
        <div class="col-md-12 ">
            <a href="{{ route('agents.show', $sponsor->id) }}">

                <div class="title">
                    {{-- <div class="col-md-10 col-sm-8 col-8"> --}}
                        <span class="s-text4"> {{ $sponsor->start_datetime }} </span>
                        {{-- <p>{{ $sponsor->User->full_name }}  </p> --}}
                        <h6 class="">{{ $sponsor->label }}</h6>
                    {{-- </div> --}}
                </div>
            </a>
        </div>
    </div>


    @if($loop->index > 1)
        @break
        @endif
@endforeach
