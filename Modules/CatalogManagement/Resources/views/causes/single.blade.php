 {{-- <a href="{{ url('cause', $cause->slug) }}"> --}}
    <div class="cause">
        <!-- Front -->
        <div class="service-img">
            <img src="{{ asset ($cause->thumbnail) }}" alt="" class="w-100">
        </div>
        <div class="content">
            <h5><a href="#">{{ $cause->expertise_title }}</a></h5>
                {!! str_limit($cause->expertise_brief, $limit = 80, $end = '...') !!} <br>
                <a href="{{ url('cause', $cause->slug) }}" class="genric-btn primary btn mt-3"> Read More</a>
        </div>
    </div>

{{-- </a> --}}
